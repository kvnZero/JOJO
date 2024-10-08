<?php

/**
 * @Author: Abigeater
 * @Email:  abigeater@163.com
 * @Link:   abigeater.com
 */

get_header(); 
?>

<main id="site-content">
    <?php
    $front_main_page_cover_image        = get_theme_mod( 'front_main_page_cover_image', '' );

    if($front_main_page_cover_image) {
        $front_main_page_cover_title    = get_theme_mod( 'front_main_page_cover_title', '' );
        $front_main_page_cover_subtitle = get_theme_mod( 'front_main_page_cover_subtitle', '' );
        get_template_part( 'parts/part', 'cover', [
            'id'     => 'main-cover',
            'covers' => [
                [
                    'img' => $front_main_page_cover_image,
                    'img_alt' => get_bloginfo( 'name' ),
                    'show_text' => !empty($front_main_page_cover_title) || !empty($front_main_page_cover_subtitle), 
                    'title' => $front_main_page_cover_title,
                    'desc'  => $front_main_page_cover_subtitle
                ],
            ],
            'title_color'    => get_theme_mod( 'front_main_page_cover_title_color', '' ),
            'subtitle_color' => get_theme_mod( 'front_main_page_cover_subtitle_color', '' ),
        ]);
    }

    $options        = JOJO_Taxonomy_Option::get_all();
    $filter_options = [];
    foreach($options as $option) {
        if(!$option['support_user_filter']){
            continue;
        }
        $term_options = array_map(function($term){
            return [
                'key'   => $term->term_id,
                'label' => $term->name,
            ];
        }, get_terms(['taxonomy'=>$option['name'], 'hide_empty' => false]));
        $term_options && $filter_options[] = array_merge($option, [
            'options' => $term_options,
        ]);
    }

    get_template_part( 'parts/part', 'job-list', [
        'options' => [
            'support_search' => true,
            'filter_options' => $filter_options,
        ]
    ]);
    ?>
</main>

<?php
get_footer(); 