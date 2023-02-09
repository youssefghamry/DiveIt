<?php
/* Instagram Feed support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('diveit_instagram_feed_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_instagram_feed_theme_setup', 1 );
	function diveit_instagram_feed_theme_setup() {

		if (is_admin()) {

			add_filter( 'diveit_filter_required_plugins',					'diveit_instagram_feed_required_plugins' );
		}
	}
}

// Check if Instagram Feed installed and activated
if ( !function_exists( 'diveit_exists_instagram_feed' ) ) {
	function diveit_exists_instagram_feed() {
		return defined('SBIVER');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'diveit_instagram_feed_required_plugins' ) ) {
		function diveit_instagram_feed_required_plugins($list=array()) {
		if (in_array('instagram_feed', diveit_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> 'Smash Balloon Instagram Feed',
					'slug' 		=> 'instagram-feed',
					'required' 	=> false
				);
		return $list;
	}
}


?>