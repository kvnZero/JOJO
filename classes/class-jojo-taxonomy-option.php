<?php
class JOJO_Taxonomy_Option extends WPJAM_Model
{
    const DISABLE_KEY = ['job_type', 'job_tag', 'job_region'];

    public static function init()
    {
        self::insert([
            'name'		=> 'job_type',
            'label'     => __('Job Type', "jojo"),
            'type'      => 'select',
            'level'     => 1,
            'support_user_filter' => true,
        ]);
        self::insert([
            'name'		=> 'job_tag',
            'label'     => __('Job Tag', "jojo"),
            'type'      => 'checkbox',
            'level'     => 1,
            'support_user_filter' => true,
        ]);
        self::insert([
            'name'		=> 'job_region',
            'label'     => __('Job Region', "jojo"),
            'type'      => 'radio',
            'level'     => 1,
            'support_user_filter' => true,
        ]);
    }

    public static function extra_tablenav($which)
	{
		if ($which != 'top') {
			return;
		}
		echo wpjam_get_list_table_row_action('init', ['class'=>'button button-primary']);
	}

    public static function get_fields(){
        return [
            'name'		=> ['title'=>__('Name', "jojo"), 'type'=>'text', 'required'=>true, 'placeholder'=>'job_'],
            'label'     => ['title'=>__('Label', "jojo"), 'type'=>'text', 'required'=>true, 'show_admin_column'=>true],
            'type'      => ['title'=>__('Type Style', "jojo"), 'type'=>'select', 'required'=>true, 'options'=>self::get_types(), 'show_admin_column'=>true],
            'level'     => ['title'=>__('Level', "jojo"), 'type'=>'hidden', 'required'=>true, 'value'=>1, 'max'=>3],
            'support_user_filter' => ['title'=> __('Support User Filter', "jojo"), 'type'=>'checkbox', 'value'=>true, 'show_admin_column'=>true],
        ];
    }

    public static function get_types(){
        return [
            'select'     => __('Select', "jojo"),
            'radio'      => __('Radio', "jojo"),
            'checkbox'   => __('Checkbox', "jojo"),
        ];
    }

    public static function get_actions()
    {
        return array_merge(parent::get_actions(),[
			'init' => ['title' => __('init', 'jojo'), 'row_actions'=>false, 'confirm' => true, 'direct' => true, 'response'=>'list'],
        ]);
    }

    public static function update($id, $data)
    {
        $option = static::get($id);

        foreach(self::DISABLE_KEY as $key){
            if($option['name'] == $key && $data['name'] != $key){
                return new WP_Error('invalid_name', __('Can not edit this taxonomy name, this is required taxonomy', "jojo"));
            }
        }
        

        return parent::update($id, $data);
    }

    public static function delete($id){
        $option = static::get($id);

        foreach(self::DISABLE_KEY as $key){
            if($option['name'] == $key){
                return new WP_Error('invalid_name', __('Can not delete this taxonomy, this is requried taxonomy', "jojo"));
            }
        }

        return parent::delete($id);
    }

    public static function validate_data($data, $id=0)
    {
        if(!str_starts_with($data['name'], 'job_')){
            return new WP_Error('invalid_name_format', __('Name Need use `job_` prefix and with some letters', "jojo"));
        }
        $all = self::get_all();
        if(array_filter($all, function($item)use($data, $id){
            if($id){
                return $data['name'] == $item['name'] && $item['id'] != $id;
            }else{
                return $data['name'] == $item['name'];
            }
        })){
            return new WP_Error("invalidate_data", __("Name already exists", "jojo"));
        }
        return parent::validate_data($data, $id);
    }

    protected static $handler;

	public static function get_handler(){
		if(is_null(static::$handler)){
			static::$handler = new WPJAM_Option('jojo-taxonomy-option', ['primary_key' => 'id']);
		}
		return static::$handler;
	}
}