<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'diveit_template_header_6_theme_setup' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_template_header_6_theme_setup', 1 );
	function diveit_template_header_6_theme_setup() {
		diveit_add_template(array(
			'layout' => 'header_6',
			'mode'   => 'header',
			'title'  => esc_html__('Header 6', 'diveit'),
			'icon'   => diveit_get_file_url('templates/headers/images/6.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'diveit_template_header_6_output' ) ) {
	function diveit_template_header_6_output($post_options, $post_data) {

		// WP custom header
		$header_css = '';
		if ($post_options['position'] != 'over') {
			$header_image = get_header_image();
			$header_css = $header_image!='' 
				? ' style="background-image: url('.esc_url($header_image).')"' 
				: '';
		}
		?>

		<div class="top_panel_fixed_wrap"></div>

		<header class="top_panel_wrap top_panel_style_6 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_6 top_panel_position_<?php echo esc_attr(diveit_get_custom_option('top_panel_position')); ?>">

				<?php if (diveit_get_custom_option('show_top_panel_top')=='yes') { ?>
                    <div class="top_panel_top">
                        <div class="content_wrap clearfix">
							<?php
							diveit_template_set_args('top-panel-top', array(
								'top_panel_top_components' => array('contact_info', 'search', 'login', 'socials', 'currency', 'bookmarks')
							));
							get_template_part(diveit_get_file_slug('templates/headers/_parts/top-panel-top.php'));
							?>
                        </div>
                    </div>
				<?php } ?>
                
                

			<div class="top_panel_middle" <?php diveit_show_layout($header_css); ?>>
				<div class="content_wrap">
					<div class="contact_logo">
						<?php diveit_show_logo(true, true); ?>
					</div>
					<div class="menu_main_wrap">
						<nav class="menu_main_nav_area menu_hover_<?php echo esc_attr(diveit_get_theme_option('menu_hover')); ?>">
							<?php
							$menu_main = diveit_get_nav_menu('menu_main');
							if (empty($menu_main)) $menu_main = diveit_get_nav_menu();
							diveit_show_layout($menu_main);
							?>
						</nav>
						<?php
                        if (function_exists('diveit_exists_woocommerce') && diveit_exists_woocommerce() && (diveit_is_woocommerce_page() && diveit_get_custom_option('show_cart')=='shop' || diveit_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) {
                            ?>
                            <div class="menu_main_cart top_panel_icon">
                                <?php do_action('trx_utils_show_contact_info_cart'); ?>
                            </div>
                        <?php
                        }
						if (diveit_get_custom_option('show_search')=='yes' && (function_exists('diveit_sc_search')))
							diveit_show_layout(diveit_sc_search(array('class'=>"top_panel_icon", 'state'=>"closed")));
						?>
					</div>
				</div>
			</div>

			</div>
		</header>

		<?php
		diveit_storage_set('header_mobile', array(
				 'open_hours' => false,
				 'login' => false,
				 'socials' => false,
				 'bookmarks' => false,
				 'contact_address' => false,
				 'contact_phone_email' => false,
				 'woo_cart' => true,
				 'search' => false
			)
		);
	}
}
?>