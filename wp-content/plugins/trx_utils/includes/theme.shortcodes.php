<?php
if (!function_exists('diveit_theme_shortcodes_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_theme_shortcodes_setup', 1 );
	function diveit_theme_shortcodes_setup() {
		add_filter('diveit_filter_googlemap_styles', 'diveit_theme_shortcodes_googlemap_styles');
	}
}


// Add theme-specific Google map styles
if ( !function_exists( 'diveit_theme_shortcodes_googlemap_styles' ) ) {
	function diveit_theme_shortcodes_googlemap_styles($list) {
		$list['simple']		= esc_html__('Simple', 'trx_utils');
		$list['greyscale']	= esc_html__('Greyscale', 'trx_utils');
		$list['inverse']	= esc_html__('Inverse', 'trx_utils');
		$list['apple']		= esc_html__('Apple', 'trx_utils');
		return $list;
	}
}
?>