<?php
class JOJO_Job extends WPJAM_Post {
    public static function get_current_post_type()
    {
        return 'job';
    }

    public static function flush($id)
    {
        return parent::update($id, [
            'post_date' => date('Y-m-d H:i:s')
        ]);
    }

    public static function get_actions()
    {
        return [
            'flush' => ['title'=>__("Flush", 'jojo'), 'direct'=>'true', 'bulk'=>true] 
        ];
    }
}