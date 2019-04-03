<?php

add_action('wp_enqueue_scripts', 'totally_enqueue_styles');

function totally_enqueue_styles() {
    wp_enqueue_style('totally-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('totally-style', get_stylesheet_directory_uri() . '/style.css', array('totally-parent-style'), '1.0');
}
