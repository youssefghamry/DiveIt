<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */


// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'diveit_theme_setup' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_theme_setup', 1 );
	function diveit_theme_setup() {

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Custom header setup
		add_theme_support( 'custom-header', array('header-text'=>false));

		// Custom backgrounds setup
		add_theme_support( 'custom-background');

		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') );

		// Autogenerate title tag
		add_theme_support('title-tag');

		// Add user menu
		add_theme_support('nav-menus');

		// WooCommerce Support
		add_theme_support( 'woocommerce' );

		// Add wide and full blocks support
		add_theme_support( 'align-wide' );


		// Register theme menus
		add_filter( 'diveit_filter_add_theme_menus',		'diveit_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'diveit_filter_add_theme_sidebars',	'diveit_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'diveit_filter_importer_options',		'diveit_set_importer_options' );

		// Add theme required plugins
		add_filter( 'diveit_filter_required_plugins',		'diveit_add_required_plugins' );
		
		// Add preloader styles
		add_filter('diveit_filter_add_styles_inline',		'diveit_head_add_page_preloader_styles');

		// Init theme after WP is created
		add_action( 'wp',									'diveit_core_init_theme' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 							'diveit_body_classes' );

        add_action( 'widgets_init', 'diveit_add_theme_sidebars' );

		// Add data to the head and to the beginning of the body
		add_action('wp_head',								'diveit_head_add_page_meta', 0);
		add_action('before',								'diveit_body_add_gtm');
		add_action('before',								'diveit_body_add_toc');
		add_action('before',								'diveit_body_add_page_preloader');

		// Add data to the footer (priority 1, because priority 2 used for localize scripts)
		add_action('wp_footer',								'diveit_footer_add_views_counter', 1);
		add_action('wp_footer',								'diveit_footer_add_theme_customizer', 1);
		add_action('wp_footer',								'diveit_footer_add_custom_html', 1);
		add_action('wp_footer',								'diveit_footer_add_gtm2', 1);

		// Set list of the theme required plugins
		diveit_storage_set('required_plugins', array(
			'booked',
			'essgrids',
			'revslider',
			'tribe_events',
			'trx_utils',
			'mailchimp',
			'visual_composer',
			'woocommerce',
			'wp_gdpr_compliance',
			'trx_updater',
			'trx_socials',
			'contact_form_7',
			'elegro-payment',
			'instagram_feed'
         )
		);


        // Set list of the theme required custom fonts from folder /css/font-faces
        // Attention! Font's folder must have name equal to the font's name
        diveit_storage_set('required_custom_fonts', array(
                'Amadeus'
            )
        );



	}
}



