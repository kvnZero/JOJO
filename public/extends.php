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

	public static function load()
	{
		$all = self::get_setting();
		foreach($all as $extend => $enable){
			if(!$enable){
				continue;
			}
			if(file_exists(get_template_directory().'/extends/'.$extend.'/hooks.php')){
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

wpjam_load('init', function(){
	return JOJO_Extend::load();
});