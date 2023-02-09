<?php
/**
 * DiveIt Framework: shortcodes manipulations
 *
 * @package	diveit
 * @since	diveit 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('diveit_sc_theme_setup')) {
	add_action( 'diveit_action_init_theme', 'diveit_sc_theme_setup', 1 );
	function diveit_sc_theme_setup() {
		// Add sc stylesheets
		add_action('diveit_action_add_styles', 'diveit_sc_add_styles', 1);
	}
}

if (!function_exists('diveit_sc_theme_setup2')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_sc_theme_setup2' );
	function diveit_sc_theme_setup2() {

		if ( !is_admin() || isset($_POST['action']) ) {
			// Enable/disable shortcodes in excerpt
			add_filter('the_excerpt', 					'diveit_sc_excerpt_shortcodes');
	
			// Prepare shortcodes in the content
			if (function_exists('diveit_sc_prepare_content')) diveit_sc_prepare_content();
		}

		// Add init script into shortcodes output in VC frontend editor
		add_filter('diveit_shortcode_output', 'diveit_sc_add_scripts', 10, 4);

		// AJAX: Send contact form data
		add_action('wp_ajax_send_form',			'diveit_sc_form_send');
		add_action('wp_ajax_nopriv_send_form',	'diveit_sc_form_send');

		// Show shortcodes list in admin editor
		add_action('media_buttons',				'diveit_sc_selector_add_in_toolbar', 11);

	}
}


// Register shortcodes styles
if ( !function_exists( 'diveit_sc_add_styles' ) ) {
	//add_action('diveit_action_add_styles', 'diveit_sc_add_styles', 1);
	function diveit_sc_add_styles() {
		// Shortcodes
		wp_enqueue_style( 'diveit-shortcodes-style',	trx_utils_get_file_url('shortcodes/theme.shortcodes.css'), array(), null );
	}
}


// Register shortcodes init scripts
if ( !function_exists( 'diveit_sc_add_scripts' ) ) {
	//add_filter('diveit_shortcode_output', 'diveit_sc_add_scripts', 10, 4);
	function diveit_sc_add_scripts($output, $tag='', $atts=array(), $content='') {

		if (diveit_storage_empty('shortcodes_scripts_added')) {
			diveit_storage_set('shortcodes_scripts_added', true);
            wp_enqueue_script( 'diveit-shortcodes-script', trx_utils_get_file_url('shortcodes/theme.shortcodes.js'), array('jquery'), null, true );
		}
		
		return $output;
	}
}


/* Prepare text for shortcodes
-------------------------------------------------------------------------------- */

// Prepare shortcodes in content
if (!function_exists('diveit_sc_prepare_content')) {
	function diveit_sc_prepare_content() {
		if (function_exists('diveit_sc_clear_around')) {
			$filters = array(
				array('diveit', 'sc', 'clear', 'around'),
				array('widget', 'text'),
				array('the', 'excerpt'),
				array('the', 'content')
			);
			if (function_exists('diveit_exists_woocommerce') && diveit_exists_woocommerce()) {
				$filters[] = array('woocommerce', 'template', 'single', 'excerpt');
				$filters[] = array('woocommerce', 'short', 'description');
			}
			if (is_array($filters) && count($filters) > 0) {
				foreach ($filters as $flt)
					add_filter(join('_', $flt), 'diveit_sc_clear_around', 1);	// Priority 1 to clear spaces before do_shortcodes()
			}
		}
	}
}

// Enable/Disable shortcodes in the excerpt
if (!function_exists('diveit_sc_excerpt_shortcodes')) {
	function diveit_sc_excerpt_shortcodes($content) {
		if (!empty($content)) {
			$content = do_shortcode($content);
		}
		return $content;
	}
}



/*
// Remove spaces and line breaks between close and open shortcode brackets ][:
[trx_columns]
	[trx_column_item]Column text ...[/trx_column_item]
	[trx_column_item]Column text ...[/trx_column_item]
	[trx_column_item]Column text ...[/trx_column_item]
[/trx_columns]

convert to

[trx_columns][trx_column_item]Column text ...[/trx_column_item][trx_column_item]Column text ...[/trx_column_item][trx_column_item]Column text ...[/trx_column_item][/trx_columns]
*/
if (!function_exists('diveit_sc_clear_around')) {
	function diveit_sc_clear_around($content) {
		if (!empty($content)) $content = preg_replace("/\](\s|\n|\r)*\[/", "][", $content);
		return $content;
	}
}






