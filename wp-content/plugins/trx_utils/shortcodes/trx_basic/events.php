<?php

// Register shortcode [trx_events] in the list

if (function_exists('diveit_exists_visual_composer') && diveit_exists_visual_composer())
    add_action('diveit_action_shortcodes_list',				'diveit_tribe_events_reg_shortcodes');
    add_action('diveit_action_shortcodes_list_vc',		'diveit_tribe_events_reg_shortcodes_vc');



// Shortcodes
//------------------------------------------------------------------------

/*
[trx_events id="unique_id" columns="4" count="4" style="events-1|events-2|..." title="Block title" subtitle="xxx" description="xxxxxx"]
*/
if ( !function_exists( 'diveit_sc_events' ) ) {
    function diveit_sc_events($atts, $content=null){
        if (diveit_in_shortcode_blogger()) return '';
        extract(diveit_html_decode(shortcode_atts(array(
            // Individual params
            "style" => "events-1",
            "columns" => 4,
            "slider" => "no",
            "slides_space" => 0,
            "controls" => "no",
            "interval" => "",
            "autoheight" => "no",
            "align" => "",
            "ids" => "",
            "cat" => "",
            "count" => 4,
            "offset" => "",
            "orderby" => "event_date",
            "order" => "asc",
            "readmore" => esc_html__('Read more', 'trx_utils'),
            "title" => "",
            "subtitle" => "",
            "description" => "",
            "link_caption" => esc_html__('Learn more', 'trx_utils'),
            "link" => '',
            "scheme" => '',
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

        if (empty($id)) $id = "sc_events_".str_replace('.', '', mt_rand());
        if (empty($width)) $width = "100%";
        if (!empty($height) && diveit_param_is_on($autoheight)) $autoheight = "no";
        if (empty($interval)) $interval = mt_rand(5000, 10000);

        $class .= ($class ? ' ' : '') . diveit_get_css_position_as_classes($top, $right, $bottom, $left);

        $ws = diveit_get_css_dimensions_from_values($width);
        $hs = diveit_get_css_dimensions_from_values('', $height);
        $css .= ($hs) . ($ws);

        $count = max(1, (int) $count);
        $columns = max(1, min(12, (int) $columns));
        if ($count < $columns) $columns = $count;

        if (diveit_param_is_on($slider)) diveit_enqueue_slider('swiper');

        $output = '<div' . ($id ? ' id="'.esc_attr($id).'_wrap"' : '')
            . ' class="sc_events_wrap'
            . ($scheme && !diveit_param_is_off($scheme) && !diveit_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '')
            .'">'
            . '<div' . ($id ? ' id="'.esc_attr($id).'"' : '')
            . ' class="sc_events'
            . ' sc_events_style_'.esc_attr($style)
            . ' ' . esc_attr(diveit_get_template_property($style, 'container_classes'))
            . (!empty($class) ? ' '.esc_attr($class) : '')
            . ($align!='' && $align!='none' ? ' align'.esc_attr($align) : '')
            . '"'
            . ($css!='' ? ' style="'.esc_attr($css).'"' : '')
            . (!diveit_param_is_off($animation) ? ' data-animation="'.esc_attr(diveit_get_animation_classes($animation)).'"' : '')
            . '>'
            . (!empty($subtitle) ? '<h6 class="sc_events_subtitle sc_item_subtitle">' . trim(diveit_strmacros($subtitle)) . '</h6>' : '')
            . (!empty($title) ? '<h2 class="sc_events_title sc_item_title">' . trim(diveit_strmacros($title)) . '</h2>' : '')
            . (!empty($description) ? '<div class="sc_events_descr sc_item_descr">' . trim(diveit_strmacros($description)) . '</div>' : '')
            . (diveit_param_is_on($slider)
                ? ('<div class="sc_slider_swiper swiper-slider-container'
                    . ' ' . esc_attr(diveit_get_slider_controls_classes($controls))
                    . (diveit_param_is_on($autoheight) ? ' sc_slider_height_auto' : '')
                    . ($hs ? ' sc_slider_height_fixed' : '')
                    . '"'
                    . (!empty($width) && diveit_strpos($width, '%')===false ? ' data-old-width="' . esc_attr($width) . '"' : '')
                    . (!empty($height) && diveit_strpos($height, '%')===false ? ' data-old-height="' . esc_attr($height) . '"' : '')
                    . ((int) $interval > 0 ? ' data-interval="'.esc_attr($interval).'"' : '')
                    . ($columns > 1 ? ' data-slides-per-view="' . esc_attr($columns) . '"' : '')
                    . ($slides_space > 0 ? ' data-slides-space="' . esc_attr($slides_space) . '"' : '')
                    . '>'
                    . '<div class="slides swiper-wrapper">')
                : ($columns > 1
                    ? '<div class="sc_columns columns_wrap">'
                    : '')
            );

        $content = do_shortcode($content);

        global $post;

        if (!empty($ids)) {
            $posts = explode(',', $ids);
            $count = count($posts);
        }

        $args = array(
            'post_type' => Tribe__Events__Main::POSTTYPE,
            'post_status' => 'publish',
            'posts_per_page' => $count,
            'ignore_sticky_posts' => true,
            'tribe_suppress_query_filters' => true,   // Disable all filters from Tribe Events plugin
            'order' => $order=='asc' ? 'asc' : 'desc',
            'readmore' => $readmore
        );

        if ($offset > 0 && empty($ids)) {
            $args['offset'] = $offset;
        }

        $args = diveit_query_add_sort_order($args, $orderby, $order);
        $args = diveit_query_add_posts_and_cats($args, $ids, Tribe__Events__Main::POSTTYPE, $cat, Tribe__Events__Main::TAXONOMY);
        $query = new WP_Query( $args );

        $post_number = 0;

        while ( $query->have_posts() ) {
            $query->the_post();
            $post_number++;
            $args = array(
                'layout' => $style,
                'show' => false,
                'number' => $post_number,
                'posts_on_page' => ($count > 0 ? $count : $query->found_posts),
                "descr" => diveit_get_custom_option('post_excerpt_maxlength'.($columns > 1 ? '_masonry' : '')),
                "orderby" => $orderby,
                'content' => false,
                'terms_list' => false,
                'readmore' => $readmore,
                'columns_count' => $columns,
                'slider' => $slider,
                'tag_id' => $id ? $id . '_' . $post_number : '',
                'tag_class' => '',
                'tag_animation' => '',
                'tag_css' => '',
                'tag_css_wh' => $ws . $hs
            );
            $output .= diveit_show_post_layout($args);
        }
        wp_reset_postdata();

        if (diveit_param_is_on($slider)) {
            $output .= '</div>'
                . '<div class="sc_slider_controls_wrap"><a class="sc_slider_prev" href="#"></a><a class="sc_slider_next" href="#"></a></div>'
                . '<div class="sc_slider_pagination_wrap"></div>'
                . '</div>';
        } else if ($columns > 1) {
            $output .= '</div>';
        }

        $output .=  (!empty($link) ? '<div class="sc_events_button sc_item_button">'.diveit_do_shortcode('[trx_button link="'.esc_url($link).'" icon="icon-right"]'.esc_html($link_caption).'[/trx_button]').'</div>' : '')
            . '</div><!-- /.sc_events -->'
            . '</div><!-- /.sc_envents_wrap -->';

        // Add template specific scripts and styles
        do_action('diveit_action_blog_scripts', $style);

        return apply_filters('diveit_shortcode_output', $output, 'trx_events', $atts, $content);
    }
    add_shortcode('trx_events', 'diveit_sc_events');
}
// ---------------------------------- [/trx_events] ---------------------------------------



// Add [trx_events] in the shortcodes list
if (!function_exists('diveit_tribe_events_reg_shortcodes')) {
    function diveit_tribe_events_reg_shortcodes() {
        if (diveit_storage_isset('shortcodes')) {

            if (!trx_utils_exists_tribe_events()) return '';

            $groups		= diveit_get_list_terms(false, Tribe__Events__Main::TAXONOMY);
            $styles		= diveit_get_list_templates('events');
            $sorting	= array(
                "event_date"=> esc_html__("Start Date", 'trx_utils'),
                "title" 	=> esc_html__("Alphabetically", 'trx_utils'),
                "random"	=> esc_html__("Random", 'trx_utils')
            );
            $controls	= diveit_get_list_slider_controls();

            diveit_sc_map_before('trx_form', "trx_events", array(
                    "title" => esc_html__("Events", 'trx_utils'),
                    "desc" => esc_html__("Insert events list in your page (post)", 'trx_utils'),
                    "decorate" => true,
                    "container" => false,
                    "params" => array(
                        "title" => array(
                            "title" => esc_html__("Title", 'trx_utils'),
                            "desc" => esc_html__("Title for the block", 'trx_utils'),
                            "value" => "",
                            "type" => "text"
                        ),
                        "subtitle" => array(
                            "title" => esc_html__("Subtitle", 'trx_utils'),
                            "desc" => esc_html__("Subtitle for the block", 'trx_utils'),
                            "value" => "",
                            "type" => "text"
                        ),
                        "description" => array(
                            "title" => esc_html__("Description", 'trx_utils'),
                            "desc" => esc_html__("Short description for the block", 'trx_utils'),
                            "value" => "",
                            "type" => "textarea"
                        ),
                        "style" => array(
                            "title" => esc_html__("Style", 'trx_utils'),
                            "desc" => esc_html__("Select style to display events list", 'trx_utils'),
                            "value" => "events-1",
                            "type" => "select",
                            "options" => $styles
                        ),
                        "columns" => array(
                            "title" => esc_html__("Columns", 'trx_utils'),
                            "desc" => esc_html__("How many columns use to show events list", 'trx_utils'),
                            "value" => 4,
                            "min" => 2,
                            "max" => 6,
                            "step" => 1,
                            "type" => "spinner"
                        ),
                        "scheme" => array(
                            "title" => esc_html__("Color scheme", 'trx_utils'),
                            "desc" => esc_html__("Select color scheme for this block", 'trx_utils'),
                            "value" => "",
                            "type" => "checklist",
                            "options" => diveit_get_sc_param('schemes')
                        ),
                        "slider" => array(
                            "title" => esc_html__("Slider", 'trx_utils'),
                            "desc" => esc_html__("Use slider to show events", 'trx_utils'),
                            "dependency" => array(
                                'style' => array('events-1')
                            ),
                            "value" => "no",
                            "type" => "switch",
                            "options" => diveit_get_sc_param('yes_no')
                        ),
                        "controls" => array(
                            "title" => esc_html__("Controls", 'trx_utils'),
                            "desc" => esc_html__("Slider controls style and position", 'trx_utils'),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => $controls
                        ),
                        "slides_space" => array(
                            "title" => esc_html__("Space between slides", 'trx_utils'),
                            "desc" => esc_html__("Size of space (in px) between slides", 'trx_utils'),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => 0,
                            "min" => 0,
                            "max" => 100,
                            "step" => 10,
                            "type" => "spinner"
                        ),
                        "interval" => array(
                            "title" => esc_html__("Slides change interval", 'trx_utils'),
                            "desc" => esc_html__("Slides change interval (in milliseconds: 1000ms = 1s)", 'trx_utils'),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => 7000,
                            "step" => 500,
                            "min" => 0,
                            "type" => "spinner"
                        ),
                        "autoheight" => array(
                            "title" => esc_html__("Autoheight", 'trx_utils'),
                            "desc" => esc_html__("Change whole slider's height (make it equal current slide's height)", 'trx_utils'),
                            "dependency" => array(
                                'slider' => array('yes')
                            ),
                            "value" => "yes",
                            "type" => "switch",
                            "options" => diveit_get_sc_param('yes_no')
                        ),
                        "align" => array(
                            "title" => esc_html__("Alignment", 'trx_utils'),
                            "desc" => esc_html__("Alignment of the events block", 'trx_utils'),
                            "divider" => true,
                            "value" => "",
                            "type" => "checklist",
                            "dir" => "horizontal",
                            "options" => diveit_get_sc_param('align')
                        ),
                        "cat" => array(
                            "title" => esc_html__("Categories", 'trx_utils'),
                            "desc" => esc_html__("Select categories (groups) to show events list. If empty - select events from any category (group) or from IDs list", 'trx_utils'),
                            "divider" => true,
                            "value" => "",
                            "type" => "select",
                            "style" => "list",
                            "multiple" => true,
                            "options" => diveit_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $groups)
                        ),
                        "count" => array(
                            "title" => esc_html__("Number of posts", 'trx_utils'),
                            "desc" => esc_html__("How many posts will be displayed? If used IDs - this parameter ignored.", 'trx_utils'),
                            "value" => 4,
                            "min" => 1,
                            "max" => 100,
                            "type" => "spinner"
                        ),
                        "offset" => array(
                            "title" => esc_html__("Offset before select posts", 'trx_utils'),
                            "desc" => esc_html__("Skip posts before select next part.", 'trx_utils'),
                            "value" => 0,
                            "min" => 0,
                            "type" => "spinner"
                        ),
                        "orderby" => array(
                            "title" => esc_html__("Post order by", 'trx_utils'),
                            "desc" => esc_html__("Select desired posts sorting method", 'trx_utils'),
                            "value" => "title",
                            "type" => "select",
                            "options" => $sorting
                        ),
                        "order" => array(
                            "title" => esc_html__("Post order", 'trx_utils'),
                            "desc" => esc_html__("Select desired posts order", 'trx_utils'),
                            "value" => "asc",
                            "type" => "switch",
                            "size" => "big",
                            "options" => diveit_get_sc_param('ordering')
                        ),
                        "ids" => array(
                            "title" => esc_html__("Post IDs list", 'trx_utils'),
                            "desc" => esc_html__("Comma separated list of posts ID. If set - parameters above are ignored!", 'trx_utils'),
                            "value" => "",
                            "type" => "text"
                        ),
                        "readmore" => array(
                            "title" => esc_html__("Read more", 'trx_utils'),
                            "desc" => esc_html__("Caption for the Read more link (if empty - link not showed)", 'trx_utils'),
                            "value" => "",
                            "type" => "text"
                        ),
                        "link" => array(
                            "title" => esc_html__("Button URL", 'trx_utils'),
                            "desc" => esc_html__("Link URL for the button at the bottom of the block", 'trx_utils'),
                            "value" => "",
                            "type" => "text"
                        ),
                        "link_caption" => array(
                            "title" => esc_html__("Button caption", 'trx_utils'),
                            "desc" => esc_html__("Caption for the button at the bottom of the block", 'trx_utils'),
                            "value" => "",
                            "type" => "text"
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
                )
            );
        }
    }
}


// Add [trx_events] in the VC shortcodes list
if (!function_exists('diveit_tribe_events_reg_shortcodes_vc')) {
    function diveit_tribe_events_reg_shortcodes_vc() {

        if (!trx_utils_exists_tribe_events()) return '';

        $groups		= diveit_get_list_terms(false, Tribe__Events__Main::TAXONOMY);
        $styles		= diveit_get_list_templates('events');
        $sorting	= array(
            "event_date"=> esc_html__("Start Date", 'trx_utils'),
            "title" 	=> esc_html__("Alphabetically", 'trx_utils'),
            "random"	=> esc_html__("Random", 'trx_utils')
        );
        $controls	= diveit_get_list_slider_controls();

        // Events
        vc_map( array(
            "base" => "trx_events",
            "name" => esc_html__("Events", 'trx_utils'),
            "description" => esc_html__("Insert events list", 'trx_utils'),
            "category" => esc_html__('Content', 'trx_utils'),
            "icon" => 'icon_trx_events',
            "class" => "trx_sc_single trx_sc_events",
            "content_element" => true,
            "is_container" => false,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "param_name" => "style",
                    "heading" => esc_html__("Style", 'trx_utils'),
                    "description" => esc_html__("Select style to display events list", 'trx_utils'),
                    "class" => "",
                    "admin_label" => true,
                    "std" => "events-1",
                    "value" => array_flip($styles),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "scheme",
                    "heading" => esc_html__("Color scheme", 'trx_utils'),
                    "description" => esc_html__("Select color scheme for this block", 'trx_utils'),
                    "admin_label" => true,
                    "class" => "",
                    "value" => array_flip(diveit_get_sc_param('schemes')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slider",
                    "heading" => esc_html__("Slider", 'trx_utils'),
                    "description" => esc_html__("Use slider to show events", 'trx_utils'),
                    "admin_label" => true,
                    'dependency' => array(
                        'element' => 'style',
                        'value' => 'events-1'
                    ),
                    "group" => esc_html__('Slider', 'trx_utils'),
                    "class" => "",
                    "std" => "no",
                    "value" => array_flip(diveit_get_sc_param('yes_no')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "controls",
                    "heading" => esc_html__("Controls", 'trx_utils'),
                    "description" => esc_html__("Slider controls style and position", 'trx_utils'),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "std" => "no",
                    "value" => array_flip($controls),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "slides_space",
                    "heading" => esc_html__("Space between slides", 'trx_utils'),
                    "description" => esc_html__("Size of space (in px) between slides", 'trx_utils'),
                    "admin_label" => true,
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => "0",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "interval",
                    "heading" => esc_html__("Slides change interval", 'trx_utils'),
                    "description" => esc_html__("Slides change interval (in milliseconds: 1000ms = 1s)", 'trx_utils'),
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => "7000",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "autoheight",
                    "heading" => esc_html__("Autoheight", 'trx_utils'),
                    "description" => esc_html__("Change whole slider's height (make it equal current slide's height)", 'trx_utils'),
                    "group" => esc_html__('Slider', 'trx_utils'),
                    'dependency' => array(
                        'element' => 'slider',
                        'value' => 'yes'
                    ),
                    "class" => "",
                    "value" => array("Autoheight" => "yes" ),
                    "type" => "checkbox"
                ),
                array(
                    "param_name" => "align",
                    "heading" => esc_html__("Alignment", 'trx_utils'),
                    "description" => esc_html__("Alignment of the events block", 'trx_utils'),
                    "class" => "",
                    "value" => array_flip(diveit_get_sc_param('align')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'trx_utils'),
                    "description" => esc_html__("Title for the block", 'trx_utils'),
                    "admin_label" => true,
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "subtitle",
                    "heading" => esc_html__("Subtitle", 'trx_utils'),
                    "description" => esc_html__("Subtitle for the block", 'trx_utils'),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "description",
                    "heading" => esc_html__("Description", 'trx_utils'),
                    "description" => esc_html__("Description for the block", 'trx_utils'),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textarea"
                ),
                array(
                    "param_name" => "cat",
                    "heading" => esc_html__("Categories", 'trx_utils'),
                    "description" => esc_html__("Select category to show events. If empty - select events from any category (group) or from IDs list", 'trx_utils'),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "class" => "",
                    "value" => array_flip(diveit_array_merge(array(0 => esc_html__('- Select category -', 'trx_utils')), $groups)),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "columns",
                    "heading" => esc_html__("Columns", 'trx_utils'),
                    "description" => esc_html__("How many columns use to show events list", 'trx_utils'),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "admin_label" => true,
                    "class" => "",
                    "value" => "4",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "count",
                    "heading" => esc_html__("Number of posts", 'trx_utils'),
                    "description" => esc_html__("How many posts will be displayed? If used IDs - this parameter ignored.", 'trx_utils'),
                    "admin_label" => true,
                    "group" => esc_html__('Query', 'trx_utils'),
                    "class" => "",
                    "value" => "4",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "offset",
                    "heading" => esc_html__("Offset before select posts", 'trx_utils'),
                    "description" => esc_html__("Skip posts before select next part.", 'trx_utils'),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "class" => "",
                    "value" => "0",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "orderby",
                    "heading" => esc_html__("Post sorting", 'trx_utils'),
                    "description" => esc_html__("Select desired posts sorting method", 'trx_utils'),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "class" => "",
                    "value" => array_flip($sorting),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "order",
                    "heading" => esc_html__("Post order", 'trx_utils'),
                    "description" => esc_html__("Select desired posts order", 'trx_utils'),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "class" => "",
                    "value" => array_flip(diveit_get_sc_param('ordering')),
                    "type" => "dropdown"
                ),
                array(
                    "param_name" => "ids",
                    "heading" => esc_html__("Event's IDs list", 'trx_utils'),
                    "description" => esc_html__("Comma separated list of event's ID. If set - parameters above (category, count, order, etc.)  are ignored!", 'trx_utils'),
                    "group" => esc_html__('Query', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "readmore",
                    "heading" => esc_html__("Read more", 'trx_utils'),
                    "description" => esc_html__("Caption for the Read more link (if empty - link not showed)", 'trx_utils'),
                    "admin_label" => true,
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link",
                    "heading" => esc_html__("Button URL", 'trx_utils'),
                    "description" => esc_html__("Link URL for the button at the bottom of the block", 'trx_utils'),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                array(
                    "param_name" => "link_caption",
                    "heading" => esc_html__("Button caption", 'trx_utils'),
                    "description" => esc_html__("Caption for the button at the bottom of the block", 'trx_utils'),
                    "group" => esc_html__('Captions', 'trx_utils'),
                    "class" => "",
                    "value" => "",
                    "type" => "textfield"
                ),
                diveit_vc_width(),
                diveit_vc_height(),
                diveit_get_vc_param('margin_top'),
                diveit_get_vc_param('margin_bottom'),
                diveit_get_vc_param('margin_left'),
                diveit_get_vc_param('margin_right'),
                diveit_get_vc_param('id'),
                diveit_get_vc_param('class'),
                diveit_get_vc_param('animation'),
                diveit_get_vc_param('css')
            )
        ) );

        class WPBakeryShortCode_Trx_Events extends Diveit_VC_ShortCodeSingle {}

    }
}