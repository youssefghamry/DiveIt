<?php
/**
 * The template for displaying the footer.
 */

				diveit_close_wrapper();	// <!-- </.content> -->

				// Show main sidebar
				get_sidebar();

				if (diveit_get_custom_option('body_style')!='fullscreen') diveit_close_wrapper();	// <!-- </.content_wrap> -->
				?>
			
			</div>		<!-- </.page_content_wrap> -->
			
			<?php

			// Footer sidebar
			$diveit_footer_show  = diveit_get_custom_option('show_sidebar_footer');
			$diveit_sidebar_name = diveit_get_custom_option('sidebar_footer');
			if (!diveit_param_is_off($diveit_footer_show) && is_active_sidebar($diveit_sidebar_name)) {
				diveit_storage_set('current_sidebar', 'footer');
				?>
				<footer class="footer_wrap widget_area scheme_<?php echo esc_attr(diveit_get_custom_option('sidebar_footer_scheme')); ?>">
					<div class="footer_wrap_inner widget_area_inner">
						<div class="content_wrap">
							<div class="columns_wrap"><?php
							ob_start();
							do_action( 'before_sidebar' );
                                if ( is_active_sidebar( $diveit_sidebar_name ) ) {
                                    dynamic_sidebar( $diveit_sidebar_name );
                                }
							do_action( 'after_sidebar' );
							$diveit_out = ob_get_contents();
							ob_end_clean();
							diveit_show_layout(chop(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $diveit_out)));
							?></div>	<!-- /.columns_wrap -->
						</div>	<!-- /.content_wrap -->
					</div>	<!-- /.footer_wrap_inner -->
				</footer>	<!-- /.footer_wrap -->
				<?php
			}



			// Google map
			if ( (diveit_get_custom_option('show_googlemap')=='yes') && (function_exists('diveit_sc_googlemap'))) {
				$diveit_map_address = diveit_get_custom_option('googlemap_address');
				$diveit_map_latlng  = diveit_get_custom_option('googlemap_latlng');
				$diveit_map_zoom    = diveit_get_custom_option('googlemap_zoom');
				$diveit_map_style   = diveit_get_custom_option('googlemap_style');
				$diveit_map_height  = diveit_get_custom_option('googlemap_height');
				if (!empty($diveit_map_address) || !empty($diveit_map_latlng)) {
					$diveit_args = array();
					if (!empty($diveit_map_style))		$diveit_args['style'] = esc_attr($diveit_map_style);
					if (!empty($diveit_map_zoom))		$diveit_args['zoom'] = esc_attr($diveit_map_zoom);
					if (!empty($diveit_map_height))	$diveit_args['height'] = esc_attr($diveit_map_height);
					diveit_show_layout(diveit_sc_googlemap($diveit_args));
				}
			}

			// Footer contacts
			if (diveit_get_custom_option('show_contacts_in_footer')=='yes') { 
				$diveit_address_1 = diveit_get_theme_option('contact_address_1');
				$diveit_address_2 = diveit_get_theme_option('contact_address_2');
				$diveit_phone = diveit_get_theme_option('contact_phone');
				$diveit_fax = diveit_get_theme_option('contact_fax');
				if (!empty($diveit_address_1) || !empty($diveit_address_2) || !empty($diveit_phone) || !empty($diveit_fax)) {
					?>
					<footer class="contacts_wrap scheme_<?php echo esc_attr(diveit_get_custom_option('contacts_scheme')); ?>">
						<div class="contacts_wrap_inner">
							<div class="content_wrap">
								<?php diveit_show_logo(false, false, true); ?>
								<div class="contacts_address">
									<address class="address_right">
										<?php if (!empty($diveit_phone)) echo esc_html__('Phone:', 'diveit') . ' ' . esc_html($diveit_phone) . '<br>'; ?>
										<?php if (!empty($diveit_fax)) echo esc_html__('Fax:', 'diveit') . ' ' . esc_html($diveit_fax); ?>
									</address>
									<address class="address_left">
										<?php if (!empty($diveit_address_2)) echo esc_html($diveit_address_2) . '<br>'; ?>
										<?php if (!empty($diveit_address_1)) echo esc_html($diveit_address_1); ?>
									</address>
								</div>
								<?php if (function_exists('diveit_sc_socials')) diveit_show_layout(diveit_sc_socials(array('size'=>"medium"))); ?>
							</div>	<!-- /.content_wrap -->
						</div>	<!-- /.contacts_wrap_inner -->
					</footer>	<!-- /.contacts_wrap -->
					<?php
				}
			}

			// Copyright area
			$diveit_copyright_style = diveit_get_custom_option('show_copyright_in_footer');
			if (!diveit_param_is_off($diveit_copyright_style)) {
				?> 
				<div class="copyright_wrap copyright_style_<?php echo esc_attr($diveit_copyright_style); ?>  scheme_<?php echo esc_attr(diveit_get_custom_option('copyright_scheme')); ?>">
					<div class="copyright_wrap_inner">
						<div class="content_wrap">
							<?php
							if ($diveit_copyright_style == 'menu') {
								if (($diveit_menu = diveit_get_nav_menu('menu_footer'))!='') {
									diveit_show_layout($diveit_menu);
								}
							} else if ($diveit_copyright_style == 'socials' && (function_exists('diveit_sc_socials'))) {
								diveit_show_layout(diveit_sc_socials(array('size'=>"tiny")));
							}
							?>
							<div class="copyright_text"><?php
                                $diveit_copyright = diveit_get_custom_option('footer_copyright');
                                $diveit_copyright = str_replace(array('{{Y}}', '{Y}'), date('Y'), $diveit_copyright);
                                echo wp_kses_post($diveit_copyright); ?></div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			
		</div>	<!-- /.page_wrap -->

	</div>		<!-- /.body_wrap -->
	
	<?php if ( !diveit_param_is_off(diveit_get_custom_option('show_sidebar_outer')) ) { ?>
	</div>	<!-- /.outer_wrap -->
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>