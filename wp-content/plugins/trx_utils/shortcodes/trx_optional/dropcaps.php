<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('diveit_sc_dropcaps_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_sc_dropcaps_theme_setup' );
	function diveit_sc_dropcaps_theme_setup() {
		add_action('diveit_action_shortcodes_list', 		'diveit_sc_dropcaps_reg_shortcodes');
		if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
			add_action('diveit_action_shortcodes_list_vc','diveit_sc_dropcaps_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

//[trx_dropcaps id="unique_id" style="1-6"]paragraph text[/trx_dropcaps]

if (!function_exists('diveit_sc_dropcaps')) {	
	function diveit_sc_dropcaps($atts, $content=null){
		if (diveit_in_shortcode_blogger()) return '';
		extract(diveit_html_decode(shortcode_atts(array(
			// Individual params
			"style" => "1",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . diveit_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= diveit_get_css_dimensions_from_values($width, $height);
		$style = min(4, max(1, $style));
		$content = do_shortcode(str_replace(array('[vc_column_text]', '[/vc_column_text]'), array('', ''), $content));
		$output = diveit_substr($content, 0, 1) == '<' 
			? $content 
			: '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_dropcaps sc_dropcaps_style_' . esc_attr($style) . (!empty($class) ? ' '.esc_attr($class) : '') . '"'
				. ($css ? ' style="'.esc_attr($css).'"' : '')
				. (!diveit_param_is_off($animation) ? ' data-animation="'.esc_attr(diveit_get_animation_classes($animation)).'"' : '')
				. '>' 
					. '<span class="sc_dropcaps_item">' . trim(diveit_substr($content, 0, 1)) . '</span>' . trim(diveit_substr($content, 1))
			. '</div>';
		return apply_filters('diveit_shortcode_output', $output, 'trx_dropcaps', $atts, $content);
	}
	add_shortcode('trx_dropcaps', 'diveit_sc_dropcaps');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_dropcaps_reg_shortcodes' ) ) {
	//add_action('diveit_action_shortcodes_list', 'diveit_sc_dropcaps_reg_shortcodes');
	function diveit_sc_dropcaps_reg_shortcodes() {
	
		diveit_sc_map("trx_dropcaps", array(
			"title" => esc_html__("Dropcaps", 'trx_utils'),
			"desc" => wp_kses_data( __("Make first letter as dropcaps", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"style" => array(
					"title" => esc_html__("Style", 'trx_utils'),
					"desc" => wp_kses_data( __("Dropcaps style", 'trx_utils') ),
					"value" => "1",
					"type" => "checklist",
					"options" => diveit_get_list_styles(1, 4)
				),
				"_content_" => array(
					"title" => esc_html__("Paragraph content", 'trx_utils'),
					"desc" => wp_kses_data( __("Paragraph with dropcaps content", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"width" => diveit_shortcodes_width(),
				"height" => diveit_shortcodes_height(),
				"top" => diveit_get_sc_param('top'),
				"bottom" => diveit_get_sc_param('bottom'),
				"left" => diveit_get_sc_param('left'),
				"right" => diveit_get_sc_param('right'),
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
if ( !function_exists( 'diveit_sc_dropcaps_reg_shortcodes_vc' ) ) {
	//add_action('diveit_action_shortcodes_list_vc', 'diveit_sc_dropcaps_reg_shortcodes_vc');
	function diveit_sc_dropcaps_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_dropcaps",
			"name" => esc_html__("Dropcaps", 'trx_utils'),
			"description" => wp_kses_data( __("Make first letter of the text as dropcaps", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_dropcaps',
			"class" => "trx_sc_container trx_sc_dropcaps",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "style",
					"heading" => esc_html__("Style", 'trx_utils'),
					"description" => wp_kses_data( __("Dropcaps style", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(diveit_get_list_styles(1, 4)),
					"type" => "dropdown"
				),
				diveit_get_vc_param('id'),
				diveit_get_vc_param('class'),
				diveit_get_vc_param('animation'),
				diveit_get_vc_param('css'),
				diveit_vc_width(),
				diveit_vc_height(),
				diveit_get_vc_param('margin_top'),
				diveit_get_vc_param('margin_bottom'),
				diveit_get_vc_param('margin_left'),
				diveit_get_vc_param('margin_right')
			)
		
		) );
		
		class WPBakeryShortCode_Trx_Dropcaps extends Diveit_VC_ShortCodeContainer {}
	}
}
?>