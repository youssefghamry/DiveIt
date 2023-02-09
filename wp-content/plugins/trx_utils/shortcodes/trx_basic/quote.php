<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('diveit_sc_quote_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_sc_quote_theme_setup' );
	function diveit_sc_quote_theme_setup() {
		add_action('diveit_action_shortcodes_list', 		'diveit_sc_quote_reg_shortcodes');
		if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
			add_action('diveit_action_shortcodes_list_vc','diveit_sc_quote_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_quote id="unique_id" cite="url" title=""]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/quote]
*/

if (!function_exists('diveit_sc_quote')) {	
	function diveit_sc_quote($atts, $content=null){	
		if (diveit_in_shortcode_blogger()) return '';
		extract(diveit_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			"cite" => "",
            "bg_image" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));

        if ($bg_image > 0) {
            $attach = wp_get_attachment_image_src( $bg_image, 'full' );
            if (isset($attach[0]) && $attach[0]!='')
                $bg_image = $attach[0];
        }

		$class .= ($class ? ' ' : '') . diveit_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= diveit_get_css_dimensions_from_values($width);
        $css .= ($bg_image !== '' ? 'background-image:url(' . esc_url($bg_image) . ');' : '');
		$cite_param = $cite != '' ? ' cite="'.esc_attr($cite).'"' : '';
		$title = $title=='' ? $cite : $title;
		$content = do_shortcode($content);
		if (diveit_substr($content, 0, 2)!='<p') $content = '<p>' . ($content) . '</p>';
		$output = '<blockquote' 
			. ($id ? ' id="'.esc_attr($id).'"' : '') . ($cite_param) 
			. ' class="sc_quote'. (!empty($class) ? ' '.esc_attr($class) : '').'"' 
			. (!diveit_param_is_off($animation) ? ' data-animation="'.esc_attr(diveit_get_animation_classes($animation)).'"' : '')
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
			. '>'
				. ($content)
				. ($title == '' ? '' : ('<p class="sc_quote_title">' . ($cite!='' ? '<a href="'.esc_url($cite).'">' : '') . ($title) . ($cite!='' ? '</a>' : '') . '</p>'))
			.'</blockquote>';
		return apply_filters('diveit_shortcode_output', $output, 'trx_quote', $atts, $content);
	}
	add_shortcode('trx_quote', 'diveit_sc_quote');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_quote_reg_shortcodes' ) ) {
	//add_action('diveit_action_shortcodes_list', 'diveit_sc_quote_reg_shortcodes');
	function diveit_sc_quote_reg_shortcodes() {
	
		diveit_sc_map("trx_quote", array(
			"title" => esc_html__("Quote", 'trx_utils'),
			"desc" => wp_kses_data( __("Quote text", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"cite" => array(
					"title" => esc_html__("Quote cite", 'trx_utils'),
					"desc" => wp_kses_data( __("URL for quote cite", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"title" => array(
					"title" => esc_html__("Title (author)", 'trx_utils'),
					"desc" => wp_kses_data( __("Quote title (author name)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Quote content", 'trx_utils'),
					"desc" => wp_kses_data( __("Quote content", 'trx_utils') ),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"width" => diveit_shortcodes_width(),
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
if ( !function_exists( 'diveit_sc_quote_reg_shortcodes_vc' ) ) {
	//add_action('diveit_action_shortcodes_list_vc', 'diveit_sc_quote_reg_shortcodes_vc');
	function diveit_sc_quote_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_quote",
			"name" => esc_html__("Quote", 'trx_utils'),
			"description" => wp_kses_data( __("Quote text", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_quote',
			"class" => "trx_sc_single trx_sc_quote",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "cite",
					"heading" => esc_html__("Quote cite", 'trx_utils'),
					"description" => wp_kses_data( __("URL for the quote cite link", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title (author)", 'trx_utils'),
					"description" => wp_kses_data( __("Quote title (author name)", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
                array(
                    "param_name" => "bg_image",
                    "heading" => esc_html__("Background image URL", 'trx_utils'),
                    "description" => wp_kses_data( __("Select background image from library for this section", 'trx_utils') ),
                                       "class" => "",
                    "value" => "",
                    "type" => "attach_image"
                ),
				array(
					"param_name" => "content",
					"heading" => esc_html__("Quote content", 'trx_utils'),
					"description" => wp_kses_data( __("Quote content", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
				),
				diveit_get_vc_param('id'),
				diveit_get_vc_param('class'),
				diveit_get_vc_param('animation'),
				diveit_get_vc_param('css'),
				diveit_vc_width(),
				diveit_get_vc_param('margin_top'),
				diveit_get_vc_param('margin_bottom'),
				diveit_get_vc_param('margin_left'),
				diveit_get_vc_param('margin_right')
			),
			'js_view' => 'VcTrxTextView'
		) );
		
		class WPBakeryShortCode_Trx_Quote extends Diveit_VC_ShortCodeSingle {}
	}
}
?>