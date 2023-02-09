<?php
/**
 * DiveIt Framework: return lists
 *
 * @package diveit
 * @since diveit 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return styles list
if ( !function_exists( 'diveit_get_list_styles' ) ) {
	function diveit_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'diveit'), $i);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the shortcodes margins
if ( !function_exists( 'diveit_get_list_margins' ) ) {
	function diveit_get_list_margins($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_margins'))=='') {
			$list = array(
				'null'		=> esc_html__('0 (No margin)',	'diveit'),
				'tiny'		=> esc_html__('Tiny',		'diveit'),
				'small'		=> esc_html__('Small',		'diveit'),
				'medium'	=> esc_html__('Medium',		'diveit'),
				'large'		=> esc_html__('Large',		'diveit'),
				'huge'		=> esc_html__('Huge',		'diveit'),
				'tiny-'		=> esc_html__('Tiny (negative)',	'diveit'),
				'small-'	=> esc_html__('Small (negative)',	'diveit'),
				'medium-'	=> esc_html__('Medium (negative)',	'diveit'),
				'large-'	=> esc_html__('Large (negative)',	'diveit'),
				'huge-'		=> esc_html__('Huge (negative)',	'diveit')
				);
			$list = apply_filters('diveit_filter_list_margins', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_margins', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the line styles
if ( !function_exists( 'diveit_get_list_line_styles' ) ) {
	function diveit_get_list_line_styles($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_line_styles'))=='') {
			$list = array(
				'solid'	=> esc_html__('Solid', 'diveit'),
				'dashed'=> esc_html__('Dashed', 'diveit'),
				'dotted'=> esc_html__('Dotted', 'diveit'),
				'double'=> esc_html__('Double', 'diveit'),
				'image'	=> esc_html__('Image', 'diveit')
				);
			$list = apply_filters('diveit_filter_list_line_styles', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_line_styles', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the animations
if ( !function_exists( 'diveit_get_list_animations' ) ) {
	function diveit_get_list_animations($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_animations'))=='') {
			$list = array(
				'none'			=> esc_html__('- None -',	'diveit'),
				'bounce'		=> esc_html__('Bounce',		'diveit'),
				'elastic'		=> esc_html__('Elastic',	'diveit'),
				'flash'			=> esc_html__('Flash',		'diveit'),
				'flip'			=> esc_html__('Flip',		'diveit'),
				'pulse'			=> esc_html__('Pulse',		'diveit'),
				'rubberBand'	=> esc_html__('Rubber Band','diveit'),
				'shake'			=> esc_html__('Shake',		'diveit'),
				'swing'			=> esc_html__('Swing',		'diveit'),
				'tada'			=> esc_html__('Tada',		'diveit'),
				'wobble'		=> esc_html__('Wobble',		'diveit')
				);
			$list = apply_filters('diveit_filter_list_animations', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_animations', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'diveit_get_list_animations_in' ) ) {
	function diveit_get_list_animations_in($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_animations_in'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'diveit'),
				'bounceIn'			=> esc_html__('Bounce In',			'diveit'),
				'bounceInUp'		=> esc_html__('Bounce In Up',		'diveit'),
				'bounceInDown'		=> esc_html__('Bounce In Down',		'diveit'),
				'bounceInLeft'		=> esc_html__('Bounce In Left',		'diveit'),
				'bounceInRight'		=> esc_html__('Bounce In Right',	'diveit'),
				'elastic'			=> esc_html__('Elastic In',			'diveit'),
				'fadeIn'			=> esc_html__('Fade In',			'diveit'),
				'fadeInUp'			=> esc_html__('Fade In Up',			'diveit'),
				'fadeInUpSmall'		=> esc_html__('Fade In Up Small',	'diveit'),
				'fadeInUpBig'		=> esc_html__('Fade In Up Big',		'diveit'),
				'fadeInDown'		=> esc_html__('Fade In Down',		'diveit'),
				'fadeInDownBig'		=> esc_html__('Fade In Down Big',	'diveit'),
				'fadeInLeft'		=> esc_html__('Fade In Left',		'diveit'),
				'fadeInLeftBig'		=> esc_html__('Fade In Left Big',	'diveit'),
				'fadeInRight'		=> esc_html__('Fade In Right',		'diveit'),
				'fadeInRightBig'	=> esc_html__('Fade In Right Big',	'diveit'),
				'flipInX'			=> esc_html__('Flip In X',			'diveit'),
				'flipInY'			=> esc_html__('Flip In Y',			'diveit'),
				'lightSpeedIn'		=> esc_html__('Light Speed In',		'diveit'),
				'rotateIn'			=> esc_html__('Rotate In',			'diveit'),
				'rotateInUpLeft'	=> esc_html__('Rotate In Down Left','diveit'),
				'rotateInUpRight'	=> esc_html__('Rotate In Up Right',	'diveit'),
				'rotateInDownLeft'	=> esc_html__('Rotate In Up Left',	'diveit'),
				'rotateInDownRight'	=> esc_html__('Rotate In Down Right','diveit'),
				'rollIn'			=> esc_html__('Roll In',			'diveit'),
				'slideInUp'			=> esc_html__('Slide In Up',		'diveit'),
				'slideInDown'		=> esc_html__('Slide In Down',		'diveit'),
				'slideInLeft'		=> esc_html__('Slide In Left',		'diveit'),
				'slideInRight'		=> esc_html__('Slide In Right',		'diveit'),
				'wipeInLeftTop'		=> esc_html__('Wipe In Left Top',	'diveit'),
				'zoomIn'			=> esc_html__('Zoom In',			'diveit'),
				'zoomInUp'			=> esc_html__('Zoom In Up',			'diveit'),
				'zoomInDown'		=> esc_html__('Zoom In Down',		'diveit'),
				'zoomInLeft'		=> esc_html__('Zoom In Left',		'diveit'),
				'zoomInRight'		=> esc_html__('Zoom In Right',		'diveit')
				);
			$list = apply_filters('diveit_filter_list_animations_in', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_animations_in', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'diveit_get_list_animations_out' ) ) {
	function diveit_get_list_animations_out($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_animations_out'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'diveit'),
				'bounceOut'			=> esc_html__('Bounce Out',			'diveit'),
				'bounceOutUp'		=> esc_html__('Bounce Out Up',		'diveit'),
				'bounceOutDown'		=> esc_html__('Bounce Out Down',	'diveit'),
				'bounceOutLeft'		=> esc_html__('Bounce Out Left',	'diveit'),
				'bounceOutRight'	=> esc_html__('Bounce Out Right',	'diveit'),
				'fadeOut'			=> esc_html__('Fade Out',			'diveit'),
				'fadeOutUp'			=> esc_html__('Fade Out Up',		'diveit'),
				'fadeOutUpBig'		=> esc_html__('Fade Out Up Big',	'diveit'),
				'fadeOutDown'		=> esc_html__('Fade Out Down',		'diveit'),
				'fadeOutDownSmall'	=> esc_html__('Fade Out Down Small','diveit'),
				'fadeOutDownBig'	=> esc_html__('Fade Out Down Big',	'diveit'),
				'fadeOutLeft'		=> esc_html__('Fade Out Left',		'diveit'),
				'fadeOutLeftBig'	=> esc_html__('Fade Out Left Big',	'diveit'),
				'fadeOutRight'		=> esc_html__('Fade Out Right',		'diveit'),
				'fadeOutRightBig'	=> esc_html__('Fade Out Right Big',	'diveit'),
				'flipOutX'			=> esc_html__('Flip Out X',			'diveit'),
				'flipOutY'			=> esc_html__('Flip Out Y',			'diveit'),
				'hinge'				=> esc_html__('Hinge Out',			'diveit'),
				'lightSpeedOut'		=> esc_html__('Light Speed Out',	'diveit'),
				'rotateOut'			=> esc_html__('Rotate Out',			'diveit'),
				'rotateOutUpLeft'	=> esc_html__('Rotate Out Down Left','diveit'),
				'rotateOutUpRight'	=> esc_html__('Rotate Out Up Right','diveit'),
				'rotateOutDownLeft'	=> esc_html__('Rotate Out Up Left',	'diveit'),
				'rotateOutDownRight'=> esc_html__('Rotate Out Down Right','diveit'),
				'rollOut'			=> esc_html__('Roll Out',			'diveit'),
				'slideOutUp'		=> esc_html__('Slide Out Up',		'diveit'),
				'slideOutDown'		=> esc_html__('Slide Out Down',		'diveit'),
				'slideOutLeft'		=> esc_html__('Slide Out Left',		'diveit'),
				'slideOutRight'		=> esc_html__('Slide Out Right',	'diveit'),
				'zoomOut'			=> esc_html__('Zoom Out',			'diveit'),
				'zoomOutUp'			=> esc_html__('Zoom Out Up',		'diveit'),
				'zoomOutDown'		=> esc_html__('Zoom Out Down',		'diveit'),
				'zoomOutLeft'		=> esc_html__('Zoom Out Left',		'diveit'),
				'zoomOutRight'		=> esc_html__('Zoom Out Right',		'diveit')
				);
			$list = apply_filters('diveit_filter_list_animations_out', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_animations_out', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return classes list for the specified animation
if (!function_exists('diveit_get_animation_classes')) {
	function diveit_get_animation_classes($animation, $speed='normal', $loop='none') {
		return diveit_param_is_off($animation) ? '' : 'animated '.esc_attr($animation).' '.esc_attr($speed).(!diveit_param_is_off($loop) ? ' '.esc_attr($loop) : '');
	}
}


// Return list of the main menu hover effects
if ( !function_exists( 'diveit_get_list_menu_hovers' ) ) {
	function diveit_get_list_menu_hovers($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_menu_hovers'))=='') {
			$list = array(
				'fade'			=> esc_html__('Fade',		'diveit'),
				'slide_line'	=> esc_html__('Slide Line',	'diveit'),
				'slide_box'		=> esc_html__('Slide Box',	'diveit'),
				'zoom_line'		=> esc_html__('Zoom Line',	'diveit'),
				'path_line'		=> esc_html__('Path Line',	'diveit'),
				'roll_down'		=> esc_html__('Roll Down',	'diveit'),
				'color_line'	=> esc_html__('Color Line',	'diveit'),
				);
			$list = apply_filters('diveit_filter_list_menu_hovers', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_menu_hovers', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the button's hover effects
if ( !function_exists( 'diveit_get_list_button_hovers' ) ) {
	function diveit_get_list_button_hovers($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_button_hovers'))=='') {
			$list = array(
				'fade'			=> esc_html__('Fade',				'diveit'),
				'slide_left'	=> esc_html__('Slide from Left',	'diveit'),
				'slide_top'		=> esc_html__('Slide from Top',		'diveit'),
				'arrow'			=> esc_html__('Arrow',				'diveit'),
				);
			$list = apply_filters('diveit_filter_list_button_hovers', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_button_hovers', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the input field's hover effects
if ( !function_exists( 'diveit_get_list_input_hovers' ) ) {
	function diveit_get_list_input_hovers($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_input_hovers'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'diveit'),
				'accent'	=> esc_html__('Accented',	'diveit'),
				'path'		=> esc_html__('Path',		'diveit'),
				'jump'		=> esc_html__('Jump',		'diveit'),
				'underline'	=> esc_html__('Underline',	'diveit'),
				'iconed'	=> esc_html__('Iconed',		'diveit'),
				);
			$list = apply_filters('diveit_filter_list_input_hovers', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_input_hovers', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the search field's styles
if ( !function_exists( 'diveit_get_list_search_styles' ) ) {
	function diveit_get_list_search_styles($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_search_styles'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'diveit'),
				'fullscreen'=> esc_html__('Fullscreen',	'diveit'),
				'slide'		=> esc_html__('Slide',		'diveit'),
				'expand'	=> esc_html__('Expand',		'diveit'),
				);
			$list = apply_filters('diveit_filter_list_search_styles', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_search_styles', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'diveit_get_list_categories' ) ) {
	function diveit_get_list_categories($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_categories'))=='') {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'diveit_get_list_terms' ) ) {
	function diveit_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = diveit_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			if ( is_array($taxonomy) || taxonomy_exists($taxonomy) ) {
				$terms = get_terms( $taxonomy, array(
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $taxonomy,
					'pad_counts'               => false
					)
				);
			} else {
				$terms = diveit_get_terms_by_taxonomy_from_db($taxonomy);
			}
			if (!is_wp_error( $terms ) && is_array($terms) && count($terms) > 0) {
				foreach ($terms as $cat) {
					$list[$cat->term_id] = $cat->name;					}
			}
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'diveit_get_list_posts_types' ) ) {
	function diveit_get_list_posts_types($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_posts_types'))=='') {
			// Return only theme inheritance supported post types
            $list = array();
            $list = apply_filters('diveit_filter_list_post_types', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'diveit_get_list_posts' ) ) {
	function diveit_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (($list = diveit_storage_get($hash))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'diveit');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set($hash, $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list pages
if ( !function_exists( 'diveit_get_list_pages' ) ) {
	function diveit_get_list_pages($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'page',
			'post_status'		=> 'publish',
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'asc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));
		return diveit_get_list_posts($prepend_inherit, $opt);
	}
}


// Return list of registered users
if ( !function_exists( 'diveit_get_list_users' ) ) {
	function diveit_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = diveit_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'diveit');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_users', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return slider engines list, prepended inherit (if need)
if ( !function_exists( 'diveit_get_list_sliders' ) ) {
	function diveit_get_list_sliders($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_sliders'))=='') {
			$list = array(
				'swiper' => esc_html__("Posts slider (Swiper)", 'diveit')
			);
			$list = apply_filters('diveit_filter_list_sliders', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_sliders', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return slider controls list, prepended inherit (if need)
if ( !function_exists( 'diveit_get_list_slider_controls' ) ) {
	function diveit_get_list_slider_controls($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_slider_controls'))=='') {
			$list = array(
				'no'		=> esc_html__('None', 'diveit'),
				'side'		=> esc_html__('Side', 'diveit'),
				'bottom'	=> esc_html__('Bottom', 'diveit'),
				'pagination'=> esc_html__('Pagination', 'diveit')
				);
			$list = apply_filters('diveit_filter_list_slider_controls', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_slider_controls', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return slider controls classes
if ( !function_exists( 'diveit_get_slider_controls_classes' ) ) {
	function diveit_get_slider_controls_classes($controls) {
		if (diveit_param_is_off($controls))	$classes = 'sc_slider_nopagination sc_slider_nocontrols';
		else if ($controls=='bottom')			$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_bottom';
		else if ($controls=='pagination')		$classes = 'sc_slider_pagination sc_slider_pagination_bottom sc_slider_nocontrols';
		else									$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_side';
		return $classes;
	}
}

// Return list with popup engines
if ( !function_exists( 'diveit_get_list_popup_engines' ) ) {
	function diveit_get_list_popup_engines($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_popup_engines'))=='') {
			$list = array(
				"pretty"	=> esc_html__("Pretty photo", 'diveit'),
				"magnific"	=> esc_html__("Magnific popup", 'diveit')
				);
			$list = apply_filters('diveit_filter_list_popup_engines', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_popup_engines', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'diveit_get_list_menus' ) ) {
	function diveit_get_list_menus($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'diveit');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'diveit_get_list_sidebars' ) ) {
	function diveit_get_list_sidebars($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_sidebars'))=='') {
			if (($list = diveit_storage_get('registered_sidebars'))=='') $list = array();
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_sidebars', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'diveit_get_list_sidebars_positions' ) ) {
	function diveit_get_list_sidebars_positions($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_sidebars_positions'))=='') {
			$list = array(
				'none'  => esc_html__('Hide',  'diveit'),
				'left'  => esc_html__('Left',  'diveit'),
				'right' => esc_html__('Right', 'diveit')
				);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_sidebars_positions', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return sidebars class
if ( !function_exists( 'diveit_get_sidebar_class' ) ) {
	function diveit_get_sidebar_class() {
		$sb_main = diveit_get_custom_option('show_sidebar_main');
		$sb_outer = diveit_get_custom_option('show_sidebar_outer');
		return (diveit_param_is_off($sb_main) || !is_active_sidebar(diveit_get_custom_option('sidebar_main')) ? 'sidebar_hide' : 'sidebar_show sidebar_'.($sb_main))
				. ' ' . (diveit_param_is_off($sb_outer) ? 'sidebar_outer_hide' : 'sidebar_outer_show sidebar_outer_'.($sb_outer));
	}
}

// Return body styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_body_styles' ) ) {
	function diveit_get_list_body_styles($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_body_styles'))=='') {
			$list = array(
				'boxed'	=> esc_html__('Boxed',		'diveit'),
				'wide'	=> esc_html__('Wide',		'diveit')
				);
			if (diveit_get_theme_setting('allow_fullscreen')) {
				$list['fullwide']	= esc_html__('Fullwide',	'diveit');
				$list['fullscreen']	= esc_html__('Fullscreen',	'diveit');
			}
			$list = apply_filters('diveit_filter_list_body_styles', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_body_styles', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return templates list, prepended inherit
if ( !function_exists( 'diveit_get_list_templates' ) ) {
	function diveit_get_list_templates($mode='') {
		if (($list = diveit_storage_get('list_templates_'.($mode)))=='') {
			$list = array();
			$tpl = diveit_storage_get('registered_templates');
			if (is_array($tpl) && count($tpl) > 0) {
				foreach ($tpl as $k=>$v) {
					if ($mode=='' || in_array($mode, explode(',', $v['mode'])))
						$list[$k] = !empty($v['icon']) 
									? $v['icon'] 
									: (!empty($v['title']) 
										? $v['title'] 
										: diveit_strtoproper($v['layout'])
										);
				}
			}
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_templates_'.($mode), $list);
		}
		return $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_templates_blog' ) ) {
	function diveit_get_list_templates_blog($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_templates_blog'))=='') {
			$list = diveit_get_list_templates('blog');
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_templates_blog', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return blogger styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_templates_blogger' ) ) {
	function diveit_get_list_templates_blogger($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_templates_blogger'))=='') {
			$list = diveit_array_merge(diveit_get_list_templates('blogger'), diveit_get_list_templates('blog'));
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_templates_blogger', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return single page styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_templates_single' ) ) {
	function diveit_get_list_templates_single($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_templates_single'))=='') {
			$list = diveit_get_list_templates('single');
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_templates_single', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return header styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_templates_header' ) ) {
	function diveit_get_list_templates_header($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_templates_header'))=='') {
			$list = diveit_get_list_templates('header');
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_templates_header', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return form styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_templates_forms' ) ) {
	function diveit_get_list_templates_forms($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_templates_forms'))=='') {
			$list = diveit_get_list_templates('forms');
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_templates_forms', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return article styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_article_styles' ) ) {
	function diveit_get_list_article_styles($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_article_styles'))=='') {
			$list = array(
				"boxed"   => esc_html__('Boxed', 'diveit'),
				"stretch" => esc_html__('Stretch', 'diveit')
				);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_article_styles', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return post-formats filters list, prepended inherit
if ( !function_exists( 'diveit_get_list_post_formats_filters' ) ) {
	function diveit_get_list_post_formats_filters($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_post_formats_filters'))=='') {
			$list = array(
				"no"      => esc_html__('All posts', 'diveit'),
				"thumbs"  => esc_html__('With thumbs', 'diveit'),
				"reviews" => esc_html__('With reviews', 'diveit'),
				"video"   => esc_html__('With videos', 'diveit'),
				"audio"   => esc_html__('With audios', 'diveit'),
				"gallery" => esc_html__('With galleries', 'diveit')
				);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_post_formats_filters', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return portfolio filters list, prepended inherit
if ( !function_exists( 'diveit_get_list_portfolio_filters' ) ) {
	function diveit_get_list_portfolio_filters($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_portfolio_filters'))=='') {
			$list = array(
				"hide"		=> esc_html__('Hide', 'diveit'),
				"tags"		=> esc_html__('Tags', 'diveit'),
				"categories"=> esc_html__('Categories', 'diveit')
				);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_portfolio_filters', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return hover styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_hovers' ) ) {
	function diveit_get_list_hovers($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_hovers'))=='') {
			$list = array();
			$list['circle effect1']  = esc_html__('Circle Effect 1',  'diveit');
			$list['circle effect2']  = esc_html__('Circle Effect 2',  'diveit');
			$list['circle effect3']  = esc_html__('Circle Effect 3',  'diveit');
			$list['circle effect4']  = esc_html__('Circle Effect 4',  'diveit');
			$list['circle effect5']  = esc_html__('Circle Effect 5',  'diveit');
			$list['circle effect6']  = esc_html__('Circle Effect 6',  'diveit');
			$list['circle effect7']  = esc_html__('Circle Effect 7',  'diveit');
			$list['circle effect8']  = esc_html__('Circle Effect 8',  'diveit');
			$list['circle effect9']  = esc_html__('Circle Effect 9',  'diveit');
			$list['circle effect10'] = esc_html__('Circle Effect 10',  'diveit');
			$list['circle effect11'] = esc_html__('Circle Effect 11',  'diveit');
			$list['circle effect12'] = esc_html__('Circle Effect 12',  'diveit');
			$list['circle effect13'] = esc_html__('Circle Effect 13',  'diveit');
			$list['circle effect14'] = esc_html__('Circle Effect 14',  'diveit');
			$list['circle effect15'] = esc_html__('Circle Effect 15',  'diveit');
			$list['circle effect16'] = esc_html__('Circle Effect 16',  'diveit');
			$list['circle effect17'] = esc_html__('Circle Effect 17',  'diveit');
			$list['circle effect18'] = esc_html__('Circle Effect 18',  'diveit');
			$list['circle effect19'] = esc_html__('Circle Effect 19',  'diveit');
			$list['circle effect20'] = esc_html__('Circle Effect 20',  'diveit');
			$list['square effect1']  = esc_html__('Square Effect 1',  'diveit');
			$list['square effect2']  = esc_html__('Square Effect 2',  'diveit');
			$list['square effect3']  = esc_html__('Square Effect 3',  'diveit');
			$list['square effect5']  = esc_html__('Square Effect 5',  'diveit');
			$list['square effect6']  = esc_html__('Square Effect 6',  'diveit');
			$list['square effect7']  = esc_html__('Square Effect 7',  'diveit');
			$list['square effect8']  = esc_html__('Square Effect 8',  'diveit');
			$list['square effect9']  = esc_html__('Square Effect 9',  'diveit');
			$list['square effect10'] = esc_html__('Square Effect 10',  'diveit');
			$list['square effect11'] = esc_html__('Square Effect 11',  'diveit');
			$list['square effect12'] = esc_html__('Square Effect 12',  'diveit');
			$list['square effect13'] = esc_html__('Square Effect 13',  'diveit');
			$list['square effect14'] = esc_html__('Square Effect 14',  'diveit');
			$list['square effect15'] = esc_html__('Square Effect 15',  'diveit');
			$list['square effect_dir']   = esc_html__('Square Effect Dir',   'diveit');
			$list['square effect_shift'] = esc_html__('Square Effect Shift', 'diveit');
			$list['square effect_book']  = esc_html__('Square Effect Book',  'diveit');
			$list['square effect_more']  = esc_html__('Square Effect More',  'diveit');
			$list['square effect_fade']  = esc_html__('Square Effect Fade',  'diveit');
			$list['square effect_pull']  = esc_html__('Square Effect Pull',  'diveit');
			$list['square effect_slide'] = esc_html__('Square Effect Slide', 'diveit');
			$list['square effect_border'] = esc_html__('Square Effect Border', 'diveit');
			$list = apply_filters('diveit_filter_portfolio_hovers', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_hovers', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the blog counters
if ( !function_exists( 'diveit_get_list_blog_counters' ) ) {
	function diveit_get_list_blog_counters($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_blog_counters'))=='') {
			$list = array(
				'views'		=> esc_html__('Views', 'diveit'),
				'likes'		=> esc_html__('Likes', 'diveit'),
				'rating'	=> esc_html__('Rating', 'diveit'),
				'comments'	=> esc_html__('Comments', 'diveit')
				);
			$list = apply_filters('diveit_filter_list_blog_counters', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_blog_counters', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list of the item sizes for the portfolio alter style, prepended inherit
if ( !function_exists( 'diveit_get_list_alter_sizes' ) ) {
	function diveit_get_list_alter_sizes($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_alter_sizes'))=='') {
			$list = array(
					'1_1' => esc_html__('1x1', 'diveit'),
					'1_2' => esc_html__('1x2', 'diveit'),
					'2_1' => esc_html__('2x1', 'diveit'),
					'2_2' => esc_html__('2x2', 'diveit'),
					'1_3' => esc_html__('1x3', 'diveit'),
					'2_3' => esc_html__('2x3', 'diveit'),
					'3_1' => esc_html__('3x1', 'diveit'),
					'3_2' => esc_html__('3x2', 'diveit'),
					'3_3' => esc_html__('3x3', 'diveit')
					);
			$list = apply_filters('diveit_filter_portfolio_alter_sizes', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_alter_sizes', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return extended hover directions list, prepended inherit
if ( !function_exists( 'diveit_get_list_hovers_directions' ) ) {
	function diveit_get_list_hovers_directions($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_hovers_directions'))=='') {
			$list = array(
				'left_to_right' => esc_html__('Left to Right',  'diveit'),
				'right_to_left' => esc_html__('Right to Left',  'diveit'),
				'top_to_bottom' => esc_html__('Top to Bottom',  'diveit'),
				'bottom_to_top' => esc_html__('Bottom to Top',  'diveit'),
				'scale_up'      => esc_html__('Scale Up',  'diveit'),
				'scale_down'    => esc_html__('Scale Down',  'diveit'),
				'scale_down_up' => esc_html__('Scale Down-Up',  'diveit'),
				'from_left_and_right' => esc_html__('From Left and Right',  'diveit'),
				'from_top_and_bottom' => esc_html__('From Top and Bottom',  'diveit')
			);
			$list = apply_filters('diveit_filter_portfolio_hovers_directions', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_hovers_directions', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the label positions in the custom forms
if ( !function_exists( 'diveit_get_list_label_positions' ) ) {
	function diveit_get_list_label_positions($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_label_positions'))=='') {
			$list = array(
				'top'		=> esc_html__('Top',		'diveit'),
				'bottom'	=> esc_html__('Bottom',		'diveit'),
				'left'		=> esc_html__('Left',		'diveit'),
				'over'		=> esc_html__('Over',		'diveit')
			);
			$list = apply_filters('diveit_filter_label_positions', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_label_positions', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the bg image positions
if ( !function_exists( 'diveit_get_list_bg_image_positions' ) ) {
	function diveit_get_list_bg_image_positions($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_bg_image_positions'))=='') {
			$list = array(
				'left top'	   => esc_html__('Left Top', 'diveit'),
				'center top'   => esc_html__("Center Top", 'diveit'),
				'right top'    => esc_html__("Right Top", 'diveit'),
				'left center'  => esc_html__("Left Center", 'diveit'),
				'center center'=> esc_html__("Center Center", 'diveit'),
				'right center' => esc_html__("Right Center", 'diveit'),
				'left bottom'  => esc_html__("Left Bottom", 'diveit'),
				'center bottom'=> esc_html__("Center Bottom", 'diveit'),
				'right bottom' => esc_html__("Right Bottom", 'diveit')
			);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_bg_image_positions', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the bg image repeat
if ( !function_exists( 'diveit_get_list_bg_image_repeats' ) ) {
	function diveit_get_list_bg_image_repeats($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_bg_image_repeats'))=='') {
			$list = array(
				'repeat'	=> esc_html__('Repeat', 'diveit'),
				'repeat-x'	=> esc_html__('Repeat X', 'diveit'),
				'repeat-y'	=> esc_html__('Repeat Y', 'diveit'),
				'no-repeat'	=> esc_html__('No Repeat', 'diveit')
			);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_bg_image_repeats', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the bg image attachment
if ( !function_exists( 'diveit_get_list_bg_image_attachments' ) ) {
	function diveit_get_list_bg_image_attachments($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_bg_image_attachments'))=='') {
			$list = array(
				'scroll'	=> esc_html__('Scroll', 'diveit'),
				'fixed'		=> esc_html__('Fixed', 'diveit'),
				'local'		=> esc_html__('Local', 'diveit')
			);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_bg_image_attachments', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list of the bg tints
if ( !function_exists( 'diveit_get_list_bg_tints' ) ) {
	function diveit_get_list_bg_tints($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_bg_tints'))=='') {
			$list = array(
				'white'	=> esc_html__('White', 'diveit'),
				'light'	=> esc_html__('Light', 'diveit'),
				'dark'	=> esc_html__('Dark', 'diveit')
			);
			$list = apply_filters('diveit_filter_bg_tints', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_bg_tints', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return custom fields types list, prepended inherit
if ( !function_exists( 'diveit_get_list_field_types' ) ) {
	function diveit_get_list_field_types($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_field_types'))=='') {
			$list = array(
				'text'     => esc_html__('Text',  'diveit'),
				'textarea' => esc_html__('Text Area','diveit'),
				'password' => esc_html__('Password',  'diveit'),
				'radio'    => esc_html__('Radio',  'diveit'),
				'checkbox' => esc_html__('Checkbox',  'diveit'),
				'select'   => esc_html__('Select',  'diveit'),
				'date'     => esc_html__('Date','diveit'),
				'time'     => esc_html__('Time','diveit'),
				'button'   => esc_html__('Button','diveit')
			);
			$list = apply_filters('diveit_filter_field_types', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_field_types', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return Google map styles
if ( !function_exists( 'diveit_get_list_googlemap_styles' ) ) {
	function diveit_get_list_googlemap_styles($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_googlemap_styles'))=='') {
			$list = array(
				'default' => esc_html__('Default', 'diveit')
			);
			$list = apply_filters('diveit_filter_googlemap_styles', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_googlemap_styles', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'diveit_get_list_icons' ) ) {
	function diveit_get_list_icons($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_icons'))=='') {
			$list = diveit_parse_icons_classes(diveit_get_file_dir("css/fontello/css/fontello-codes.css"));
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_icons', $list);
		}
		return $prepend_inherit ? array_merge(array('inherit'), $list) : $list;
	}
}

// Return socials list
if ( !function_exists( 'diveit_get_list_socials' ) ) {
	function diveit_get_list_socials($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_socials'))=='') {
            $list = diveit_get_list_images("images/socials", "png");
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_socials', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}


// Return list with 'Yes' and 'No' items
if ( !function_exists( 'diveit_get_list_yesno' ) ) {
	function diveit_get_list_yesno($prepend_inherit=false) {
		$list = array(
			'yes' => esc_html__("Yes", 'diveit'),
			'no'  => esc_html__("No", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'diveit_get_list_onoff' ) ) {
	function diveit_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on" => esc_html__("On", 'diveit'),
			"off" => esc_html__("Off", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'diveit_get_list_showhide' ) ) {
	function diveit_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'diveit'),
			"hide" => esc_html__("Hide", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with 'Ascending' and 'Descending' items
if ( !function_exists( 'diveit_get_list_orderings' ) ) {
	function diveit_get_list_orderings($prepend_inherit=false) {
		$list = array(
			"asc" => esc_html__("Ascending", 'diveit'),
			"desc" => esc_html__("Descending", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'diveit_get_list_directions' ) ) {
	function diveit_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'diveit'),
			"vertical" => esc_html__("Vertical", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with item's shapes
if ( !function_exists( 'diveit_get_list_shapes' ) ) {
	function diveit_get_list_shapes($prepend_inherit=false) {
		$list = array(
			"round"  => esc_html__("Round", 'diveit'),
			"square" => esc_html__("Square", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with item's sizes
if ( !function_exists( 'diveit_get_list_sizes' ) ) {
	function diveit_get_list_sizes($prepend_inherit=false) {
		$list = array(
			"tiny"   => esc_html__("Tiny", 'diveit'),
			"small"  => esc_html__("Small", 'diveit'),
			"medium" => esc_html__("Medium", 'diveit'),
			"large"  => esc_html__("Large", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with slider (scroll) controls positions
if ( !function_exists( 'diveit_get_list_controls' ) ) {
	function diveit_get_list_controls($prepend_inherit=false) {
		$list = array(
			"hide" => esc_html__("Hide", 'diveit'),
			"side" => esc_html__("Side", 'diveit'),
			"bottom" => esc_html__("Bottom", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with float items
if ( !function_exists( 'diveit_get_list_floats' ) ) {
	function diveit_get_list_floats($prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'diveit'),
			"left" => esc_html__("Float Left", 'diveit'),
			"right" => esc_html__("Float Right", 'diveit')
		);
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with alignment items
if ( !function_exists( 'diveit_get_list_alignments' ) ) {
	function diveit_get_list_alignments($justify=false, $prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'diveit'),
			"left" => esc_html__("Left", 'diveit'),
			"center" => esc_html__("Center", 'diveit'),
			"right" => esc_html__("Right", 'diveit')
		);
		if ($justify) $list["justify"] = esc_html__("Justify", 'diveit');
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with horizontal positions
if ( !function_exists( 'diveit_get_list_hpos' ) ) {
	function diveit_get_list_hpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['left'] = esc_html__("Left", 'diveit');
		if ($center) $list['center'] = esc_html__("Center", 'diveit');
		$list['right'] = esc_html__("Right", 'diveit');
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with vertical positions
if ( !function_exists( 'diveit_get_list_vpos' ) ) {
	function diveit_get_list_vpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['top'] = esc_html__("Top", 'diveit');
		if ($center) $list['center'] = esc_html__("Center", 'diveit');
		$list['bottom'] = esc_html__("Bottom", 'diveit');
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return sorting list items
if ( !function_exists( 'diveit_get_list_sortings' ) ) {
	function diveit_get_list_sortings($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_sortings'))=='') {
			$list = array(
				"date" => esc_html__("Date", 'diveit'),
				"title" => esc_html__("Alphabetically", 'diveit'),
				"views" => esc_html__("Popular (views count)", 'diveit'),
				"comments" => esc_html__("Most commented (comments count)", 'diveit'),
				"author_rating" => esc_html__("Author rating", 'diveit'),
				"users_rating" => esc_html__("Visitors (users) rating", 'diveit'),
				"random" => esc_html__("Random", 'diveit')
			);
			$list = apply_filters('diveit_filter_list_sortings', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_sortings', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list with columns widths
if ( !function_exists( 'diveit_get_list_columns' ) ) {
	function diveit_get_list_columns($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_columns'))=='') {
			$list = array(
				"none" => esc_html__("None", 'diveit'),
				"1_1" => esc_html__("100%", 'diveit'),
				"1_2" => esc_html__("1/2", 'diveit'),
				"1_3" => esc_html__("1/3", 'diveit'),
				"2_3" => esc_html__("2/3", 'diveit'),
				"1_4" => esc_html__("1/4", 'diveit'),
				"3_4" => esc_html__("3/4", 'diveit'),
				"1_5" => esc_html__("1/5", 'diveit'),
				"2_5" => esc_html__("2/5", 'diveit'),
				"3_5" => esc_html__("3/5", 'diveit'),
				"4_5" => esc_html__("4/5", 'diveit'),
				"1_6" => esc_html__("1/6", 'diveit'),
				"5_6" => esc_html__("5/6", 'diveit'),
				"1_7" => esc_html__("1/7", 'diveit'),
				"2_7" => esc_html__("2/7", 'diveit'),
				"3_7" => esc_html__("3/7", 'diveit'),
				"4_7" => esc_html__("4/7", 'diveit'),
				"5_7" => esc_html__("5/7", 'diveit'),
				"6_7" => esc_html__("6/7", 'diveit'),
				"1_8" => esc_html__("1/8", 'diveit'),
				"3_8" => esc_html__("3/8", 'diveit'),
				"5_8" => esc_html__("5/8", 'diveit'),
				"7_8" => esc_html__("7/8", 'diveit'),
				"1_9" => esc_html__("1/9", 'diveit'),
				"2_9" => esc_html__("2/9", 'diveit'),
				"4_9" => esc_html__("4/9", 'diveit'),
				"5_9" => esc_html__("5/9", 'diveit'),
				"7_9" => esc_html__("7/9", 'diveit'),
				"8_9" => esc_html__("8/9", 'diveit'),
				"1_10"=> esc_html__("1/10", 'diveit'),
				"3_10"=> esc_html__("3/10", 'diveit'),
				"7_10"=> esc_html__("7/10", 'diveit'),
				"9_10"=> esc_html__("9/10", 'diveit'),
				"1_11"=> esc_html__("1/11", 'diveit'),
				"2_11"=> esc_html__("2/11", 'diveit'),
				"3_11"=> esc_html__("3/11", 'diveit'),
				"4_11"=> esc_html__("4/11", 'diveit'),
				"5_11"=> esc_html__("5/11", 'diveit'),
				"6_11"=> esc_html__("6/11", 'diveit'),
				"7_11"=> esc_html__("7/11", 'diveit'),
				"8_11"=> esc_html__("8/11", 'diveit'),
				"9_11"=> esc_html__("9/11", 'diveit'),
				"10_11"=> esc_html__("10/11", 'diveit'),
				"1_12"=> esc_html__("1/12", 'diveit'),
				"5_12"=> esc_html__("5/12", 'diveit'),
				"7_12"=> esc_html__("7/12", 'diveit'),
				"10_12"=> esc_html__("10/12", 'diveit'),
				"11_12"=> esc_html__("11/12", 'diveit')
			);
			$list = apply_filters('diveit_filter_list_columns', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_columns', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return list of locations for the dedicated content
if ( !function_exists( 'diveit_get_list_dedicated_locations' ) ) {
	function diveit_get_list_dedicated_locations($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_dedicated_locations'))=='') {
			$list = array(
				"default" => esc_html__('As in the post defined', 'diveit'),
				"center"  => esc_html__('Above the text of the post', 'diveit'),
				"left"    => esc_html__('To the left the text of the post', 'diveit'),
				"right"   => esc_html__('To the right the text of the post', 'diveit'),
				"alter"   => esc_html__('Alternates for each post', 'diveit')
			);
			$list = apply_filters('diveit_filter_list_dedicated_locations', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_dedicated_locations', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return post-format name
if ( !function_exists( 'diveit_get_post_format_name' ) ) {
	function diveit_get_post_format_name($format, $single=true) {
		$name = '';
		if ($format=='gallery')		$name = $single ? esc_html__('gallery', 'diveit') : esc_html__('galleries', 'diveit');
		else if ($format=='video')	$name = $single ? esc_html__('video', 'diveit') : esc_html__('videos', 'diveit');
		else if ($format=='audio')	$name = $single ? esc_html__('audio', 'diveit') : esc_html__('audios', 'diveit');
		else if ($format=='image')	$name = $single ? esc_html__('image', 'diveit') : esc_html__('images', 'diveit');
		else if ($format=='quote')	$name = $single ? esc_html__('quote', 'diveit') : esc_html__('quotes', 'diveit');
		else if ($format=='link')	$name = $single ? esc_html__('link', 'diveit') : esc_html__('links', 'diveit');
		else if ($format=='status')	$name = $single ? esc_html__('status', 'diveit') : esc_html__('statuses', 'diveit');
		else if ($format=='aside')	$name = $single ? esc_html__('aside', 'diveit') : esc_html__('asides', 'diveit');
		else if ($format=='chat')	$name = $single ? esc_html__('chat', 'diveit') : esc_html__('chats', 'diveit');
		else						$name = $single ? esc_html__('standard', 'diveit') : esc_html__('standards', 'diveit');
		return apply_filters('diveit_filter_list_post_format_name', $name, $format);
	}
}

// Return post-format icon name (from Fontello library)
if ( !function_exists( 'diveit_get_post_format_icon' ) ) {
	function diveit_get_post_format_icon($format) {
		$icon = 'icon-';
		if ($format=='gallery')		$icon .= 'pictures';
		else if ($format=='video')	$icon .= 'video';
		else if ($format=='audio')	$icon .= 'note';
		else if ($format=='image')	$icon .= 'picture';
		else if ($format=='quote')	$icon .= 'quote';
		else if ($format=='link')	$icon .= 'link';
		else if ($format=='status')	$icon .= 'comment';
		else if ($format=='aside')	$icon .= 'doc-text';
		else if ($format=='chat')	$icon .= 'chat';
		else						$icon .= 'book-open';
		return apply_filters('diveit_filter_list_post_format_icon', $icon, $format);
	}
}

// Return fonts styles list, prepended inherit
if ( !function_exists( 'diveit_get_list_fonts_styles' ) ) {
	function diveit_get_list_fonts_styles($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_fonts_styles'))=='') {
			$list = array(
				'i' => esc_html__('I','diveit'),
				'u' => esc_html__('U', 'diveit')
			);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_fonts_styles', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return Google fonts list
if ( !function_exists( 'diveit_get_list_fonts' ) ) {
	function diveit_get_list_fonts($prepend_inherit=false) {
		if (($list = diveit_storage_get('list_fonts'))=='') {
			$list = array();
			$list = diveit_array_merge($list, diveit_get_list_font_faces());
			// Google and custom fonts list:
																		$list = diveit_array_merge($list, array(
				'Advent Pro' => array('family'=>'sans-serif'),
				'Alegreya Sans' => array('family'=>'sans-serif'),
				'Arimo' => array('family'=>'sans-serif'),
				'Asap' => array('family'=>'sans-serif'),
				'Averia Sans Libre' => array('family'=>'cursive'),
				'Averia Serif Libre' => array('family'=>'cursive'),
				'Bree Serif' => array('family'=>'serif',),
				'Cabin' => array('family'=>'sans-serif'),
				'Cabin Condensed' => array('family'=>'sans-serif'),
				'Caudex' => array('family'=>'serif'),
				'Comfortaa' => array('family'=>'cursive'),
				'Cousine' => array('family'=>'sans-serif'),
				'Crimson Text' => array('family'=>'serif'),
				'Cuprum' => array('family'=>'sans-serif'),
				'Dosis' => array('family'=>'sans-serif'),
				'Economica' => array('family'=>'sans-serif'),
				'Exo' => array('family'=>'sans-serif'),
				'Expletus Sans' => array('family'=>'cursive'),
				'Karla' => array('family'=>'sans-serif'),
				'Lato' => array('family'=>'sans-serif'),
				'Lekton' => array('family'=>'sans-serif'),
				'Lobster Two' => array('family'=>'cursive'),
				'Maven Pro' => array('family'=>'sans-serif'),
				'Merriweather' => array('family'=>'serif'),
				'Montserrat' => array('family'=>'sans-serif'),
				'Neuton' => array('family'=>'serif'),
				'Noticia Text' => array('family'=>'serif'),
				'Old Standard TT' => array('family'=>'serif'),
				'Open Sans' => array('family'=>'sans-serif'),
				'Orbitron' => array('family'=>'sans-serif'),
				'Oswald' => array('family'=>'sans-serif'),
				'Overlock' => array('family'=>'cursive'),
				'Oxygen' => array('family'=>'sans-serif'),
				'Philosopher' => array('family'=>'serif'),
				'PT Serif' => array('family'=>'serif'),
				'Puritan' => array('family'=>'sans-serif'),
				'Raleway' => array('family'=>'sans-serif'),
				'Roboto' => array('family'=>'sans-serif'),
				'Roboto Slab' => array('family'=>'sans-serif'),
				'Roboto Condensed' => array('family'=>'sans-serif'),
				'Rosario' => array('family'=>'sans-serif'),
				'Share' => array('family'=>'cursive'),
				'Signika' => array('family'=>'sans-serif'),
				'Signika Negative' => array('family'=>'sans-serif'),
				'Source Sans Pro' => array('family'=>'sans-serif'),
				'Tinos' => array('family'=>'serif'),
				'Ubuntu' => array('family'=>'sans-serif'),
				'Vollkorn' => array('family'=>'serif')
				)
			);
			$list = apply_filters('diveit_filter_list_fonts', $list);
			if (diveit_get_theme_setting('use_list_cache')) diveit_storage_set('list_fonts', $list);
		}
		return $prepend_inherit ? diveit_array_merge(array('inherit' => esc_html__("Inherit", 'diveit')), $list) : $list;
	}
}

// Return Custom font-face list
if ( !function_exists( 'diveit_get_list_font_faces' ) ) {
    function diveit_get_list_font_faces($prepend_inherit=false) {
        static $list = false;
        if (is_array($list)) return $list;
        $list = array();
        $dir = diveit_get_folder_dir("css/font-face");
        if ( is_dir($dir) ) {
            $files = glob(sprintf("%s/*", $dir), GLOB_ONLYDIR);
            if ( is_array($files) ) {
                foreach ($files as $file) {
                    $file_name = basename($file);
                    if ( substr($file_name, 0, 1) == '.' || ! is_dir( ($dir) . '/' . ($file_name) ) )
                        continue;
                    $css = file_exists( ($dir) . '/' . ($file_name) . '/' . ($file_name) . '.css' )
                        ? diveit_get_file_url("css/font-face/".($file_name).'/'.($file_name).'.css')
                        : (file_exists( ($dir) . '/' . ($file_name) . '/stylesheet.css' )
                            ? diveit_get_file_url("css/font-face/".($file_name).'/stylesheet.css')
                            : '');
                    if ($css != '')
                        $list[$file_name] = array('css' => $css);
                }
            }
        }
        return $list;
    }
}
?>