<?php
if(PHP_VERSION < 7.2){
	if(!is_admin()&&!is_login()){
		wp_die('主题需要PHP 7.2，你的服务器 PHP 版本为：'.PHP_VERSION.'，请升级到 PHP 7.2。');
		exit;
	}
}elseif(!defined('WPJAM_BASIC_PLUGIN_FILE')){
	if(!is_admin() && !is_login()){
		wp_die('主题基于 WPJAM Basic 插件开发，请先<a href="https://wordpress.org/plugins/wpjam-basic/">下载</a>并<a href="'.admin_url('plugins.php').'">激活</a> WPJAM Basic 插件。');
		exit;
	}
}else{


	include_once get_template_directory().'/classes/class-jojo-customize.php';
	include_once get_template_directory().'/classes/class-jojo-taxonomy-option.php';
	include_once get_template_directory().'/public/hooks.php';
	include_once get_template_directory().'/public/apis.php';


	if(is_admin()){
		// include(get_template_directory().'/admin/admin.php');
	}
}
