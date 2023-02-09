<?php
/**
 * DiveIt Framework: less manipulations
 *
 * @package	diveit
 * @since	diveit 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Theme init
if (!function_exists('diveit_less_theme_setup2')) {
	add_action( 'diveit_action_after_init_theme', 'diveit_less_theme_setup2' );
	function diveit_less_theme_setup2() {
		if (diveit_get_theme_setting('less_compiler')!='no' && !is_admin() && diveit_get_theme_option('debug_mode')=='yes') {

			// Regular run - if not admin - recompile only changed files
			$check_time = true;
			if (!is_customize_preview() && (int) get_option(diveit_storage_get('options_prefix') . '_compile_less') > 0) {
				update_option(diveit_storage_get('options_prefix') . '_compile_less', 0);
				$check_time = false;
			}
			
			diveit_storage_set('less_check_time', $check_time);
			do_action('diveit_action_compile_less');
			diveit_storage_set('less_check_time', false);

		}
	}
}



/* LESS
-------------------------------------------------------------------------------- */

// Recompile all LESS files
if (!function_exists('diveit_compile_less')) {	
	function diveit_compile_less($list = array(), $recompile=true) {

		if (!function_exists('trx_utils_less_compiler')) return false;

		$success = true;

        if (!is_array($list) || count($list)==0) return $success;

		// Less compiler
		$less_compiler = diveit_get_theme_setting('less_compiler');
		if ($less_compiler == 'no') return $success;
	
		// Prepare theme specific LESS-vars (colors, backgrounds, logo height, etc.)
		$less_split = diveit_get_theme_setting('less_split');
		$vars = apply_filters('diveit_filter_prepare_less', '');
		if ($less_compiler=='external' || !$less_split) {
			// Save LESS-vars into theme.vars.less
			diveit_fpc(diveit_get_file_dir('css/theme.vars.less'), $vars);
			if ($less_compiler=='external') return $success;
			$vars = '';
		}
		
		// Generate map for the LESS-files
		$less_map = diveit_get_theme_setting('less_map');
		if (diveit_get_theme_option('debug_mode')=='no' || $less_compiler=='lessc') $less_map = 'no';
		
		// Get separator to split LESS-files
		$less_sep = $less_map!='no' ? '' : diveit_get_theme_setting('less_separator');

		// Prepare separate array with less utils (not compile it alone - only with main files)
		$utils = $less_map!='no' ? array() : '';
		$utils_time = 0;
		if (is_array($list) && count($list) > 0) {
			foreach($list as $k=>$file) {
				$fname = basename($file);
				if ($fname[0]=='_') {
					if ($less_map!='no')
						$utils[] = $file;
					else
						$utils .= diveit_fgc($file);
					$list[$k] = '';
					$tmp = filemtime($file);
					if ($utils_time < $tmp) $utils_time = $tmp;
				}
			}
		}
		
		// Compile all .less files
		if (is_array($list) && count($list) > 0) {
			$success = trx_utils_less_compiler($list, array(
				'compiler' => $less_compiler,
				'map' => $less_map,
				'parse_files' => !$less_split,
				'utils' => $utils,
				'utils_time' => $utils_time,
				'vars' => $vars,
				'import' => array(diveit_get_folder_dir('css')),
				'separator' => $less_sep,
				'check_time' => diveit_storage_get('less_check_time')==true,
				'compressed' => diveit_get_theme_option('debug_mode')=='no'
				)
			);
		}
		
		return $success;
	}
}
?>