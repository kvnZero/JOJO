<?php
if(!defined('WPJAM_BASIC_PLUGIN_FILE')){
	if(!is_admin()){
		wp_die(__('This theme is need "<a href="https://wordpress.org/plugins/wpjam-basic/">WPJAM Basic</a>" Plugin, Please download this plugin and active it.', 'jojo'));
	}
	exit;
}

include_once get_template_directory().'/classes/class-jojo-customize.php';
include_once get_template_directory().'/classes/class-jojo-taxonomy-option.php';
include_once get_template_directory().'/public/hooks.php';
include_once get_template_directory().'/public/apis.php';


if(is_admin()){
	// include(get_template_directory().'/admin/admin.php');
}
