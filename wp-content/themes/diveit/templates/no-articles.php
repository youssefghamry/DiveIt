<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'diveit_template_no_articles_theme_setup' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_template_no_articles_theme_setup', 1 );
	function diveit_template_no_articles_theme_setup() {
		diveit_add_template(array(
			'layout' => 'no-articles',
			'mode'   => 'internal',
			'title'  => esc_html__('No articles found', 'diveit')
		));
	}
}

// Template output
if ( !function_exists( 'diveit_template_no_articles_output' ) ) {
	function diveit_template_no_articles_output($post_options, $post_data) {
		?>
		<article class="post_item">
			<div class="post_content">
				<h2 class="post_title"><?php esc_html_e('No posts found', 'diveit'); ?></h2>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria.', 'diveit' ); ?></p>
				<p><?php echo wp_kses_data( sprintf(__('Go back, or return to <a href="%s">%s</a> home page to choose a new page.', 'diveit'), esc_url(home_url('/')), get_bloginfo()) ); ?>
				<br><?php esc_html_e('Please report any broken links to our team.', 'diveit'); ?></p>
				<?php if ((function_exists('diveit_sc_search'))) diveit_show_layout(diveit_sc_search(array('state'=>"fixed"))); ?>
			</div>	<!-- /.post_content -->
		</article>	<!-- /.post_item -->
		<?php
	}
}
?>