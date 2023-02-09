<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('diveit_sc_content_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_sc_content_theme_setup' );
	function diveit_sc_content_theme_setup() {
		add_action('diveit_action_shortcodes_list', 		'diveit_sc_content_reg_shortcodes');
		if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
			add_action('diveit_action_shortcodes_list_vc','diveit_sc_content_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_content id="unique_id" class="class_name" style="css-styles"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_content]
*/

if (!function_exists('diveit_sc_content')) {	
	function diveit_sc_content($atts, $content=null){	
		if (diveit_in_shortcode_blogger()) return '';
		extract(diveit_html_decode(shortcode_atts(array(
			"scheme" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"top" => "",
			"bottom" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . diveit_get_css_position_as_classes($top, '', $bottom);
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
			. ' class="sc_content content_wrap' 
				. ($scheme && !diveit_param_is_off($scheme) && !diveit_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
				. ($class ? ' '.esc_attr($class) : '') 
				. '"'
			. (!diveit_param_is_off($animation) ? ' data-animation="'.esc_attr(diveit_get_animation_classes($animation)).'"' : '')
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '').'>' 
			. do_shortcode($content) 
			. '</div>';
		return apply_filters('diveit_shortcode_output', $output, 'trx_content', $atts, $content);
	}
	add_shortcode('trx_content', 'diveit_sc_content');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_content_reg_shortcodes' ) ) {
	//add_action('diveit_action_shortcodes_list', 'diveit_sc_content_reg_shortcodes');
	function diveit_sc_content_reg_shortcodes() {
	
		diveit_sc_map("trx_content", array(
			"title" => esc_html__("Content block", 'trx_utils'),
			"desc" => wp_kses_data( __("Container for main content block with desired class and style (use it only on fullscreen pages)", 'trx_utils') ),
			"decorate" => true,
			"container" => true,
			"params" => array(
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'trx_utils'),
					"desc" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"options" => diveit_get_sc_param('schemes')
				),
				"_content_" => array(
					"title" => esc_html__("Container content", 'trx_utils'),
					"desc" => wp_kses_data( __("Content for section container", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"top" => diveit_get_sc_param('top'),
				"bottom" => diveit_get_sc_param('bottom'),
				"id" => diveit_get_sc_param('id'),
				"class" => diveit_get_sc_param('class'),
				"animation" => diveit_get_sc_param('animation'),
				"css" => diveit_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_content_reg_shortcodes_vc' ) ) {
	//add_action('diveit_action_shortcodes_list_vc', 'diveit_sc_content_reg_shortcodes_vc');
	function diveit_sc_content_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_content",
			"name" => esc_html__("Content block", 'trx_utils'),
			"description" => wp_kses_data( __("Container for main content block (use it only on fullscreen pages)", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_content',
			"class" => "trx_sc_collection trx_sc_content",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'trx_utils'),
					"description" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => array_flip(diveit_get_sc_param('schemes')),
					"type" => "dropdown"
				),
				diveit_get_vc_param('id'),
				diveit_get_vc_param('class'),
				diveit_get_vc_param('animation'),
				diveit_get_vc_param('css'),
				diveit_get_vc_param('margin_top'),
				diveit_get_vc_param('margin_bottom')
			)
		) );
		
		class WPBakeryShortCode_Trx_Content extends Diveit_VC_ShortCodeCollection {}
	}
}
?>