<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('diveit_sc_reviews_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_sc_reviews_theme_setup' );
	function diveit_sc_reviews_theme_setup() {
		add_action('diveit_action_shortcodes_list', 		'diveit_sc_reviews_reg_shortcodes');
		if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
			add_action('diveit_action_shortcodes_list_vc','diveit_sc_reviews_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_reviews]
*/

if (!function_exists('diveit_sc_reviews')) {	
	function diveit_sc_reviews($atts, $content = null) {
		if (diveit_in_shortcode_blogger()) return '';
		extract(diveit_html_decode(shortcode_atts(array(
			// Individual params
			"align" => "right",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . diveit_get_css_position_as_classes($top, $right, $bottom, $left);
		$output = diveit_param_is_off(diveit_get_custom_option('show_sidebar_main'))
			? '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
						. ' class="sc_reviews'
							. ($align && $align!='none' ? ' align'.esc_attr($align) : '')
							. ($class ? ' '.esc_attr($class) : '')
							. '"'
						. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
						. (!diveit_param_is_off($animation) ? ' data-animation="'.esc_attr(diveit_get_animation_classes($animation)).'"' : '')
						. '>'
					. trim(diveit_get_reviews_placeholder())
					. '</div>'
			: '';
		return apply_filters('diveit_shortcode_output', $output, 'trx_reviews', $atts, $content);
	}
	add_shortcode("trx_reviews", "diveit_sc_reviews");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_reviews_reg_shortcodes' ) ) {
	//add_action('diveit_action_shortcodes_list', 'diveit_sc_reviews_reg_shortcodes');
	function diveit_sc_reviews_reg_shortcodes() {
	
		diveit_sc_map("trx_reviews", array(
			"title" => esc_html__("Reviews", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert reviews block in the single post", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"align" => array(
					"title" => esc_html__("Alignment", 'trx_utils'),
					"desc" => wp_kses_data( __("Align counter to left, center or right", 'trx_utils') ),
					"divider" => true,
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => diveit_get_sc_param('align')
				), 
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
if ( !function_exists( 'diveit_sc_reviews_reg_shortcodes_vc' ) ) {
	//add_action('diveit_action_shortcodes_list_vc', 'diveit_sc_reviews_reg_shortcodes_vc');
	function diveit_sc_reviews_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_reviews",
			"name" => esc_html__("Reviews", 'trx_utils'),
			"description" => wp_kses_data( __("Insert reviews block in the single post", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_reviews',
			"class" => "trx_sc_single trx_sc_reviews",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Align counter to left, center or right", 'trx_utils') ),
					"class" => "",
					"value" => array_flip(diveit_get_sc_param('align')),
					"type" => "dropdown"
				),
				diveit_get_vc_param('id'),
				diveit_get_vc_param('class'),
				diveit_get_vc_param('animation'),
				diveit_get_vc_param('css'),
				diveit_get_vc_param('margin_top'),
				diveit_get_vc_param('margin_bottom'),
				diveit_get_vc_param('margin_left'),
				diveit_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Reviews extends Diveit_VC_ShortCodeSingle {}
	}
}
?>