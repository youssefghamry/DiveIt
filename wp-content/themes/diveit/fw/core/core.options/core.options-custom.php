<?php
/**
 * DiveIt Framework: Theme options custom fields
 *
 * @package	diveit
 * @since	diveit 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'diveit_options_custom_theme_setup' ) ) {
	add_action( 'diveit_action_before_init_theme', 'diveit_options_custom_theme_setup' );
	function diveit_options_custom_theme_setup() {

		if ( is_admin() ) {
			add_action("admin_enqueue_scripts",	'diveit_options_custom_load_scripts');
		}
		
	}
}

// Load required styles and scripts for custom options fields
if ( !function_exists( 'diveit_options_custom_load_scripts' ) ) {
		function diveit_options_custom_load_scripts() {
        wp_enqueue_script( 'diveit-options-custom-script',	diveit_get_file_url('core/core.options/js/core.options-custom.js'), array(), null, true );
	}
}


// Show theme specific fields in Post (and Page) options
if ( !function_exists( 'diveit_show_custom_field' ) ) {
	function diveit_show_custom_field($id, $field, $value) {
		$output = '';
		switch ($field['type']) {
			case 'reviews':
				$output .= '<div class="reviews_block">' . trim(diveit_reviews_get_markup($field, $value, true)) . '</div>';
				break;
	
			case 'mediamanager':
				wp_enqueue_media( );
				$output .= '<a id="'.esc_attr($id).'" class="button mediamanager diveit_media_selector"
					data-param="' . esc_attr($id) . '"
					data-choose="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'diveit') : esc_html__( 'Choose Image', 'diveit')).'"
					data-update="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Add to Gallery', 'diveit') : esc_html__( 'Choose Image', 'diveit')).'"
					data-multiple="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? 'true' : 'false').'"
					data-linked-field="'.esc_attr($field['media_field_id']).'"
					>' . (isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'diveit') : esc_html__( 'Choose Image', 'diveit')) . '</a>';
				break;
		}
		return apply_filters('diveit_filter_show_custom_field', $output, $id, $field, $value);
	}
}
?>