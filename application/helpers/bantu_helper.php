<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('pr')) {
	function pr($array, $exit = FALSE) {
	    if($exit) {
	      echo "<!DOCTYPE html>\n<pre>\n",print_r($array,1),'</pre>';exit;
	    } else {
	      echo "<!DOCTYPE html>\n<pre>\n",print_r($array,1),'</pre>';
	    }
	}
}

if ( ! function_exists('searchArrayKey')) {
	function searchArrayKey($param='id', $search, $array) {
	   foreach ($array as $key => $val) {
	       if ($val[$param] === $search) {
	           return $key;
	       }
	   }
	   return null;
	}
}

if ( ! function_exists('searchArrayVal')) {
	function searchArrayVal($param='id', $search, $array) {
	   foreach ($array as $key => $val) {
	       if ($val[$param] === $search) {
	           return $val;
	       }
	   }
	   return [];
	}
}
