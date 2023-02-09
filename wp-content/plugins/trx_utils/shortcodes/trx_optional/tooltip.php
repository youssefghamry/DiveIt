<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('diveit_sc_tooltip_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_sc_tooltip_theme_setup' );
	function diveit_sc_tooltip_theme_setup() {
		add_action('diveit_action_shortcodes_list', 		'diveit_sc_tooltip_reg_shortcodes');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_tooltip id="unique_id" title="Tooltip text here"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/tooltip]
*/

if (!function_exists('diveit_sc_tooltip')) {	
	function diveit_sc_tooltip($atts, $content=null){	
		if (diveit_in_shortcode_blogger()) return '';
		extract(diveit_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
		), $atts)));
		$output = '<span' . ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_tooltip_parent'. (!empty($class) ? ' '.esc_attr($class) : '').'"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
					. '>'
						. do_shortcode($content)
						. '<span class="sc_tooltip">' . ($title) . '</span>'
					. '</span>';
		return apply_filters('diveit_shortcode_output', $output, 'trx_tooltip', $atts, $content);
	}
	add_shortcode('trx_tooltip', 'diveit_sc_tooltip');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_tooltip_reg_shortcodes' ) ) {
	//add_action('diveit_action_shortcodes_list', 'diveit_sc_tooltip_reg_shortcodes');
	function diveit_sc_tooltip_reg_shortcodes() {
	
		diveit_sc_map("trx_tooltip", array(
			"title" => esc_html__("Tooltip", 'trx_utils'),
			"desc" => wp_kses_data( __("Create tooltip for selected text", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Tooltip title (required)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Tipped content", 'trx_utils'),
					"desc" => wp_kses_data( __("Highlighted content with tooltip", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"id" => diveit_get_sc_param('id'),
				"class" => diveit_get_sc_param('class'),
				"css" => diveit_get_sc_param('css')
			)
		));
	}
}
?>