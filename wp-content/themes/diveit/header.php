<?php
/**
 * The Header for our theme.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php
		// Add class 'scheme_xxx' into <html> because it used as context for the body classes!
		$diveit_body_scheme = diveit_get_custom_option('body_scheme');
		if (empty($diveit_body_scheme) || diveit_is_inherit_option($diveit_body_scheme)) $diveit_body_scheme = 'original';
		echo 'scheme_' . esc_attr($diveit_body_scheme);
		?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
<?php wp_body_open(); ?>
	<?php do_action( 'before' ); ?>

	<?php if ( !diveit_param_is_off(diveit_get_custom_option('show_sidebar_outer')) ) { ?>
	<div class="outer_wrap">
	<?php } ?>

	<?php get_template_part(diveit_get_file_slug('sidebar_outer.php')); ?>

	<?php
		$diveit_body_style  = diveit_get_custom_option('body_style');
		$diveit_class = $diveit_style = '';
		if (diveit_get_custom_option('bg_custom')=='yes' && ($diveit_body_style=='boxed' || diveit_get_custom_option('bg_image_load')=='always')) {
			if (($diveit_img = diveit_get_custom_option('bg_image_custom')) != '')
				$diveit_style = 'background: url('.esc_url($diveit_img).') ' . str_replace('_', ' ', diveit_get_custom_option('bg_image_custom_position')) . ' no-repeat fixed;';
			else if (($diveit_img = diveit_get_custom_option('bg_pattern_custom')) != '')
				$diveit_style = 'background: url('.esc_url($img).') 0 0 repeat fixed;';
			else if (($diveit_img = diveit_get_custom_option('bg_image')) > 0)
				$diveit_class = 'bg_image_'.($diveit_img);
			else if (($img = diveit_get_custom_option('bg_pattern')) > 0)
				$diveit_class = 'bg_pattern_'.($diveit_img);
			if (($diveit_img = diveit_get_custom_option('bg_color')) != '')
				$diveit_style .= 'background-color: '.($diveit_img).';';
		}
	?>

	<div class="body_wrap<?php echo !empty($diveit_class) ? ' '.esc_attr($diveit_class) : ''; ?>"<?php echo !empty($diveit_style) ? ' style="'.esc_attr($diveit_style).'"' : ''; ?>>

		<?php
		$diveit_video_bg_show = diveit_get_custom_option('show_video_bg')=='yes';
		$diveit_youtube = diveit_get_custom_option('video_bg_youtube_code');
		$diveit_video   = diveit_get_custom_option('video_bg_url');
		$diveit_overlay = diveit_get_custom_option('video_bg_overlay')=='yes';
		if ($diveit_video_bg_show && (!empty($diveit_youtube) || !empty($diveit_video))) {
			if (!empty($diveit_youtube)) {
				?>
				<div class="video_bg<?php echo !empty($diveit_overlay) ? ' video_bg_overlay' : ''; ?>" data-youtube-code="<?php echo esc_attr($diveit_youtube); ?>"></div>
				<?php
			} else if (!empty($diveit_video)) {
				$diveit_info = pathinfo($diveit_video);
				$diveit_ext = !empty($diveit_info['extension']) ? $diveit_info['extension'] : 'src';
				?>
				<div class="video_bg<?php echo !empty($diveit_overlay) ? ' video_bg_overlay' : ''; ?>"><video class="video_bg_tag" width="1280" height="720" data-width="1280" data-height="720" data-ratio="16:9" preload="metadata" autoplay loop src="<?php echo esc_url($diveit_video); ?>"><source src="<?php echo esc_url($diveit_video); ?>" type="video/<?php echo esc_attr($diveit_ext); ?>"></source></video></div>
				<?php
			}
		}
		?>

		<div class="page_wrap">

			<?php
			$diveit_top_panel_style = diveit_get_custom_option('top_panel_style');
			$diveit_top_panel_position = diveit_get_custom_option('top_panel_position');
			$diveit_top_panel_scheme = diveit_get_custom_option('top_panel_scheme');
			// Top panel 'Above' or 'Over'
			if (in_array($diveit_top_panel_position, array('above', 'over'))) {
				diveit_show_post_layout(array(
					'layout' => $diveit_top_panel_style,
					'position' => $diveit_top_panel_position,
					'scheme' => $diveit_top_panel_scheme
					), false);
				// Mobile Menu
				get_template_part(diveit_get_file_slug('templates/headers/_parts/header-mobile.php'));
			}

			// Slider
			get_template_part(diveit_get_file_slug('templates/headers/_parts/slider.php'));
			
			// Top panel 'Below'
			if ($diveit_top_panel_position == 'below') {
				diveit_show_post_layout(array(
					'layout' => $diveit_top_panel_style,
					'position' => $diveit_top_panel_position,
					'scheme' => $diveit_top_panel_scheme
					), false);
				// Mobile Menu
				get_template_part(diveit_get_file_slug('templates/headers/_parts/header-mobile.php'));
			}

			// Top of page section: page title and breadcrumbs
			$diveit_show_title = diveit_get_custom_option('show_page_title')=='yes';
		    $diveit_show_navi = apply_filters('diveit_filter_show_post_navi', false);
			$diveit_show_breadcrumbs = diveit_get_custom_option('show_breadcrumbs')=='yes';
			if(!is_home()) {
                if ($diveit_show_title || $diveit_show_breadcrumbs) {
                    ?>
                    <div class="top_panel_title top_panel_style_<?php echo esc_attr(str_replace('header_', '', $diveit_top_panel_style)); ?> <?php echo (!empty($diveit_show_title) ? ' title_present' . ($diveit_show_navi ? ' navi_present' : '') : '') . (!empty($diveit_show_breadcrumbs) ? ' breadcrumbs_present' : ''); ?> scheme_<?php echo esc_attr($diveit_top_panel_scheme); ?>">
                        <div class="top_panel_title_inner top_panel_inner_style_<?php echo esc_attr(str_replace('header_', '', $diveit_top_panel_style)); ?> <?php echo (!empty($diveit_show_title) ? ' title_present_inner' : '') . (!empty($diveit_show_breadcrumbs) ? ' breadcrumbs_present_inner' : ''); ?>">
                            <div class="content_wrap">
                                <?php
                                if ($diveit_show_title) {
                                    if ($diveit_show_navi) {
                                        ?>
                                        <div class="post_navi"><?php
                                        previous_post_link('<span class="post_navi_item post_navi_prev">%link</span>', '%title', true, '', 'product_cat');
                                        next_post_link('<span class="post_navi_item post_navi_next">%link</span>', '%title', true, '', 'product_cat');
                                        ?></div><?php
                                    } else {
                                        ?>
                                        <h1 class="page_title"><?php echo wp_kses_post(diveit_get_blog_title()); ?></h1><?php
                                    }
                                }
                                if ($diveit_show_breadcrumbs) {
                                    ?>
                                    <div class="breadcrumbs"><?php if (!is_404()) diveit_show_breadcrumbs(); ?></div><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
			?>

			<div class="page_content_wrap page_paddings_<?php echo esc_attr(diveit_get_custom_option('body_paddings')); ?>">

				<?php
				// Content and sidebar wrapper
				if ($diveit_body_style!='fullscreen') diveit_open_wrapper('<div class="content_wrap">');
				
				// Main content wrapper
				diveit_open_wrapper('<div class="content">');
				?>