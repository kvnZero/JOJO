<?php
class JOJO_Customize {

    /**
     * Register customizer options.
     *
     * @since JOJO 1.0
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    public static function register( $wp_customize ) {
    
        /**
         * Site Identity
         */
        // Header & Footer Background Color.
        $wp_customize->add_setting(
            'header_footer_background_color',
            array(
                'default'           => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
    
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'header_footer_background_color',
                array(
                    'label'   => __( 'Header &amp; Footer Background Color' , "jojo"),
                    'section' => 'colors',
                )
            )
        );


        $wp_customize->add_setting(
            'site_secondary_color',
            array(
                'default'           => '#212529bf',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
    
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'site_secondary_color',
                array(
                    'label'   => __( 'Site Secondary Color' , "jojo"),
                    'section' => 'colors',
                )
            )
        );


        $wp_customize->add_setting(
            'site_link_color',
            array(
                'default'           => '#0d6efd',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
    
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'site_link_color',
                array(
                    'label'   => __( 'Site Link Color' , "jojo"),
                    'section' => 'colors',
                )
            )
        );
        
        $wp_customize->add_setting(
            'site_link_hover_color',
            array(
                'default'           => '#0a58ca',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
    
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'site_link_hover_color',
                array(
                    'label'   => __( 'Site Link Hover Color' , "jojo"),
                    'section' => 'colors',
                )
            )
        );



        $wp_customize->add_setting(
            'hidden_site_header_nav',
            array(
                'default'           => false,
                'sanitize_callback' => fn($checked) => ( ( isset( $checked ) && true === $checked ) ? true : false ),
            )
        );

        $wp_customize->add_control(
            'hidden_site_header_nav',
            array(
                'type'    => 'checkbox',
                'section' => 'title_tagline',
                'label'   => esc_html__( 'Hidden Site Header Nav' , "jojo"),
            )
        );

        
        $wp_customize->add_setting(
            'hidden_footer_email_subscribe',
            array(
                'default'           => false,
                'sanitize_callback' => fn($checked) => ( ( isset( $checked ) && true === $checked ) ? true : false ),
            )
        );

        $wp_customize->add_control(
            'hidden_footer_email_subscribe',
            array(
                'type'    => 'checkbox',
                'section' => 'title_tagline',
                'label'   => esc_html__( 'Hidden Footer Email Subscribe' , "jojo"),
            )
        );

       

        $wp_customize->add_setting(
            'enable_header_language',
            array(
                'default'           => false,
                'sanitize_callback' => fn($checked) => ( ( isset( $checked ) && true === $checked ) ? true : false ),
            )
        );

        $wp_customize->add_control(
            'enable_header_language',
            array(
                'type'    => 'checkbox',
                'section' => 'title_tagline',
                'label'   => esc_html__( 'Enable Site Language Switch' , "jojo"),
            )
        );

        $wp_customize->add_setting(
            'hidden_jojo_design',
            array(
                'default'           => false,
                'sanitize_callback' => fn($checked) => ( ( isset( $checked ) && true === $checked ) ? true : false ),
            )
        );

        $wp_customize->add_control(
            'hidden_jojo_design',
            array(
                'type'    => 'checkbox',
                'section' => 'title_tagline',
                'label'   => esc_html__( 'Hidden JOJO Design' , "jojo"),
            )
        );
  
        $wp_customize->add_setting(
            'footer_text',
            array(
                'default'           => '',
            )
        );

        $wp_customize->add_control(
            'footer_text',
            array(
                'type'    => 'textarea',
                'section' => 'title_tagline',
                'label'   => esc_html__( 'Footer Text' , "jojo"),
            )
        );



        // Main Cover
        $wp_customize->add_section('front_main_page', [
            'title' => __('Front Main Page', "jojo"),
        ]);