/* Shortcodes support utils
---------------------------------------------------------------------- */

// DiveIt shortcodes load scripts
if (!function_exists('diveit_sc_load_scripts')) {
	function diveit_sc_load_scripts() {
		static $loaded = false;
		if (!$loaded) {
            wp_enqueue_script( 'diveit-shortcodes_admin-script', trx_utils_get_file_url('shortcodes/shortcodes_admin.js'), array('jquery'), null, true );
            wp_enqueue_script( 'diveit-selection-script',  diveit_get_file_url('js/jquery.selection.js'), array('jquery'), null, true );
			wp_localize_script( 'diveit-shortcodes_admin-script', 'DIVEIT_SHORTCODES_DATA', diveit_storage_get('shortcodes') );
			$loaded = true;
		}
	}
}

// DiveIt shortcodes prepare scripts
if (!function_exists('diveit_sc_prepare_scripts')) {
	function diveit_sc_prepare_scripts() {
		static $prepared = false;
		if (!$prepared) {
			diveit_storage_set_array('js_vars', 'shortcodes_cp', is_admin() ? (!diveit_storage_empty('to_colorpicker') ? diveit_storage_get('to_colorpicker') : 'wp') : 'custom');	// wp | tiny | custom
			$prepared = true;
		}
	}
}

// Show shortcodes list in admin editor
if (!function_exists('diveit_sc_selector_add_in_toolbar')) {
	//add_action('media_buttons','diveit_sc_selector_add_in_toolbar', 11);
	function diveit_sc_selector_add_in_toolbar(){

		if ( !diveit_options_is_used() ) return;

		diveit_sc_load_scripts();
		diveit_sc_prepare_scripts();

		$shortcodes = diveit_storage_get('shortcodes');
		$shortcodes_list = '<select class="sc_selector"><option value="">&nbsp;'.esc_html__('- Select Shortcode -', 'trx_utils').'&nbsp;</option>';

		if (is_array($shortcodes) && count($shortcodes) > 0) {
			foreach ($shortcodes as $idx => $sc) {
				$shortcodes_list .= '<option value="'.esc_attr($idx).'" title="'.esc_attr($sc['desc']).'">'.esc_html($sc['title']).'</option>';
			}
		}

		$shortcodes_list .= '</select>';

		diveit_show_layout($shortcodes_list);
	}
}

// DiveIt shortcodes builder settings
require_once('shortcodes_settings.php');

// VC shortcodes settings
if ( class_exists('WPBakeryShortCode') ) {
    require_once('shortcodes_vc.php');
}

// DiveIt shortcodes implementation

require_once('trx_basic/anchor.php');
require_once('trx_basic/audio.php');
require_once('trx_basic/blogger.php');
require_once('trx_basic/booked.php');
require_once('trx_basic/br.php');
require_once('trx_basic/call_to_action.php');
require_once('trx_basic/chat.php');
require_once('trx_basic/columns.php');
require_once('trx_basic/content.php');
require_once('trx_basic/events.php');
require_once('trx_basic/form.php');
require_once('trx_basic/googlemap.php');
require_once('trx_basic/hide.php');
require_once('trx_basic/image.php');
require_once('trx_basic/infobox.php');
require_once('trx_basic/line.php');
require_once('trx_basic/list.php');
require_once('trx_basic/price_block.php');
require_once('trx_basic/promo.php');
require_once('trx_basic/quote.php');
require_once('trx_basic/reviews.php');
require_once('trx_basic/search.php');
require_once('trx_basic/section.php');
require_once('trx_basic/skills.php');
require_once('trx_basic/slider.php');
require_once('trx_basic/socials.php');
require_once('trx_basic/table.php');
require_once('trx_basic/title.php');
require_once('trx_basic/twitter.php');
require_once('trx_basic/video.php');
require_once('trx_basic/woocommerce.php');
require_once('trx_basic/support.services.php');
require_once('trx_basic/support.team.php');
require_once('trx_basic/support.testimonials.php');

require_once('trx_optional/button.php');
require_once('trx_optional/countdown.php');
require_once('trx_optional/dropcaps.php');
require_once('trx_optional/highlight.php');
require_once('trx_optional/icon.php');
require_once('trx_optional/price.php');
require_once('trx_optional/tabs.php');
require_once('trx_optional/tooltip.php');
?>