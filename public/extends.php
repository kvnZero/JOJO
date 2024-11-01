<?php
class JOJO_Extend extends WPJAM_Option_Model
{
	public static function scan()
	{
		$extends 	 = glob( get_template_directory().'/extends/*/hooks.php' );
		$extend_info = [];

		if ( $extends ) {
			foreach ( $extends as  $i => $extend_file ) {
				$file_data = get_file_data($extend_file, [
					'title' => 'title',
					'description' => 'description',
				]);
				$extend_info[] = [
					'key' 	=> basename(dirname($extend_file)),
					'title' => $file_data['title'],
					'description' => $file_data['description'],
				];
			}
		}

		return $extend_info;
	}

	public static function load($single_extend = '')
	{
		static $enable_extend = [];
		$all = self::get_setting();
		foreach($all as $extend => $enable){
			if(!$enable || in_array($extend, $enable_extend)){
				continue;
			}
			if($single_extend && $extend != $single_extend){
				continue;
			}
			if(file_exists(get_template_directory().'/extends/'.$extend.'/hooks.php')){
				$enable_extend[] = $extend;
				include get_template_directory().'/extends/'.$extend.'/hooks.php';
			}
		}
	}

	public static function get_menu_page(){
		$sub_menus = apply_filters('jojo_extend_sub_menus', []);
		return [
			'menu_slug'		=> 'jojo_extend',
			'menu_title'	=> __('Extend', 'jojo'),
			'position'		=> 30,
			'subs'			=> array_merge([
				'jojo_extend'		=> [
					'menu_title'	=> __('Extend', 'jojo'),
					'function'		=> 'option',
					'option_name'	=> 'jojo_extend',
				],
			], $sub_menus)
		];
	}
	
	public static function is_active($key)
	{
		$all = self::get_setting();
		return $all[$key] ?? false;

		// foreach($all as $extend => $enable){
		// 	if(!$enable || $extend != $key){
		// 		continue;
		// 	}
		// 	return true;
		// 	// if(file_exists(get_template_directory().'/extends/'.$extend.'/hooks.php')){
		// 	// 	return true;
		// 	// }
		// }
		// return false;
	}

	public static function get_fields($key){
		$subs = self::scan();
		if(!$subs){
			return [];
		}
		$extend_fields = [];
		foreach($subs as $extend){
			$extend_fields[$extend['key']] = [
				'title'		=> $extend['title'] ?: $extend['title'],
				'type'		=> 'checkbox',
				'description'=> $extend['description'] ?: '',
			];
		}
	    return $extend_fields;
	}

}

wpjam_register_option('jojo_extend', ['model'=>'JOJO_Extend',	'ajax'=>false]);
add_action('admin_menu', function() {
	//remove this basic auto register menu
	remove_submenu_page('edit.php?post_type=job', 'job-submissions');
}, 99);

add_action('update_option_jojo_extend', function($old_value, $new_value){
	foreach($new_value as $extend => $enable){
		if($enable && $old_value[$extend] == false){
			
			JOJO_Extend::load($extend);

			do_action('jojo_extend_update_'.$extend, true);
		}
		if($enable == false && $old_value[$extend]){
			do_action('jojo_extend_update_'.$extend, false);
		}
	}
}, 10, 2);

wpjam_load('init', function(){
	return JOJO_Extend::load();
});