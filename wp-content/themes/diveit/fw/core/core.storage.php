<?php
/**
 * DiveIt Framework: theme variables storage
 *
 * @package	diveit
 * @since	diveit 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('diveit_storage_get')) {
	function diveit_storage_get($var_name, $default='') {
		global $DIVEIT_STORAGE;
		return isset($DIVEIT_STORAGE[$var_name]) ? $DIVEIT_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('diveit_storage_set')) {
	function diveit_storage_set($var_name, $value) {
		global $DIVEIT_STORAGE;
		$DIVEIT_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('diveit_storage_empty')) {
	function diveit_storage_empty($var_name, $key='', $key2='') {
		global $DIVEIT_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($DIVEIT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($DIVEIT_STORAGE[$var_name][$key]);
		else
			return empty($DIVEIT_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('diveit_storage_isset')) {
	function diveit_storage_isset($var_name, $key='', $key2='') {
		global $DIVEIT_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($DIVEIT_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($DIVEIT_STORAGE[$var_name][$key]);
		else
			return isset($DIVEIT_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('diveit_storage_inc')) {
	function diveit_storage_inc($var_name, $value=1) {
		global $DIVEIT_STORAGE;
		if (empty($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = 0;
		$DIVEIT_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('diveit_storage_concat')) {
	function diveit_storage_concat($var_name, $value) {
		global $DIVEIT_STORAGE;
		if (empty($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = '';
		$DIVEIT_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('diveit_storage_get_array')) {
	function diveit_storage_get_array($var_name, $key, $key2='', $default='') {
		global $DIVEIT_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($DIVEIT_STORAGE[$var_name][$key]) ? $DIVEIT_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($DIVEIT_STORAGE[$var_name][$key][$key2]) ? $DIVEIT_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('diveit_storage_set_array')) {
	function diveit_storage_set_array($var_name, $key, $value) {
		global $DIVEIT_STORAGE;
		if (!isset($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = array();
		if ($key==='')
			$DIVEIT_STORAGE[$var_name][] = $value;
		else
			$DIVEIT_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('diveit_storage_set_array2')) {
	function diveit_storage_set_array2($var_name, $key, $key2, $value) {
		global $DIVEIT_STORAGE;
		if (!isset($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = array();
		if (!isset($DIVEIT_STORAGE[$var_name][$key])) $DIVEIT_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$DIVEIT_STORAGE[$var_name][$key][] = $value;
		else
			$DIVEIT_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Add array element after the key
if (!function_exists('diveit_storage_set_array_after')) {
	function diveit_storage_set_array_after($var_name, $after, $key, $value='') {
		global $DIVEIT_STORAGE;
		if (!isset($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = array();
		if (is_array($key))
			diveit_array_insert_after($DIVEIT_STORAGE[$var_name], $after, $key);
		else
			diveit_array_insert_after($DIVEIT_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('diveit_storage_set_array_before')) {
	function diveit_storage_set_array_before($var_name, $before, $key, $value='') {
		global $DIVEIT_STORAGE;
		if (!isset($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = array();
		if (is_array($key))
			diveit_array_insert_before($DIVEIT_STORAGE[$var_name], $before, $key);
		else
			diveit_array_insert_before($DIVEIT_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('diveit_storage_push_array')) {
	function diveit_storage_push_array($var_name, $key, $value) {
		global $DIVEIT_STORAGE;
		if (!isset($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($DIVEIT_STORAGE[$var_name], $value);
		else {
			if (!isset($DIVEIT_STORAGE[$var_name][$key])) $DIVEIT_STORAGE[$var_name][$key] = array();
			array_push($DIVEIT_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('diveit_storage_pop_array')) {
	function diveit_storage_pop_array($var_name, $key='', $defa='') {
		global $DIVEIT_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($DIVEIT_STORAGE[$var_name]) && is_array($DIVEIT_STORAGE[$var_name]) && count($DIVEIT_STORAGE[$var_name]) > 0) 
				$rez = array_pop($DIVEIT_STORAGE[$var_name]);
		} else {
			if (isset($DIVEIT_STORAGE[$var_name][$key]) && is_array($DIVEIT_STORAGE[$var_name][$key]) && count($DIVEIT_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($DIVEIT_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('diveit_storage_inc_array')) {
	function diveit_storage_inc_array($var_name, $key, $value=1) {
		global $DIVEIT_STORAGE;
		if (!isset($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = array();
		if (empty($DIVEIT_STORAGE[$var_name][$key])) $DIVEIT_STORAGE[$var_name][$key] = 0;
		$DIVEIT_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('diveit_storage_concat_array')) {
	function diveit_storage_concat_array($var_name, $key, $value) {
		global $DIVEIT_STORAGE;
		if (!isset($DIVEIT_STORAGE[$var_name])) $DIVEIT_STORAGE[$var_name] = array();
		if (empty($DIVEIT_STORAGE[$var_name][$key])) $DIVEIT_STORAGE[$var_name][$key] = '';
		$DIVEIT_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('diveit_storage_call_obj_method')) {
	function diveit_storage_call_obj_method($var_name, $method, $param=null) {
		global $DIVEIT_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($DIVEIT_STORAGE[$var_name]) ? $DIVEIT_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($DIVEIT_STORAGE[$var_name]) ? $DIVEIT_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('diveit_storage_get_obj_property')) {
	function diveit_storage_get_obj_property($var_name, $prop, $default='') {
		global $DIVEIT_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($DIVEIT_STORAGE[$var_name]->$prop) ? $DIVEIT_STORAGE[$var_name]->$prop : $default;
	}
}
?>