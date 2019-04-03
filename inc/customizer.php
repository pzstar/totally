<?php

function totally_customize_register($wp_customize) {
    //HEADER SETTINGS
    $wp_customize->get_section('total_header_settings')->panel = '';
    $wp_customize->get_section('total_header_settings')->priority = 10;

    $wp_customize->add_setting('totally_left_header_text', array(
        'sanitize_callback' => 'wp_kses_post',
        'default' => 'Aveneu Park, Starling, Australia'
    ));

    $wp_customize->add_control('totally_left_header_text', array(
        'type' => 'textarea',
        'section' => 'total_header_settings',
        'label' => esc_html__('Top left Header Content', 'square-plus')
    ));

    $wp_customize->add_setting(
            'totally_right_header_info', array(
        'sanitize_callback' => 'total_sanitize_text'
            )
    );

    $wp_customize->add_control(
            new Total_Info_Text(
            $wp_customize, 'totally_right_header_info', array(
                'settings' => 'totally_right_header_info',
                'section' => 'total_header_settings',
                'label' => esc_html__('Top Right Header Socials Icons', 'total'),
                'description' => wp_kses_post(__('You can additionally add widget in the top header by going to Widget Page and adding widget in Top Header Widget', 'total')),
            )
            )
    );
    
    $wp_customize->add_setting(
            'totally_facebook_link',
            array(
                'sanitize_callback' => 'esc_url_raw'
            )
    );

    $wp_customize->add_control(
            'totally_facebook_link',
            array(
                    'settings' => 'totally_facebook_link',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'Facebook', 'total' )
            )
    );
    
    $wp_customize->add_setting(
            'totally_twitter_link',
            array(
                'sanitize_callback' => 'esc_url_raw'
            )
    );

    $wp_customize->add_control(
            'totally_twitter_link',
            array(
                    'settings' => 'totally_twitter_link',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'Twitter', 'total' )
            )
    );
    
    $wp_customize->add_setting(
            'totally_instagram_link',
            array(
                'sanitize_callback' => 'esc_url_raw'
            )
    );

    $wp_customize->add_control(
            'totally_istagram_link',
            array(
                    'settings' => 'totally_instagram_link',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'Instagram', 'total' )
            )
    );
    
    $wp_customize->add_setting(
            'totally_youtube_link',
            array(
                'sanitize_callback' => 'esc_url_raw'
            )
    );

    $wp_customize->add_control(
            'totally_youtube_link',
            array(
                    'settings' => 'totally_youtube_link',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'Youtube', 'total' )
            )
    );
    
    $wp_customize->add_setting(
            'totally_pinterest_link',
            array(
                'sanitize_callback' => 'esc_url_raw'
            )
    );

    $wp_customize->add_control(
            'totally_pinterest_link',
            array(
                    'settings' => 'totally_pinterest_link',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'Pinterest', 'total' )
            )
    );
    
    $wp_customize->add_setting(
            'totally_linkedin_link',
            array(
                'sanitize_callback' => 'esc_url_raw'
            )
    );

    $wp_customize->add_control(
            'totally_linkedin_link',
            array(
                    'settings' => 'totally_linkedin_link',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'LinkedIn', 'total' )
            )
    );
    
    $wp_customize->add_setting(
            'totally_mh_button', array(
            'sanitize_callback' => 'total_sanitize_text'
            )
    );

    $wp_customize->add_control(
            new Total_Info_Text(
            $wp_customize, 'totally_mh_button', array(
                'settings' => 'totally_mh_button',
                'section' => 'total_header_settings',
                'label' => esc_html__('Main Header Button', 'total'),
                'description' => wp_kses_post(__('This button appear at the right end of the main header.', 'total')),
            )
            )
    );
    
    $wp_customize->add_setting(
            'totally_mh_button_text',
            array(
                'sanitize_callback' => 'total_sanitize_text'
            )
    );

    $wp_customize->add_control(
            'totally_mh_button_text',
            array(
                    'settings' => 'totally_mh_button_text',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'Main Header Button Text', 'total' )
            )
    );
    
    $wp_customize->add_setting(
            'totally_mh_button_link',
            array(
                'sanitize_callback' => 'total_sanitize_text'
            )
    );

    $wp_customize->add_control(
            'totally_mh_button_link',
            array(
                    'settings' => 'totally_mh_button_link',
                    'section' => 'total_header_settings',
                    'type' => 'text',
                    'label' => esc_html__( 'Main Header Button Link', 'total' )
            )
    );
}

add_action('customize_register', 'totally_customize_register', 50);