<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'diveit_template_services_1_theme_setup' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_template_services_1_theme_setup', 1 );
	function diveit_template_services_1_theme_setup() {
		diveit_add_template(array(
			'layout' => 'services-1',
			'template' => 'services-1',
			'mode'   => 'services',
			'title'  => esc_html__('Services /Style 1/', 'diveit'),
			'thumb_title'  => esc_html__('Medium image (crop)', 'diveit'),
			'w'		 => 370,
			'h'		 => 209
		));
	}
}

// Template output
if ( !function_exists( 'diveit_template_services_1_output' ) ) {
	function diveit_template_services_1_output($post_options, $post_data) {
		$show_title = !empty($post_data['post_title']);
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(12, empty($parts[1]) ? (!empty($post_options['columns_count']) ? $post_options['columns_count'] : 1) : (int) $parts[1]));
		if (diveit_param_is_on($post_options['slider'])) {
			?><div class="swiper-slide" data-style="<?php echo esc_attr($post_options['tag_css_wh']); ?>" style="<?php echo esc_attr($post_options['tag_css_wh']); ?>"><div class="sc_services_item_wrap"><?php
		} else if ($columns > 1) {
			?><div class="column-1_<?php echo esc_attr($columns); ?> column_padding_bottom"><?php
		}
		?>
			<div<?php echo !empty($post_options['tag_id']) ? ' id="'.esc_attr($post_options['tag_id']).'"' : ''; ?>
				class="sc_services_item sc_services_item_<?php echo esc_attr($post_options['number']) . ($post_options['number'] % 2 == 1 ? ' odd' : ' even') . ($post_options['number'] == 1 ? ' first' : '') . (!empty($post_options['tag_class']) ? ' '.esc_attr($post_options['tag_class']) : ''); ?>"
				<?php echo (!empty($post_options['tag_css']) ? ' style="'.esc_attr($post_options['tag_css']).'"' : '') 
					. (!diveit_param_is_off($post_options['tag_animation']) ? ' data-animation="'.esc_attr(diveit_get_animation_classes($post_options['tag_animation'])).'"' : ''); ?>>
				<?php 
				if ($post_data['post_icon'] && $post_options['tag_type']=='icons') {
					$html = diveit_do_shortcode('[trx_icon icon="'.esc_attr($post_data['post_icon']).'" shape="round"]');
					if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
						?><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php diveit_show_layout($html); ?></a><?php
					} else
						diveit_show_layout($html);
				} else {
					?>
					<div class="sc_services_item_featured post_featured">
						<?php
						diveit_template_set_args('post-featured', array(
							'post_options' => $post_options,
							'post_data' => $post_data
						));
						get_template_part(diveit_get_file_slug('templates/_parts/post-featured.php'));
						?>
					</div>
					<?php
				}
				?>
				<div class="sc_services_item_content">
					<?php
					if ($show_title) {
						if ((!isset($post_options['links']) || $post_options['links']) && !empty($post_data['post_link'])) {
							?><h6 class="sc_services_item_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php diveit_show_layout($post_data['post_title']); ?></a></h6><?php
						} else {
							?><h6 class="sc_services_item_title"><?php diveit_show_layout($post_data['post_title']); ?></h6><?php
						}
					}
					?>

					<div class="sc_services_item_description">
						<?php
						if ($post_data['post_protected']) {
							diveit_show_layout($post_data['post_excerpt']);
						} else {
							if ($post_data['post_excerpt']) {
								echo in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status')) ? $post_data['post_excerpt'] : '<p>'.trim(diveit_strshort($post_data['post_excerpt'], isset($post_options['descr']) ? $post_options['descr'] : diveit_get_custom_option('post_excerpt_maxlength_masonry'))).'</p>';
							}
							if (!empty($post_data['post_link']) && !diveit_param_is_off($post_options['readmore'])) {
								?><a href="<?php echo esc_url($post_data['post_link']); ?>" class="sc_services_item_readmore sc_button sc_button_square sc_button_style_filled sc_button_size_small sc_button_hover_fade"><?php diveit_show_layout($post_options['readmore']); ?></a><?php
							}
						}
						?>
					</div>
				</div>
			</div>
		<?php
		if (diveit_param_is_on($post_options['slider'])) {
			?></div></div><?php
		} else if ($columns > 1) {
			?></div><?php
		}
	}
}
?>