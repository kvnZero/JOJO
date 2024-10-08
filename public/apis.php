<?php
add_action( 'wp_ajax_nopriv_job_list_ajax_request', 'jojo_job_list_ajax_request' );
add_action( 'wp_ajax_job_list_ajax_request', 'jojo_job_list_ajax_request' );

function jojo_validate_default_conf(){
    $taxonomy_validate = taxonomy_exists('job_category') && taxonomy_exists('job_type') && taxonomy_exists('job_region');
    if(!$taxonomy_validate){
        return new WP_Error("error_default_conf_by_taxonomy", __("Default configuration by taxonomy not found, please login in admin page init config", 'jojo'));
    }

    return true;
}

function jojo_job_list_ajax_request()
{
    if(!jojo_validate_default_conf()){
        wp_die();
    }

    $data = $_POST['data'];
    $limit = $data['limit'] ?? 10;
    $limit = $limit > 10 ? 10 : $limit;

    $args = array(
        'post_type'      => 'job',
        'posts_per_page' => $limit,
        'paged'          => $data['page'] ?? 1,
        'post_status'    => 'publish'
    );

    foreach($data['filter'] ?? [] as $item){
        if($item['value']){
            if($item['name'] == 's'){
                $args['s'] = $item['value'];
            }else{
                if(!isset($args['tax_query'][$item['name']])){
                    $args['tax_query'][$item['name']] = [
                        'taxonomy' => $item['name'],
                        'field'    => 'term_id',
                        'operator' => 'IN',
                        'terms'    => [],
                    ];
                }
                $args['tax_query'][$item['name']]['terms'][] = $item['value'];
            }
        }
        
    }
    
    !empty($args['tax_query']) && $args['tax_query'] = array_values($args['tax_query']);

    if(!empty($args['tax_query'])){
        $args['tax_query']['relation'] = "AND";
    }

    if (isset($data['job_type']) && !empty($data['job_type'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'job_type',
                'field' => 'slug',
                'terms' => $data['job_type'],
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('parts/part', 'job-card');
        }
        echo '<li class="list-group-item job-item mb-4 d-flex justify-content-center">';
        get_template_part('parts/part', 'pagination', [
            'page'  => $data['page'] ?? 1,
            'total' => $query->found_posts,
            'limit' => $limit,
            'id'    => 'job-list-pagination-default'
        ]);
        echo '</li>';
    } else {
        echo '<p class="no-job-tips my-4">'.__('No jobs found.', "jojo").'</p>';
    }
    wp_reset_postdata();
    wp_die();
}