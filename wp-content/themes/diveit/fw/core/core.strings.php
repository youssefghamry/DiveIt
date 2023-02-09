<?php
/**
 * DiveIt Framework: strings manipulations
 *
 * @package	diveit
 * @since	diveit 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Check multibyte functions
if ( ! defined( 'DIVEIT_MULTIBYTE' ) ) define( 'DIVEIT_MULTIBYTE', function_exists('mb_strpos') ? 'UTF-8' : false );

if (!function_exists('diveit_strlen')) {
	function diveit_strlen($text) {
		return DIVEIT_MULTIBYTE ? mb_strlen($text) : strlen($text);
	}
}

if (!function_exists('diveit_strpos')) {
	function diveit_strpos($text, $char, $from=0) {
		return DIVEIT_MULTIBYTE ? mb_strpos($text, $char, $from) : strpos($text, $char, $from);
	}
}

if (!function_exists('diveit_strrpos')) {
	function diveit_strrpos($text, $char, $from=0) {
		return DIVEIT_MULTIBYTE ? mb_strrpos($text, $char, $from) : strrpos($text, $char, $from);
	}
}

if (!function_exists('diveit_substr')) {
	function diveit_substr($text, $from, $len=-999999) {
		if ($len==-999999) { 
			if ($from < 0)
				$len = -$from; 
			else
				$len = diveit_strlen($text)-$from;
		}
		return DIVEIT_MULTIBYTE ? mb_substr($text, $from, $len) : substr($text, $from, $len);
	}
}

if (!function_exists('diveit_strtolower')) {
	function diveit_strtolower($text) {
		return DIVEIT_MULTIBYTE ? mb_strtolower($text) : strtolower($text);
	}
}

if (!function_exists('diveit_strtoupper')) {
	function diveit_strtoupper($text) {
		return DIVEIT_MULTIBYTE ? mb_strtoupper($text) : strtoupper($text);
	}
}

if (!function_exists('diveit_strtoproper')) {
	function diveit_strtoproper($text) { 
		$rez = ''; $last = ' ';
		for ($i=0; $i<diveit_strlen($text); $i++) {
			$ch = diveit_substr($text, $i, 1);
			$rez .= diveit_strpos(' .,:;?!()[]{}+=', $last)!==false ? diveit_strtoupper($ch) : diveit_strtolower($ch);
			$last = $ch;
		}
		return $rez;
	}
}

if (!function_exists('diveit_strrepeat')) {
	function diveit_strrepeat($str, $n) {
		$rez = '';
		for ($i=0; $i<$n; $i++)
			$rez .= $str;
		return $rez;
	}
}

if (!function_exists('diveit_strshort')) {
	function diveit_strshort($str, $maxlength, $add='...') {
		if ($maxlength < 0) 
			return $str;
		if ($maxlength == 0) 
			return '';
		if ($maxlength >= diveit_strlen($str)) 
			return strip_tags($str);
		$str = diveit_substr(strip_tags($str), 0, $maxlength - diveit_strlen($add));
		$ch = diveit_substr($str, $maxlength - diveit_strlen($add), 1);
		if ($ch != ' ') {
			for ($i = diveit_strlen($str) - 1; $i > 0; $i--)
				if (diveit_substr($str, $i, 1) == ' ') break;
			$str = trim(diveit_substr($str, 0, $i));
		}
		if (!empty($str) && diveit_strpos(',.:;-', diveit_substr($str, -1))!==false) $str = diveit_substr($str, 0, -1);
		return ($str) . ($add);
	}
}

// Clear string from spaces, line breaks and tags (only around text)
if (!function_exists('diveit_strclear')) {
	function diveit_strclear($text, $tags=array()) {
		if (empty($text)) return $text;
		if (!is_array($tags)) {
			if ($tags != '')
				$tags = explode($tags, ',');
			else
				$tags = array();
		}
		$text = trim(chop($text));
		if (is_array($tags) && count($tags) > 0) {
			foreach ($tags as $tag) {
				$open  = '<'.esc_attr($tag);
				$close = '</'.esc_attr($tag).'>';
				if (diveit_substr($text, 0, diveit_strlen($open))==$open) {
					$pos = diveit_strpos($text, '>');
					if ($pos!==false) $text = diveit_substr($text, $pos+1);
				}
				if (diveit_substr($text, -diveit_strlen($close))==$close) $text = diveit_substr($text, 0, diveit_strlen($text) - diveit_strlen($close));
				$text = trim(chop($text));
			}
		}
		return $text;
	}
}

// Return slug for the any title string
if (!function_exists('diveit_get_slug')) {
	function diveit_get_slug($title) {
		return diveit_strtolower(str_replace(array('\\','/','-',' ','.'), '_', $title));
	}
}

// Replace macros in the string
if (!function_exists('diveit_strmacros')) {
	function diveit_strmacros($str) {
		return str_replace(array("{{", "}}", "((", "))", "||"), array("<i>", "</i>", "<b>", "</b>", "<br>"), $str);
	}
}

// Unserialize string (try replace \n with \r\n)
if (!function_exists('diveit_unserialize')) {
	function diveit_unserialize($str) {
		if ( is_serialized($str) ) {
			try {
				$data = unserialize($str);
			} catch (Exception $e) {
                diveit_dcl($e->getMessage());
				$data = false;
			}
			if ($data===false) {
				try {
					$data = unserialize(str_replace("\n", "\r\n", $str));
				} catch (Exception $e) {
                    diveit_dcl($e->getMessage());
					$data = false;
				}
			}
			return $data;
		} else
			return $str;
	}
}
?>