        $wp_customize->add_setting(
            'front_main_page_cover_image',
            [
                'default'           => '',
                'transport'         => 'postMessage',
            ]
        );
        $wp_customize->add_setting(
            'front_main_page_cover_title',
            [
                'default'           => '',
                'transport'         => 'postMessage',
            ]
        );
        // $wp_customize->add_setting(
        //     'front_main_page_cover_subtitle',
        //     [
        //         'default'           => '',
        //         'transport'         => 'postMessage',
        //     ]
        // );
        $wp_customize->add_control(
            new WP_Customize_Upload_Control(
                $wp_customize,
                'front_main_page_cover_image',
                array(
                    'section' => 'front_main_page',
                    'label'   => __( 'Cover Image' , "jojo"),
                    'mime_type' => 'image',
                )
            )
        );
        $wp_customize->add_control('front_main_page_cover_title', [
            'type' => 'text',
            'label' => __('Cover Title', "jojo"),
            'section' => 'front_main_page',

        ]);
        // $wp_customize->add_control('front_main_page_cover_subtitle', [
        //     'type' => 'text',
        //     'label' => __('Cover Sub Title'),
        //     'section' => 'front_main_page',
        // ]);
        $wp_customize->add_setting(
            'front_main_page_cover_title_color',
            array(
                'default'           => '#000000',
                'sanitize_callback' => 'sanitize_hex_color',
                'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'front_main_page_cover_title_color',
                array(
                    'label'   => __( 'Cover Title Font Color' , "jojo"),
                    'section' => 'front_main_page',
                )
            )
        );
        
        // $wp_customize->add_setting(
        //     'front_main_page_cover_subtitle_color',
        //     array(
        //         'default'           => '#000000',
        //         'sanitize_callback' => 'sanitize_hex_color',
        //         'transport'         => 'postMessage',
        //     )
        // );
        // $wp_customize->add_control(
        //     new WP_Customize_Color_Control(
        //         $wp_customize,
        //         'front_main_page_cover_subtitle_color',
        //         array(
        //             'label'   => __( 'Cover Sub Title Font Color' ),
        //             'section' => 'front_main_page',
        //         )
        //     )
        // );


        $wp_customize->remove_section('static_front_page');



        // Social Media 
        $wp_customize->add_section('social_media', [
            'title' => __('Social Media', "jojo"),
        ]);
        foreach([
            'x' => __("X", "jojo"),
            'wechat' => __("Wechat", "jojo"),
            'youtube' => __("Youtube", "jojo"),
            'facebook' => __("Facebook", "jojo"),
            'instagram' => __("Instagram", "jojo"),
            'weibo' => __("Weibo", "jojo"),
            'github' => __("Github", "jojo"),
            'qq' => __("QQ", "jojo"),
            'tiktok' => __("Tiktok", "jojo"),
            'email' => __('Email', "jojo"),
            'redbook' => __('Redbook', "jojo"),
            'bilibil' => __('Bilibili', "jojo"),
        ] as $media_key => $media_label) {
            
            $wp_customize->add_setting(
                'social_media_' . $media_key,
                [
                    'default'           => '',
                    'transport'         => 'postMessage',
                ]
            );
            $wp_customize->add_setting(
                'social_media_' . $media_key.'_qrcode',
                [
                    'default'           => '',
                    'transport'         => 'postMessage',
                ]
            );
            $wp_customize->add_control('social_media_' .$media_key, [
                'type' => 'text',
                'label' => $media_label,
                'section' => 'social_media',
            ]);
            $wp_customize->add_control(
                new WP_Customize_Upload_Control(
                    $wp_customize,
                   'social_media_' . $media_key.'_qrcode',
                    array(
                        'section' => 'social_media',
                        'label'   => $media_label.' '.__( 'QRCODE' , "jojo"),
                        'mime_type' => 'image',
                    )
                )
            );
        }


        // Job Detail
        $wp_customize->add_section('job_detail_page', [
            'title' => __('Job Detail Page', "jojo"),
        ]);
        $wp_customize->add_setting(
            'job_deliver_detail',
            [
                'default'           => '',
                'transport'         => 'postMessage',
            ]
        );
        $wp_customize->add_control('job_deliver_detail', [
            'type' => 'textarea',
            'label' => __('Job Deliver Detail', "jojo"),
            'section' => 'job_detail_page',
        ]);

        $wp_customize->add_setting(
            'show_related_job',
            array(
                'default'           => false,
                'sanitize_callback' => fn($checked) => ( ( isset( $checked ) && true === $checked ) ? true : false ),
            )
        );

        $wp_customize->add_control(
            'show_related_job',
            array(
                'type'    => 'checkbox',
                'section' => 'job_detail_page',
                'label'   => esc_html__( 'Show Related Job' , "jojo"),
            )
        );

        $wp_customize->add_setting(
            'show_related_job_number',
            [
                'default'           => 3,
                'transport'         => 'postMessage',
            ]
        );
        $wp_customize->add_control('show_related_job_number', [
            'type' => 'number',
            'label' => __('Show Related Job Number', "jojo"),
            'section' => 'job_detail_page',
        ]);
        
    }
}
    
// Setup the Theme Customizer settings and controls.
add_action( 'customize_register', array( 'JOJO_Customize', 'register' ) );