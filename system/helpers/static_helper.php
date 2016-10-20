<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('css')){
	function css($file=NULL){
		$temp_url = str_replace('admin/','',get_instance()->config->base_url());
		return $temp_url.'static/css/'.$file;
	}
}

if ( ! function_exists('js')){
	function js($file=NULL){
		$temp_url = str_replace('admin/','',get_instance()->config->base_url());
		return $temp_url.'static/js/'.$file;
	}
}

if ( ! function_exists('images')){
	function images($file=NULL){
		$temp_url = str_replace('admin/','',get_instance()->config->base_url());
		return $temp_url.'static/images/'.$file;
	}
}

if ( ! function_exists('plugins')){
	function plugins($file=NULL){
		$temp_url = str_replace('admin/','',get_instance()->config->base_url());
		return $temp_url.'static/plugins/'.$file;
	}
}

if ( ! function_exists('pages')){
	function pages($file=NULL){
		$temp_url = str_replace('admin/','',get_instance()->config->base_url());
		return $temp_url.'static/pages/'.$file;
	}
}
// ------------------------------------------------------------------------