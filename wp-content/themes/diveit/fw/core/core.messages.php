<?php
/**
 * DiveIt Framework: messages subsystem
 *
 * @package	diveit
 * @since	diveit 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('diveit_messages_theme_setup')) {
	add_action( 'diveit_action_before_init_theme', 'diveit_messages_theme_setup' );
	function diveit_messages_theme_setup() {
		// Core messages strings
		add_filter('diveit_filter_localize_script', 'diveit_messages_localize_script');
	}
}


/* Session messages
------------------------------------------------------------------------------------- */

if (!function_exists('diveit_get_error_msg')) {
	function diveit_get_error_msg() {
		return diveit_storage_get('error_msg');
	}
}

if (!function_exists('diveit_set_error_msg')) {
	function diveit_set_error_msg($msg) {
		$msg2 = diveit_get_error_msg();
		diveit_storage_set('error_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('diveit_get_success_msg')) {
	function diveit_get_success_msg() {
		return diveit_storage_get('success_msg');
	}
}

if (!function_exists('diveit_set_success_msg')) {
	function diveit_set_success_msg($msg) {
		$msg2 = diveit_get_success_msg();
		diveit_storage_set('success_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('diveit_get_notice_msg')) {
	function diveit_get_notice_msg() {
		return diveit_storage_get('notice_msg');
	}
}

if (!function_exists('diveit_set_notice_msg')) {
	function diveit_set_notice_msg($msg) {
		$msg2 = diveit_get_notice_msg();
		diveit_storage_set('notice_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}


/* System messages (save when page reload)
------------------------------------------------------------------------------------- */
if (!function_exists('diveit_set_system_message')) {
	function diveit_set_system_message($msg, $status='info', $hdr='') {
		update_option(diveit_storage_get('options_prefix') . '_message', array('message' => $msg, 'status' => $status, 'header' => $hdr));
	}
}

if (!function_exists('diveit_get_system_message')) {
	function diveit_get_system_message($del=false) {
		$msg = get_option(diveit_storage_get('options_prefix') . '_message', false);
		if (!$msg)
			$msg = array('message' => '', 'status' => '', 'header' => '');
		else if ($del)
			diveit_del_system_message();
		return $msg;
	}
}

if (!function_exists('diveit_del_system_message')) {
	function diveit_del_system_message() {
		delete_option(diveit_storage_get('options_prefix') . '_message');
	}
}


/* Messages strings
------------------------------------------------------------------------------------- */

if (!function_exists('diveit_messages_localize_script')) {
		function diveit_messages_localize_script($vars) {
		$vars['strings'] = array(
			'ajax_error'		=> esc_html__('Invalid server answer', 'diveit'),
			'bookmark_add'		=> esc_html__('Add the bookmark', 'diveit'),
            'bookmark_added'	=> esc_html__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'diveit'),
            'bookmark_del'		=> esc_html__('Delete this bookmark', 'diveit'),
            'bookmark_title'	=> esc_html__('Enter bookmark title', 'diveit'),
            'bookmark_exists'	=> esc_html__('Current page already exists in the bookmarks list', 'diveit'),
			'search_error'		=> esc_html__('Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.', 'diveit'),
			'email_confirm'		=> esc_html__('On the e-mail address "%s" we sent a confirmation email. Please, open it and click on the link.', 'diveit'),
			'reviews_vote'		=> esc_html__('Thanks for your vote! New average rating is:', 'diveit'),
			'reviews_error'		=> esc_html__('Error saving your vote! Please, try again later.', 'diveit'),
			'error_like'		=> esc_html__('Error saving your like! Please, try again later.', 'diveit'),
			'error_global'		=> esc_html__('Global error text', 'diveit'),
			'name_empty'		=> esc_html__('The name can\'t be empty', 'diveit'),
			'name_long'			=> esc_html__('Too long name', 'diveit'),
			'email_empty'		=> esc_html__('Too short (or empty) email address', 'diveit'),
			'email_long'		=> esc_html__('Too long email address', 'diveit'),
			'email_not_valid'	=> esc_html__('Invalid email address', 'diveit'),
			'subject_empty'		=> esc_html__('The subject can\'t be empty', 'diveit'),
			'subject_long'		=> esc_html__('Too long subject', 'diveit'),
			'text_empty'		=> esc_html__('The message text can\'t be empty', 'diveit'),
			'text_long'			=> esc_html__('Too long message text', 'diveit'),
			'send_complete'		=> esc_html__("Send message complete!", 'diveit'),
			'send_error'		=> esc_html__('Transmit failed!', 'diveit'),
			'geocode_error'			=> esc_html__('Geocode was not successful for the following reason:', 'diveit'),
			'googlemap_not_avail'	=> esc_html__('Google map API not available!', 'diveit'),
			'editor_save_success'	=> esc_html__("Post content saved!", 'diveit'),
			'editor_save_error'		=> esc_html__("Error saving post data!", 'diveit'),
			'editor_delete_post'	=> esc_html__("You really want to delete the current post?", 'diveit'),
			'editor_delete_post_header'	=> esc_html__("Delete post", 'diveit'),
			'editor_delete_success'	=> esc_html__("Post deleted!", 'diveit'),
			'editor_delete_error'	=> esc_html__("Error deleting post!", 'diveit'),
			'editor_caption_cancel'	=> esc_html__('Cancel', 'diveit'),
			'editor_caption_close'	=> esc_html__('Close', 'diveit')
			);
		return $vars;
	}
}
?>