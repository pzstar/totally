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
        'label' => esc_html__('Top left Header Content', 'totally')
    ));

    $wp_customize->add_setting('totally_right_header_info', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Info_Text($wp_customize, 'totally_right_header_info', array(
        'settings' => 'totally_right_header_info',
        'section' => 'total_header_settings',
        'label' => esc_html__('Top Right Header Socials Icons', 'totally'),
        'description' => esc_html__('You can additionally add widget in the top header by going to Widget Page and adding widget in Top Header Widget', 'totally'),
    )));

    $wp_customize->add_setting('totally_facebook_link', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('totally_facebook_link', array(
        'settings' => 'totally_facebook_link',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Facebook', 'totally')
    ));

    $wp_customize->add_setting('totally_twitter_link', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('totally_twitter_link', array(
        'settings' => 'totally_twitter_link',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Twitter', 'totally')
    ));

    $wp_customize->add_setting('totally_instagram_link', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('totally_istagram_link', array(
        'settings' => 'totally_instagram_link',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Instagram', 'totally')
    ));

    $wp_customize->add_setting('totally_youtube_link', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('totally_youtube_link', array(
        'settings' => 'totally_youtube_link',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Youtube', 'totally')
    ));

    $wp_customize->add_setting('totally_pinterest_link', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('totally_pinterest_link', array(
        'settings' => 'totally_pinterest_link',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Pinterest', 'totally')
    ));

    $wp_customize->add_setting('totally_linkedin_link', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('totally_linkedin_link', array(
        'settings' => 'totally_linkedin_link',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('LinkedIn', 'totally')
    ));

    $wp_customize->add_setting('totally_header_contact_info', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'totally_header_contact_info', array(
        'settings' => 'totally_header_contact_info',
        'section' => 'total_header_settings',
        'label' => esc_html__('Header Contact Info', 'totally'),
        'description' => esc_html__('This section will appear beside Logo.', 'totally'),
    )));

    //Contact Infos
    $wp_customize->add_setting('totally_hci_icon1', array(
        'default' => 'fa fa-envelope',
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Fontawesome_Icon_Chooser($wp_customize, 'totally_hci_icon1', array(
        'settings' => 'totally_hci_icon1',
        'section' => 'total_header_settings',
        'type' => 'icon',
        'label' => esc_html__('Choose Icon', 'totally'),
    )));

    $wp_customize->add_setting('totally_hci_header1', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Email Us', 'totally')
    ));

    $wp_customize->add_control('totally_hci_header1', array(
        'settings' => 'totally_hci_header1',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Heading', 'totally')
    ));

    $wp_customize->add_setting('totally_hci_text1', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => 'info@yourdomain.com'
    ));

    $wp_customize->add_control('totally_hci_text1', array(
        'settings' => 'totally_hci_text1',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Text', 'totally')
    ));

    $wp_customize->add_setting('totally_hci_icon2', array(
        'default' => 'fa fa-phone',
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Fontawesome_Icon_Chooser($wp_customize, 'totally_hci_icon2', array(
        'settings' => 'totally_hci_icon2',
        'section' => 'total_header_settings',
        'type' => 'icon',
        'label' => esc_html__('Choose Icon', 'totally'),
    )));

    $wp_customize->add_setting('totally_hci_header2', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Call Us', 'totally')
    ));

    $wp_customize->add_control('totally_hci_header2', array(
        'settings' => 'totally_hci_header2',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Heading', 'totally')
    ));

    $wp_customize->add_setting('totally_hci_text2', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('+01 3434320324', 'totally')
    ));

    $wp_customize->add_control('totally_hci_text2', array(
        'settings' => 'totally_hci_text2',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Text', 'totally')
    ));

    $wp_customize->add_setting('totally_hci_icon3', array(
        'default' => 'fa fa-map-pin',
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Fontawesome_Icon_Chooser($wp_customize, 'totally_hci_icon3', array(
        'settings' => 'totally_hci_icon3',
        'section' => 'total_header_settings',
        'type' => 'icon',
        'label' => esc_html__('Choose Icon', 'totally'),
    )));

    $wp_customize->add_setting('totally_hci_header3', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('Find Us', 'totally')
    ));

    $wp_customize->add_control('totally_hci_header3', array(
        'settings' => 'totally_hci_header3',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Heading', 'totally')
    ));

    $wp_customize->add_setting('totally_hci_text3', array(
        'sanitize_callback' => 'total_sanitize_text',
        'default' => esc_html__('234 Littleton Street', 'totally')
    ));

    $wp_customize->add_control('totally_hci_text3', array(
        'settings' => 'totally_hci_text3',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Text', 'totally')
    ));


    $wp_customize->add_setting('totally_mh_button', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control(new Total_Customize_Heading($wp_customize, 'totally_mh_button', array(
        'settings' => 'totally_mh_button',
        'section' => 'total_header_settings',
        'label' => esc_html__('Navigation CTA Button', 'totally'),
        'description' => esc_html__('This button appear at the right end of the Menu.', 'totally'),
    )));

    $wp_customize->add_setting('totally_mh_button_text', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control('totally_mh_button_text', array(
        'settings' => 'totally_mh_button_text',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Button Text', 'totally')
    ));

    $wp_customize->add_setting('totally_mh_button_link', array(
        'sanitize_callback' => 'total_sanitize_text'
    ));

    $wp_customize->add_control('totally_mh_button_link', array(
        'settings' => 'totally_mh_button_link',
        'section' => 'total_header_settings',
        'type' => 'text',
        'label' => esc_html__('Button Link', 'totally')
    ));

    //TITLE BAR SETTINGS
    $wp_customize->add_section('totally_titlebar_settings', array(
        'title' => esc_html__('Title Bar Settings', 'totally'),
        'description' => esc_html__('It is the header bar where the title and breadcrumb appears', 'totally'),
        'priority' => 10
    ));

    $wp_customize->add_setting('totally_titlebar_background', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => get_stylesheet_directory_uri() . '/images/banner-image.jpg'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'totally_titlebar_background', array(
        'section' => 'totally_titlebar_settings',
        'description' => esc_html__('Recommended Image Size: 2000X600px', 'totally')
    )));
}

add_action('customize_register', 'totally_customize_register', 50);

function totally_customizer_script() {
    wp_enqueue_style('totally-customizer-style', get_stylesheet_directory_uri() . '/inc/customizer-control.css', array('wp-color-picker'), '1.0.0');
}

add_action('customize_controls_enqueue_scripts', 'totally_customizer_script');
