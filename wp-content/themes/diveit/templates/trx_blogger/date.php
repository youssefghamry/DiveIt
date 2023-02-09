<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'diveit_template_date_theme_setup' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_template_date_theme_setup', 1 );
	function diveit_template_date_theme_setup() {
		diveit_add_template(array(
			'layout' => 'date',
			'mode'   => 'blogger',
			'title'  => esc_html__('Blogger layout: Timeline', 'diveit')
			));
	}
}

// Template output
if ( !function_exists( 'diveit_template_date_output' ) ) {
	function diveit_template_date_output($post_options, $post_data) {
		if (diveit_param_is_on($post_options['scroll'])) diveit_enqueue_slider();
		diveit_template_set_args('reviews-summary', array(
			'post_options' => $post_options,
			'post_data' => $post_data
		));
        if (function_exists('diveit_reviews_theme_setup')) {
            get_template_part(diveit_get_file_slug('templates/_parts/reviews-summary.php'));
        }
		$reviews_summary = diveit_storage_get('reviews_summary');
		?>
		
		<div class="post_item sc_blogger_item
			<?php if ($post_options['number'] == $post_options['posts_on_page'] && !diveit_param_is_on($post_options['loadmore'])) echo ' sc_blogger_item_last'; ?>"
			<?php echo 'horizontal'==$post_options['dir'] ? ' style="width:'.(100/$post_options['posts_on_page']).'%"' : ''; ?>>
			<div class="sc_blogger_date">
				<span class="day_month"><?php diveit_show_layout($post_data['post_date_part1']); ?></span>
				<span class="year"><?php diveit_show_layout($post_data['post_date_part2']); ?></span>
			</div>

			<div class="post_content">
				<h6 class="post_title sc_title sc_blogger_title">
					<?php echo (!isset($post_options['links']) || $post_options['links'] ? '<a href="' . esc_url($post_data['post_link']) . '">' : ''); ?>
					<?php diveit_show_layout($post_data['post_title']); ?>
					<?php echo (!isset($post_options['links']) || $post_options['links'] ? '</a>' : ''); ?>
				</h6>
				
				<?php diveit_show_layout($reviews_summary); ?>
	
				<?php if (diveit_param_is_on($post_options['info'])) { ?>
				<div class="post_info">
					<span class="post_info_item post_info_posted_by"><?php esc_html_e('by', 'diveit'); ?> <a href="<?php echo esc_url($post_data['post_author_url']); ?>" class="post_info_author"><?php echo esc_html($post_data['post_author']); ?></a></span>
					<span class="post_info_item post_info_counters">
						<?php echo 'comments'==$post_options['orderby'] || 'comments'==$post_options['counters'] ? esc_html__('Comments', 'diveit') : esc_html__('Views', 'diveit'); ?>
						<span class="post_info_counters_number"><?php echo 'comments'==$post_options['orderby'] || 'comments'==$post_options['counters'] ? esc_html($post_data['post_comments']) : esc_html($post_data['post_views']); ?></span>
					</span>
				</div>
				<?php } ?>

			</div>	<!-- /.post_content -->
		
		</div>		<!-- /.post_item -->

		<?php
		if ($post_options['number'] == $post_options['posts_on_page'] && diveit_param_is_on($post_options['loadmore'])) {
		?>
			<div class="load_more"<?php echo 'horizontal'==$post_options['dir'] ? ' style="width:'.(100/$post_options['posts_on_page']).'%"' : ''; ?>></div>
		<?php
		}
	}
}
?>