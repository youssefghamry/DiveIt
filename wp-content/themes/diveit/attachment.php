<?php
/**
 * Attachment page
 */
get_header(); 

while ( have_posts() ) { the_post();

	// Move diveit_set_post_views to the javascript - counter will work under cache system
	if (diveit_get_custom_option('use_ajax_views_counter')=='no') {
        do_action('trx_utils_filter_set_post_views', get_the_ID());
	}

	diveit_show_post_layout(
		array(
			'layout' => 'attachment',
			'sidebar' => !diveit_param_is_off(diveit_get_custom_option('show_sidebar_main'))
		)
	);

}

get_footer();
?>