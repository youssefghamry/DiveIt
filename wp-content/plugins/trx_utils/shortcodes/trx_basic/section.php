<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('diveit_sc_section_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_sc_section_theme_setup' );
	function diveit_sc_section_theme_setup() {
		add_action('diveit_action_shortcodes_list', 		'diveit_sc_section_reg_shortcodes');
		if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
			add_action('diveit_action_shortcodes_list_vc','diveit_sc_section_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_section id="unique_id" class="class_name" style="css-styles" dedicated="yes|no"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_section]
*/

diveit_storage_set('sc_section_dedicated', '');

if (!function_exists('diveit_sc_section')) {	
	function diveit_sc_section($atts, $content=null){	
		if (diveit_in_shortcode_blogger()) return '';
		extract(diveit_html_decode(shortcode_atts(array(
			// Individual params
			"dedicated" => "no",
			"align" => "none",
			"columns" => "none",
			"pan" => "no",
			"scroll" => "no",
			"scroll_dir" => "horizontal",
			"scroll_controls" => "hide",
			"color" => "",
			"scheme" => "",
			"bg_color" => "",
			"bg_image" => "",
			"bg_overlay" => "",
			"bg_texture" => "",
			"bg_tile" => "no",
			"bg_padding" => "yes",
			"font_size" => "",
			"font_weight" => "",
			"title" => "",
			"link" => '',
            "style_color" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"height" => "",
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
	
		if ($bg_overlay > 0) {
			if ($bg_color=='') $bg_color = diveit_get_scheme_color('bg');
			$rgb = diveit_hex2rgb($bg_color);
		}
	
		$class .= ($class ? ' ' : '') . diveit_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= ($color !== '' ? 'color:' . esc_attr($color) . ';' : '')
			.($bg_color !== '' && $bg_overlay==0 ? 'background-color:' . esc_attr($bg_color) . ';' : '')
			.($bg_image !== '' ? 'background-image:url(' . esc_url($bg_image) . ');'.(diveit_param_is_on($bg_tile) ? 'background-repeat:repeat;' : 'background-repeat:no-repeat;background-size:cover;') : '')
			.(!diveit_param_is_off($pan) ? 'position:relative;' : '')
			.($font_size != '' ? 'font-size:' . esc_attr(diveit_prepare_css_value($font_size)) . '; line-height: 1.3em;' : '')
			.($font_weight != '' && !diveit_param_is_inherit($font_weight) ? 'font-weight:' . esc_attr($font_weight) . ';' : '');
		$css_dim = diveit_get_css_dimensions_from_values($width, $height);
		if ($bg_image == '' && $bg_color == '' && $bg_overlay==0 && $bg_texture==0 && diveit_strlen($bg_texture)<2) $css .= $css_dim;
		
		$width  = diveit_prepare_css_value($width);
		$height = diveit_prepare_css_value($height);
	
		if ((!diveit_param_is_off($scroll) || !diveit_param_is_off($pan)) && empty($id)) $id = 'sc_section_'.str_replace('.', '', mt_rand());
	
		if (!diveit_param_is_off($scroll)) diveit_enqueue_slider();

        $enable_div = false;
	    if(!empty($title) || (!empty($link))) {
            $enable_div = true;
        }

		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_section' 
					. ($class ? ' ' . esc_attr($class) : '')
                    . (!empty($style_color) ? ' '.esc_attr($style_color) : '')
                    . ($enable_div ? ' header-enable' : '')
					. ($scheme && !diveit_param_is_off($scheme) && !diveit_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
					. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
					. (!empty($columns) && $columns!='none' ? ' column-'.esc_attr($columns) : '') 
					. (diveit_param_is_on($scroll) && !diveit_param_is_off($scroll_controls) ? ' sc_scroll_controls sc_scroll_controls_'.esc_attr($scroll_dir).' sc_scroll_controls_type_'.esc_attr($scroll_controls) : '')
					. '"'
				. (!diveit_param_is_off($animation) ? ' data-animation="'.esc_attr(diveit_get_animation_classes($animation)).'"' : '')
				. ($css!='' || $css_dim!='' ? ' style="'.esc_attr($css.$css_dim).'"' : '')
				.'>' 
				. '<div class="sc_section_inner">'
					. ($bg_image !== '' || $bg_color !== '' || $bg_overlay>0 || $bg_texture>0 || diveit_strlen($bg_texture)>2
						? '<div class="sc_section_overlay'.($bg_texture>0 ? ' texture_bg_'.esc_attr($bg_texture) : '') . '"'
							. ' style="' . ($bg_overlay>0 ? 'background-color:rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].','.min(1, max(0, $bg_overlay)).');' : '')
								. (diveit_strlen($bg_texture)>2 ? 'background-image:url('.esc_url($bg_texture).');' : '')
								. '"'
								. ($bg_overlay > 0 ? ' data-overlay="'.esc_attr($bg_overlay).'" data-bg_color="'.esc_attr($bg_color).'"' : '')
								. '>'
								. '<div class="sc_section_content' . (diveit_param_is_on($bg_padding) ? ' padding_on' : ' padding_off') . '"'
									. ' style="'.esc_attr($css_dim).'"'
									. '>'
						: '')
					. (diveit_param_is_on($scroll) 
						? '<div id="'.esc_attr($id).'_scroll" class="sc_scroll sc_scroll_'.esc_attr($scroll_dir).' swiper-slider-container scroll-container"'
							. ' style="'.($height != '' ? 'height:'.esc_attr($height).';' : '') . ($width != '' ? 'width:'.esc_attr($width).';' : '').'"'
							. '>'
							. '<div class="sc_scroll_wrapper swiper-wrapper">' 
							. '<div class="sc_scroll_slide swiper-slide">' 
						: '')
					. (diveit_param_is_on($pan) 
						? '<div id="'.esc_attr($id).'_pan" class="sc_pan sc_pan_'.esc_attr($scroll_dir).'">' 
						: '')
                            . ($enable_div ? '<div class="section-header">' : '')
							. (!empty($title) ? '<h1 class="sc_section_title">' . trim(diveit_strmacros($title)) . '</h1>' : '')
                            . (!empty($link) ? diveit_do_shortcode('[trx_button link="'.esc_url($link).'" icon="icon-right"][/trx_button]') : '')
                            . ($enable_div ? '</div>' : '')
							. '<div class="sc_section_content_wrap">' . do_shortcode($content) . '</div>'

					. (diveit_param_is_on($pan) ? '</div>' : '')
					. (diveit_param_is_on($scroll) 
						? '</div></div><div id="'.esc_attr($id).'_scroll_bar" class="sc_scroll_bar sc_scroll_bar_'.esc_attr($scroll_dir).' '.esc_attr($id).'_scroll_bar"></div></div>'
							. (!diveit_param_is_off($scroll_controls) ? '<div class="sc_scroll_controls_wrap"><a class="sc_scroll_prev" href="#"></a><a class="sc_scroll_next" href="#"></a></div>' : '')
						: '')
					. ($bg_image !== '' || $bg_color !== '' || $bg_overlay > 0 || $bg_texture>0 || diveit_strlen($bg_texture)>2 ? '</div></div>' : '')
					. '</div>'
				. '</div>';
		if (diveit_param_is_on($dedicated)) {
			if (diveit_storage_get('sc_section_dedicated')=='') {
				diveit_storage_set('sc_section_dedicated', $output);
			}
			$output = '';
		}
		return apply_filters('diveit_shortcode_output', $output, 'trx_section', $atts, $content);
	}
	add_shortcode('trx_section', 'diveit_sc_section');
}

if (!function_exists('diveit_sc_block')) {	
	function diveit_sc_block($atts, $content=null) {
        if (empty($atts)) $atts = array();
        $atts['class'] = (!empty($atts['class']) ? $atts['class'] . ' ' : '') . 'sc_section_block';
		return apply_filters('diveit_shortcode_output', diveit_sc_section($atts, $content), 'trx_block', $atts, $content);
	}
	add_shortcode('trx_block', 'diveit_sc_block');
}


/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_section_reg_shortcodes' ) ) {
	//add_action('diveit_action_shortcodes_list', 'diveit_sc_section_reg_shortcodes');
	function diveit_sc_section_reg_shortcodes() {
	
		$sc = array(
			"title" => esc_html__("Block container", 'trx_utils'),
			"desc" => wp_kses_data( __("Container for any block ([trx_section] analog - to enable nesting)", 'trx_utils') ),
			"decorate" => true,
			"container" => true,
			"params" => array(
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Title for the block", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"link" => array(
					"title" => esc_html__("Button URL", 'trx_utils'),
					"desc" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"dedicated" => array(
					"title" => esc_html__("Dedicated", 'trx_utils'),
					"desc" => wp_kses_data( __("Use this block as dedicated content - show it before post title on single page", 'trx_utils') ),
					"value" => "no",
					"type" => "switch",
					"options" => diveit_get_sc_param('yes_no')
				),
				"align" => array(
					"title" => esc_html__("Align", 'trx_utils'),
					"desc" => wp_kses_data( __("Select block alignment", 'trx_utils') ),
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => diveit_get_sc_param('align')
				),
				"columns" => array(
					"title" => esc_html__("Columns emulation", 'trx_utils'),
					"desc" => wp_kses_data( __("Select width for columns emulation", 'trx_utils') ),
					"value" => "none",
					"type" => "checklist",
					"options" => diveit_get_sc_param('columns')
				), 
				"pan" => array(
					"title" => esc_html__("Use pan effect", 'trx_utils'),
					"desc" => wp_kses_data( __("Use pan effect to show section content", 'trx_utils') ),
					"divider" => true,
					"value" => "no",
					"type" => "switch",
					"options" => diveit_get_sc_param('yes_no')
				),
				"scroll" => array(
					"title" => esc_html__("Use scroller", 'trx_utils'),
					"desc" => wp_kses_data( __("Use scroller to show section content", 'trx_utils') ),
					"divider" => true,
					"value" => "no",
					"type" => "switch",
					"options" => diveit_get_sc_param('yes_no')
				),
				"scroll_dir" => array(
					"title" => esc_html__("Scroll and Pan direction", 'trx_utils'),
					"desc" => wp_kses_data( __("Scroll and Pan direction (if Use scroller = yes or Pan = yes)", 'trx_utils') ),
					"dependency" => array(
						'pan' => array('yes'),
						'scroll' => array('yes')
					),
					"value" => "horizontal",
					"type" => "switch",
					"size" => "big",
					"options" => diveit_get_sc_param('dir')
				),
				"scroll_controls" => array(
					"title" => esc_html__("Scroll controls", 'trx_utils'),
					"desc" => wp_kses_data( __("Show scroll controls (if Use scroller = yes)", 'trx_utils') ),
					"dependency" => array(
						'scroll' => array('yes')
					),
					"value" => "hide",
					"type" => "checklist",
					"options" => diveit_get_sc_param('controls')
				),
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'trx_utils'),
					"desc" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"options" => diveit_get_sc_param('schemes')
				),
				"color" => array(
					"title" => esc_html__("Fore color", 'trx_utils'),
					"desc" => wp_kses_data( __("Any color for objects in this section", 'trx_utils') ),
					"divider" => true,
					"value" => "",
					"type" => "color"
				),
				"bg_color" => array(
					"title" => esc_html__("Background color", 'trx_utils'),
					"desc" => wp_kses_data( __("Any background color for this section", 'trx_utils') ),
					"value" => "",
					"type" => "color"
				),
				"bg_image" => array(
					"title" => esc_html__("Background image URL", 'trx_utils'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site for the background", 'trx_utils') ),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"bg_tile" => array(
					"title" => esc_html__("Tile background image", 'trx_utils'),
					"desc" => wp_kses_data( __("Do you want tile background image or image cover whole block?", 'trx_utils') ),
					"value" => "no",
					"dependency" => array(
						'bg_image' => array('not_empty')
					),
					"type" => "switch",
					"options" => diveit_get_sc_param('yes_no')
				),
				"bg_overlay" => array(
					"title" => esc_html__("Overlay", 'trx_utils'),
					"desc" => wp_kses_data( __("Overlay color opacity (from 0.0 to 1.0)", 'trx_utils') ),
					"min" => "0",
					"max" => "1",
					"step" => "0.1",
					"value" => "0",
					"type" => "spinner"
				),
				"bg_texture" => array(
					"title" => esc_html__("Texture", 'trx_utils'),
					"desc" => wp_kses_data( __("Predefined texture style from 1 to 11. 0 - without texture.", 'trx_utils') ),
					"min" => "0",
					"max" => "11",
					"step" => "1",
					"value" => "0",
					"type" => "spinner"
				),
				"bg_padding" => array(
					"title" => esc_html__("Paddings around content", 'trx_utils'),
					"desc" => wp_kses_data( __("Add paddings around content in this section (only if bg_color or bg_image enabled).", 'trx_utils') ),
					"value" => "yes",
					"dependency" => array(
						'compare' => 'or',
						'bg_color' => array('not_empty'),
						'bg_texture' => array('not_empty'),
						'bg_image' => array('not_empty')
					),
					"type" => "switch",
					"options" => diveit_get_sc_param('yes_no')
				),
				"font_size" => array(
					"title" => esc_html__("Font size", 'trx_utils'),
					"desc" => wp_kses_data( __("Font size of the text (default - in pixels, allows any CSS units of measure)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"font_weight" => array(
					"title" => esc_html__("Font weight", 'trx_utils'),
					"desc" => wp_kses_data( __("Font weight of the text", 'trx_utils') ),
					"value" => "",
					"type" => "select",
					"size" => "medium",
					"options" => array(
						'100' => esc_html__('Thin (100)', 'trx_utils'),
						'300' => esc_html__('Light (300)', 'trx_utils'),
						'400' => esc_html__('Normal (400)', 'trx_utils'),
						'700' => esc_html__('Bold (700)', 'trx_utils')
					)
				),
				"_content_" => array(
					"title" => esc_html__("Container content", 'trx_utils'),
					"desc" => wp_kses_data( __("Content for section container", 'trx_utils') ),
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
		);
		diveit_sc_map("trx_block", $sc);
		$sc["title"] = esc_html__("Section container", 'trx_utils');
		$sc["desc"] = esc_html__("Container for any section ([trx_block] analog - to enable nesting)", 'trx_utils');
		diveit_sc_map("trx_section", $sc);
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'diveit_sc_section_reg_shortcodes_vc' ) ) {
	//add_action('diveit_action_shortcodes_list_vc', 'diveit_sc_section_reg_shortcodes_vc');
	function diveit_sc_section_reg_shortcodes_vc() {
	
		$sc = array(
			"base" => "trx_block",
			"name" => esc_html__("Block container", 'trx_utils'),
			"description" => wp_kses_data( __("Container for any block ([trx_section] analog - to enable nesting)", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_block',
			"class" => "trx_sc_collection trx_sc_block",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "dedicated",
					"heading" => esc_html__("Dedicated", 'trx_utils'),
					"description" => wp_kses_data( __("Use this block as dedicated content - show it before post title on single page", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(esc_html__('Use as dedicated content', 'trx_utils') => 'yes'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Select block alignment", 'trx_utils') ),
					"class" => "",
					"value" => array_flip(diveit_get_sc_param('align')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "columns",
					"heading" => esc_html__("Columns emulation", 'trx_utils'),
					"description" => wp_kses_data( __("Select width for columns emulation", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(diveit_get_sc_param('columns')),
					"type" => "dropdown"
				),
                array(
                    "param_name" => "style_color",
                    "heading" => esc_html__("Sections header style color", 'trx_utils'),
                    "description" => wp_kses_data( __("Select style color to display sections header", 'trx_utils') ),
                    "admin_label" => true,
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => array(
                        esc_html__('Links hover color', 'trx_utils') => 'style_header_original',
                        esc_html__('Links color', 'trx_utils') => 'style_header_light'

                    ),
                    "type" => "dropdown"
                ),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'trx_utils'),
					"description" => wp_kses_data( __("Title for the block", 'trx_utils') ),
					"admin_label" => true,
					"group" => esc_html__('Captions', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Button URL", 'trx_utils'),
					"description" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'trx_utils') ),
					"group" => esc_html__('Captions', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "pan",
					"heading" => esc_html__("Use pan effect", 'trx_utils'),
					"description" => wp_kses_data( __("Use pan effect to show section content", 'trx_utils') ),
					"group" => esc_html__('Scroll', 'trx_utils'),
					"class" => "",
					"value" => array(esc_html__('Content scroller', 'trx_utils') => 'yes'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "scroll",
					"heading" => esc_html__("Use scroller", 'trx_utils'),
					"description" => wp_kses_data( __("Use scroller to show section content", 'trx_utils') ),
					"group" => esc_html__('Scroll', 'trx_utils'),
					"admin_label" => true,
					"class" => "",
					"value" => array(esc_html__('Content scroller', 'trx_utils') => 'yes'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "scroll_dir",
					"heading" => esc_html__("Scroll direction", 'trx_utils'),
					"description" => wp_kses_data( __("Scroll direction (if Use scroller = yes)", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"group" => esc_html__('Scroll', 'trx_utils'),
					"value" => array_flip(diveit_get_sc_param('dir')),
					'dependency' => array(
						'element' => 'scroll',
						'not_empty' => true
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "scroll_controls",
					"heading" => esc_html__("Scroll controls", 'trx_utils'),
					"description" => wp_kses_data( __("Show scroll controls (if Use scroller = yes)", 'trx_utils') ),
					"class" => "",
					"group" => esc_html__('Scroll', 'trx_utils'),
					'dependency' => array(
						'element' => 'scroll',
						'not_empty' => true
					),
					"value" => array_flip(diveit_get_sc_param('controls')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'trx_utils'),
					"description" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => array_flip(diveit_get_sc_param('schemes')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Fore color", 'trx_utils'),
					"description" => wp_kses_data( __("Any color for objects in this section", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Background color", 'trx_utils'),
					"description" => wp_kses_data( __("Any background color for this section", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_image",
					"heading" => esc_html__("Background image URL", 'trx_utils'),
					"description" => wp_kses_data( __("Select background image from library for this section", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "bg_tile",
					"heading" => esc_html__("Tile background image", 'trx_utils'),
					"description" => wp_kses_data( __("Do you want tile background image or image cover whole block?", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					'dependency' => array(
						'element' => 'bg_image',
						'not_empty' => true
					),
					"std" => "no",
					"value" => array(esc_html__('Tile background image', 'trx_utils') => 'yes'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "bg_overlay",
					"heading" => esc_html__("Overlay", 'trx_utils'),
					"description" => wp_kses_data( __("Overlay color opacity (from 0.0 to 1.0)", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_texture",
					"heading" => esc_html__("Texture", 'trx_utils'),
					"description" => wp_kses_data( __("Texture style from 1 to 11. Empty or 0 - without texture.", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_padding",
					"heading" => esc_html__("Paddings around content", 'trx_utils'),
					"description" => wp_kses_data( __("Add paddings around content in this section (only if bg_color or bg_image enabled).", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					'dependency' => array(
						'element' => array('bg_color','bg_texture','bg_image'),
						'not_empty' => true
					),
					"std" => "yes",
					"value" => array(esc_html__('Disable padding around content in this block', 'trx_utils') => 'no'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "font_size",
					"heading" => esc_html__("Font size", 'trx_utils'),
					"description" => wp_kses_data( __("Font size of the text (default - in pixels, allows any CSS units of measure)", 'trx_utils') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "font_weight",
					"heading" => esc_html__("Font weight", 'trx_utils'),
					"description" => wp_kses_data( __("Font weight of the text", 'trx_utils') ),
					"class" => "",
					"value" => array(
						esc_html__('Default', 'trx_utils') => 'inherit',
						esc_html__('Thin (100)', 'trx_utils') => '100',
						esc_html__('Light (300)', 'trx_utils') => '300',
						esc_html__('Normal (400)', 'trx_utils') => '400',
						esc_html__('Bold (700)', 'trx_utils') => '700'
					),
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
		);
		
		// Block
		vc_map($sc);
		
		// Section
		$sc["base"] = 'trx_section';
		$sc["name"] = esc_html__("Section container", 'trx_utils');
		$sc["description"] = wp_kses_data( __("Container for any section ([trx_block] analog - to enable nesting)", 'trx_utils') );
		$sc["class"] = "trx_sc_collection trx_sc_section";
		$sc["icon"] = 'icon_trx_section';
		vc_map($sc);
		
		class WPBakeryShortCode_Trx_Block extends Diveit_VC_ShortCodeCollection {}
		class WPBakeryShortCode_Trx_Section extends Diveit_VC_ShortCodeCollection {}
	}
}
?>