<?php
/**
 * Single post
 */
get_header(); 

$single_style = diveit_storage_get('single_style');
if (empty($single_style)) $single_style = diveit_get_custom_option('single_style');

while ( have_posts() ) { the_post();
	diveit_show_post_layout(
		array(
			'layout' => $single_style,
			'sidebar' => !diveit_param_is_off(diveit_get_custom_option('show_sidebar_main')),
			'content' => diveit_get_template_property($single_style, 'need_content'),
			'terms_list' => diveit_get_template_property($single_style, 'need_terms')
		)
	);
}

get_footer();
?>