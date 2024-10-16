<?php
//lang
global $locale;
if ( isset( $_GET['wp_lang'] ) ) {
	setcookie( 'wp_lang', sanitize_text_field( $_GET['wp_lang'] ), 0);
	$locale = $_GET['wp_lang'];
}else{
	$locale = isset($_COOKIE['wp_lang']) ? $_COOKIE['wp_lang'] : get_locale();
}
load_theme_textdomain('jojo', get_template_directory() . '/languages');

// register post_type
wpjam_register_post_type('job',	[
	'label'					=> __('Job', "jojo"),
	'supports'				=> ['title', 'editor', 'excerpt', 'author'],
	'public'				=> true,
	'exclude_from_search'	=> true,
	'show_ui'				=> true,
	'has_archive'			=> false,
	'query_var'				=> false,
	'rewrite'				=> false,
	'model'					=> 'WPJAM_Job',
]);

wpjam_add_menu_page('job_taxonomy', [
	'menu_title'	=> __('Job Taxonomy', "jojo"),
	'parent'    	=> 'jobs',
	'function'  	=> 'list',
	'model'			=> JOJO_Taxonomy_Option::class,
]);

foreach(JOJO_Taxonomy_Option::get_all() as $taxonomy){
	wpjam_register_taxonomy($taxonomy['name'], [
		'label'				=> $taxonomy['label'],
		'post_type'			=> 'job',
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> false,
		'levels'			=> $taxonomy['level'] ?? 1,
		'object_type'		=> ['job'],
		'supports'			=> ['name', 'thumbnail'],
		'thumbnail_size'	=> '100x100'
	]);
}

// register other staff role


// register hooks
add_theme_support('title-tag');

function jojo_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title' ),
		'unlink-homepage-logo' => true, 
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'jojo_custom_logo_setup' );


//载入JS、CSS
add_action('wp_enqueue_scripts', function () {
	if (!is_admin()) {

		$ver = wp_get_theme()->get('Version');

		//css
		wp_enqueue_style('bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', []);
		wp_enqueue_style('style', get_stylesheet_directory_uri().'/style.css', []);


		//其他
		// wp_enqueue_script('main',get_stylesheet_directory_uri() . '/assets/js/main.js', ['jquery'], $ver, true);
		wp_enqueue_script('bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', []);

		//js部分
		wp_enqueue_script( 'jojo-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array('customize-controls', 'underscore', 'jquery' ), []);
		wp_enqueue_script( 'jojo-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery' ), []);

	}	
});

register_nav_menus([
	'header-menu' => __( 'Header Menu' , "jojo"),
	'footer-menu' => __( 'Footer Menu' , "jojo"),
]);

function add_menu_link_class( $attrs, $item, $args ) {
	if (property_exists($args, 'link_class')) {
		$attrs['class'] = $args->link_class;
	}
	return $attrs;
}

add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );
function add_menu_list_item_class($classes, $item, $args) {
	if (property_exists($args, 'list_item_class')) {
		$classes[] = $args->list_item_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);