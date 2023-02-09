<?php
/**
 * Theme custom styles
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if (!function_exists('diveit_action_theme_styles_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_action_theme_styles_theme_setup', 1 );
	function diveit_action_theme_styles_theme_setup() {
	
		// Add theme fonts in the used fonts list
		add_filter('diveit_filter_used_fonts',			'diveit_filter_theme_styles_used_fonts');
		// Add theme fonts (from Google fonts) in the main fonts list (if not present).
		add_filter('diveit_filter_list_fonts',			'diveit_filter_theme_styles_list_fonts');

		// Add theme stylesheets
		add_action('diveit_action_add_styles',			'diveit_action_theme_styles_add_styles');
		// Add theme inline styles
		add_filter('diveit_filter_add_styles_inline',		'diveit_filter_theme_styles_add_styles_inline');

		// Add theme scripts
		add_action('diveit_action_add_scripts',			'diveit_action_theme_styles_add_scripts');
		// Add theme scripts inline
		add_filter('diveit_filter_localize_script',		'diveit_filter_theme_styles_localize_script');

		// Add theme less files into list for compilation
		add_filter('diveit_filter_compile_less',			'diveit_filter_theme_styles_compile_less');



		// Add color schemes
		diveit_add_color_scheme('original', array(

			'title'					=> esc_html__('Original', 'diveit'),
			
			// Whole block border and background
			'bd_color'				=> '#e4e7e8',
			'bg_color'				=> '#ffffff',
			
			// Headers, text and links colors
			'text'					=> '#6f6f6f',       //
			'text_light'			=> '#6f6f6f',       //
			'text_dark'				=> '#232a34',       //
			'text_link'				=> '#20c7ca',       //
			'text_hover'			=> '#008ae2',       //

			// Inverse colors
			'inverse_text'			=> '#ffffff',       //
			'inverse_light'			=> '#ffffff',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#ffffff',
		
			// Input fields
			'input_text'			=> '#8a8a8a',
			'input_light'			=> '#acb4b6',
			'input_dark'			=> '#232a34',
			'input_bd_color'		=> '#dddddd',
			'input_bd_hover'		=> '#f4f6f8',       //
			'input_bg_color'		=> '#252627',       //
			'input_bg_hover'		=> '#00d2c6',       //
		
			// Alternative blocks (submenu items, etc.)
			'alter_text'			=> '#8a8a8a',
			'alter_light'			=> '#747777',       //
			'alter_dark'			=> '#3b3c3d',       //
			'alter_link'			=> '#20c7ca',
			'alter_hover'			=> '#189799',
			'alter_bd_color'		=> '#dddddd',
			'alter_bd_hover'		=> '#e9e9e9',       //
			'alter_bg_color'		=> '#f8f8f8',       //
			'alter_bg_hover'		=> '#e9edf1',       //
			)
		);


		// Add Custom fonts
		diveit_add_custom_font('h1', array(
			'title'			=> esc_html__('Heading 1', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '4.2856em',
			'font-weight'	=> '900',
            'font-style'	=> 'i',
			'line-height'	=> '1em',
			'margin-top'	=> '0.5em',
			'margin-bottom'	=> '0.59em'
			)
		);
		diveit_add_custom_font('h2', array(
			'title'			=> esc_html__('Heading 2', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '3.5714em',
			'font-weight'	=> '900',
			'font-style'	=> 'i',
			'line-height'	=> '1em',
			'margin-top'	=> '1.81em',
			'margin-bottom'	=> '0.4em'
			)
		);
		diveit_add_custom_font('h3', array(
			'title'			=> esc_html__('Heading 3', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '2.8577em',
			'font-weight'	=> '900',
			'font-style'	=> 'i',
			'line-height'	=> '1em',
			'margin-top'	=> '2.3em',
			'margin-bottom'	=> '0.79em'
			)
		);
		diveit_add_custom_font('h4', array(
			'title'			=> esc_html__('Heading 4', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '2.1423em',
			'font-weight'	=> '900',
			'font-style'	=> 'i',
			'line-height'	=> '1em',
			'margin-top'	=> '3.1em',
			'margin-bottom'	=> '0.7em'
			)
		);
		diveit_add_custom_font('h5', array(
			'title'			=> esc_html__('Heading 5', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '1.4289em',
			'font-weight'	=> '900',
			'font-style'	=> 'i',
			'line-height'	=> '1em',
			'margin-top'	=> '4.8em',
			'margin-bottom'	=> '0.6em'
			)
		);
		diveit_add_custom_font('h6', array(
			'title'			=> esc_html__('Heading 6', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '1.142857em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1em',
			'margin-top'	=> '1.25em',
			'margin-bottom'	=> '0.65em'
			)
		);
		diveit_add_custom_font('p', array(
			'title'			=> esc_html__('Text', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'PT Serif',
			'font-size' 	=> '14px',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '20px',
			'margin-top'	=> '',
			'margin-bottom'	=> '1em'
			)
		);
		diveit_add_custom_font('link', array(
			'title'			=> esc_html__('Links', 'diveit'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> ''
			)
		);
		diveit_add_custom_font('info', array(
			'title'			=> esc_html__('Post info', 'diveit'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '1em',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '',
			'margin-bottom'	=> '1.5em'
			)
		);
		diveit_add_custom_font('menu', array(
			'title'			=> esc_html__('Main menu items', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '12px',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '3.5em',
			'margin-bottom'	=> '3.2em'
			)
		);
		diveit_add_custom_font('submenu', array(
			'title'			=> esc_html__('Dropdown menu items', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '11px',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '',
			'margin-bottom'	=> ''
			)
		);
		diveit_add_custom_font('logo', array(
			'title'			=> esc_html__('Logo', 'diveit'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '2em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '0.75em',
			'margin-top'	=> '2.5em',
			'margin-bottom'	=> '2.1em'
			)
		);
		diveit_add_custom_font('button', array(
			'title'			=> esc_html__('Buttons', 'diveit'),
			'description'	=> '',
			'font-family'	=> 'Lato',
			'font-size' 	=> '1.12485em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2857em'
			)
		);
		diveit_add_custom_font('input', array(
			'title'			=> esc_html__('Input fields', 'diveit'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.2857em'
			)
		);

	}
}





//------------------------------------------------------------------------------
// Theme fonts
//------------------------------------------------------------------------------

// Add theme fonts in the used fonts list
if (!function_exists('diveit_filter_theme_styles_used_fonts')) {
	function diveit_filter_theme_styles_used_fonts($theme_fonts) {
		$theme_fonts['Lato'] = 1;
        $theme_fonts['PT Serif'] = 1;
		return $theme_fonts;
	}
}

// Add theme fonts (from Google fonts) in the main fonts list (if not present).
// To use custom font-face you not need add it into list in this function
if (!function_exists('diveit_filter_theme_styles_list_fonts')) {
	function diveit_filter_theme_styles_list_fonts($list) {
		if (!isset($list['Lato']))	$list['Lato'] = array('family'=>'sans-serif', 'link'=>'Lato:400,400italic,700,700italic,900,900italic');
        if (!isset($list['PT Serif']))	$list['PT Serif'] = array('family'=>'serif');
		return $list;
	}
}



//------------------------------------------------------------------------------
// Theme stylesheets
//------------------------------------------------------------------------------

// Add theme.less into list files for compilation
if (!function_exists('diveit_filter_theme_styles_compile_less')) {
	function diveit_filter_theme_styles_compile_less($files) {
		if (file_exists(diveit_get_file_dir('css/theme.less'))) {
		 	$files[] = diveit_get_file_dir('css/theme.less');
		}
		return $files;	
	}
}

// Add theme stylesheets
if (!function_exists('diveit_action_theme_styles_add_styles')) {
	function diveit_action_theme_styles_add_styles() {
		// Add stylesheet files only if LESS supported
		if ( diveit_get_theme_setting('less_compiler') != 'no' ) {
			wp_enqueue_style( 'diveit-theme-style', diveit_get_file_url('css/theme.css'), array(), null );
			wp_add_inline_style( 'diveit-theme-style', diveit_get_inline_css() );
		}
	}
}

// Add theme inline styles
if (!function_exists('diveit_filter_theme_styles_add_styles_inline')) {
	function diveit_filter_theme_styles_add_styles_inline($custom_style) {
		// Submenu width
		$menu_width = diveit_get_theme_option('menu_width');
		if (!empty($menu_width)) {
			$custom_style .= "
				/* Submenu width */
				.menu_side_nav > li ul,
				.menu_main_nav > li ul {
					width: ".intval($menu_width)."px;
				}
				.menu_side_nav > li > ul ul,
				.menu_main_nav > li > ul ul {
					left:".intval($menu_width+4)."px;
				}
				.menu_side_nav > li > ul ul.submenu_left,
				.menu_main_nav > li > ul ul.submenu_left {
					left:-".intval($menu_width+1)."px;
				}
			";
		}
	
		// Logo height
		$logo_height = diveit_get_custom_option('logo_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo header height */
				.sidebar_outer_logo .logo_main,
				.top_panel_wrap .logo_main,
				.top_panel_wrap .logo_fixed {
					height:".intval($logo_height)."px;
				}
			";
		}
	
		// Logo top offset
		$logo_offset = diveit_get_custom_option('logo_offset');
		if (!empty($logo_offset)) {
			$custom_style .= "
				/* Logo header top offset */
				.top_panel_wrap .logo {
					margin-top:".intval($logo_offset)."px;
				}
			";
		}

		// Logo footer height
		$logo_height = diveit_get_theme_option('logo_footer_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo footer height */
				.contacts_wrap .logo img {
					height:".intval($logo_height)."px;
				}
			";
		}

		// Custom css from theme options
		$custom_style .= diveit_get_custom_option('custom_css');

		return $custom_style;	
	}
}


//------------------------------------------------------------------------------
// Theme scripts
//------------------------------------------------------------------------------

// Add theme scripts
if (!function_exists('diveit_action_theme_styles_add_scripts')) {
	function diveit_action_theme_styles_add_scripts() {
		if (diveit_get_theme_option('show_theme_customizer') == 'yes' && file_exists(diveit_get_file_dir('js/theme.customizer.js')))
            wp_enqueue_script( 'diveit-theme-styles-customizer-script', diveit_get_file_url('js/theme.customizer.js'), array(), null, true );
	}
}

// Add theme scripts inline
if (!function_exists('diveit_filter_theme_styles_localize_script')) {
	function diveit_filter_theme_styles_localize_script($vars) {
		if (empty($vars['theme_font']))
			$vars['theme_font'] = diveit_get_custom_font_settings('p', 'font-family');
		$vars['theme_color'] = diveit_get_scheme_color('text_dark');
		$vars['theme_bg_color'] = diveit_get_scheme_color('bg_color');
		return $vars;
	}
}
?>