// Add/Remove theme nav menus
if ( !function_exists( 'diveit_add_theme_menus' ) ) {
	function diveit_add_theme_menus($menus) {
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'diveit_add_theme_sidebars' ) ) {
	function diveit_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'diveit' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'diveit' )
			);
			if (function_exists('diveit_exists_woocommerce') && diveit_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = esc_html__( 'WooCommerce Cart Sidebar', 'diveit' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}


// Add theme required plugins
if ( !function_exists( 'diveit_add_required_plugins' ) ) {
	function diveit_add_required_plugins($plugins) {
		$plugins[] = array(
			'name' 		=> esc_html__( 'DiveIt Utilities', 'diveit' ),
			'version'	=> '3.2.2',					// Minimal required version
			'slug' 		=> 'trx_utils',
			'source'	=> diveit_get_file_dir('plugins/install/trx_utils.zip'),
			'required' 	=> true
		);
		return $plugins;
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'diveit_importer_set_options' ) ) {
    add_filter( 'trx_utils_filter_importer_options', 'diveit_importer_set_options', 9 );
    function diveit_importer_set_options( $options=array() ) {
        if ( is_array( $options ) ) {
            // Save or not installer's messages to the log-file
            $options['debug'] = false;
            // Prepare demo data
            if ( is_dir( DIVEIT_THEME_PATH . 'demo/' ) ) {
                $options['demo_url'] = DIVEIT_THEME_PATH . 'demo/';
            } else {
                $options['demo_url'] = esc_url( diveit_get_protocol().'://demofiles.ancorathemes.com/diving/' ); // Demo-site domain
            }

            // Required plugins
            $options['required_plugins'] =  array(
                'booked',
                'essential-grid',
                'revslider',
                'mailchimp',
                'trx_utils',
                'js_composer',
                'woocommerce',
                'instagram-feed',
                'the-events-calendar',
                'contact-form-7',
                'trx_updater'
            );

            $options['theme_slug'] = 'diveit';

            // Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
            // Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
            $options['regenerate_thumbnails'] = 3;
            // Default demo
            $options['files']['default']['title'] = esc_html__( 'Diveit Demo', 'diveit' );
            $options['files']['default']['domain_dev'] = esc_url( diveit_get_protocol().'://diving.ancorathemes.com'); // Developers domain
            $options['files']['default']['domain_demo']= esc_url( diveit_get_protocol().'://diving.ancorathemes.com'); // Demo-site domain

        }
        return $options;
    }
}



// Add data to the head and to the beginning of the body
//------------------------------------------------------------------------

// Add theme specified classes to the body tag
if ( !function_exists('diveit_body_classes') ) {
	function diveit_body_classes( $classes ) {

		$classes[] = 'diveit_body';
		$classes[] = 'body_style_' . trim(diveit_get_custom_option('body_style'));
		$classes[] = 'body_' . (diveit_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'article_style_' . trim(diveit_get_custom_option('article_style'));
		
		$blog_style = diveit_get_custom_option(is_singular() && !diveit_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(diveit_get_template_name($blog_style));
		
		$body_scheme = diveit_get_custom_option('body_scheme');
		if (empty($body_scheme)  || diveit_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = diveit_get_custom_option('top_panel_position');
		if (!diveit_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = diveit_get_sidebar_class();

		if (diveit_get_custom_option('show_video_bg')=='yes' && (diveit_get_custom_option('video_bg_youtube_code')!='' || diveit_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		if (!diveit_param_is_off(diveit_get_theme_option('page_preloader')))
			$classes[] = 'preloader';

		return $classes;
	}
}


// Add page meta to the head
if (!function_exists('diveit_head_add_page_meta')) {
	function diveit_head_add_page_meta() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1<?php if (diveit_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=1'; ?>">
		<meta name="format-detection" content="telephone=no">
	
		<link rel="profile" href="//gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
	}
}

// Add page preloader styles to the head
if (!function_exists('diveit_head_add_page_preloader_styles')) {
	function diveit_head_add_page_preloader_styles($css) {
		if (($preloader=diveit_get_theme_option('page_preloader'))!='none') {
			$image = diveit_get_theme_option('page_preloader_image');
			$bg_clr = diveit_get_scheme_color('bg_color');
			$link_clr = diveit_get_scheme_color('text_link');
			$css .= '
				#page_preloader {
					background-color: '. esc_attr($bg_clr) . ';'
					. ($preloader=='custom' && $image
						? 'background-image:url('.esc_url($image).');'
						: ''
						)
				    . '
				}
				.preloader_wrap > div {
					background-color: '.esc_attr($link_clr).';
				}';
		}
		return $css;
	}
}

// Add gtm code to the beginning of the body 
if (!function_exists('diveit_body_add_gtm')) {
	function diveit_body_add_gtm() {
		echo wp_kses_data(trim(diveit_get_custom_option('gtm_code')));
	}
}

// Add TOC anchors to the beginning of the body 
if (!function_exists('diveit_body_add_toc')) {
	function diveit_body_add_toc() {
		// Add TOC items 'Home' and "To top"
		if (diveit_get_custom_option('menu_toc_home')=='yes' && (function_exists('diveit_sc_anchor')))
            diveit_show_layout(diveit_sc_anchor(array(
				'id' => "toc_home",
				'title' => esc_html__('Home', 'diveit'),
				'description' => esc_html__('{{Return to Home}} - ||navigate to home page of the site', 'diveit'),
				'icon' => "icon-home",
				'separator' => "yes",
				'url' => esc_url(home_url('/'))
				)
			)); 
		if (diveit_get_custom_option('menu_toc_top')=='yes'&& (function_exists('diveit_sc_anchor')))
            diveit_show_layout(diveit_sc_anchor(array(
				'id' => "toc_top",
				'title' => esc_html__('To Top', 'diveit'),
				'description' => esc_html__('{{Back to top}} - ||scroll to top of the page', 'diveit'),
				'icon' => "icon-double-up",
				'separator' => "yes")
				)); 
	}
}

// Add page preloader to the beginning of the body
if (!function_exists('diveit_body_add_page_preloader')) {
	function diveit_body_add_page_preloader() {
		if ( ($preloader=diveit_get_theme_option('page_preloader')) != 'none' && ( $preloader != 'custom' || ($image=diveit_get_theme_option('page_preloader_image')) != '')) {
			?><div id="page_preloader"><?php
				if ($preloader == 'circle') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_circ1"></div><div class="preloader_circ2"></div><div class="preloader_circ3"></div><div class="preloader_circ4"></div></div><?php
				} else if ($preloader == 'square') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_square1"></div><div class="preloader_square2"></div></div><?php
				}
			?></div><?php
		}
	}
}


// Add data to the footer
//------------------------------------------------------------------------

// Add post/page views counter
if (!function_exists('diveit_footer_add_views_counter')) {
	function diveit_footer_add_views_counter() {
		// Post/Page views counter
		get_template_part(diveit_get_file_slug('templates/_parts/views-counter.php'));
	}
}

// Add theme customizer
if (!function_exists('diveit_footer_add_theme_customizer')) {
	function diveit_footer_add_theme_customizer() {
		// Front customizer
		if (diveit_get_custom_option('show_theme_customizer')=='yes') {
            require_once DIVEIT_FW_PATH . 'core/core.customizer/front.customizer.php';
		}
	}
}



// Add custom html
if (!function_exists('diveit_footer_add_custom_html')) {
	function diveit_footer_add_custom_html() {
		?><div class="custom_html_section"><?php
			echo wp_kses_data(trim(diveit_get_custom_option('custom_code')));
		?></div><?php
	}
}

// Add gtm code
if (!function_exists('diveit_footer_add_gtm2')) {
	function diveit_footer_add_gtm2() {
		echo wp_kses_data(trim(diveit_get_custom_option('gtm_code2')));
	}
}

// Add theme required plugins
if ( !function_exists( 'diveit_add_trx_utils' ) ) {
    add_filter( 'trx_utils_active', 'diveit_add_trx_utils' );
    function diveit_add_trx_utils($enable=true) {
        return true;
    }
}

function diveit_wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }
}

add_filter( 'comment_form_fields', 'diveit_wpb_move_comment_field_to_bottom' );

// Include framework core files
//-------------------------------------------------------------------
require_once trailingslashit( get_template_directory() ) . 'fw/loader.php';
?>