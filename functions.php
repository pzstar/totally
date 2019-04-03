<?php
add_action( 'wp_enqueue_scripts', 'total_enqueue_styles' );
function total_enqueue_styles() {
    wp_enqueue_style( 'total-parent-style', get_template_directory_uri() . '/style.css' );
}

function total_child_customize_register( $wp_customize ) {
	/*============Footer credit link============*/
	$wp_customize->add_section(
		'total_footer_text_sec',
		array(
			'title'			=> __( 'Footer Text', 'total' ),
		)
	);

	$wp_customize->add_setting(
		'total_footer_text',
		array(
			'default'			=> '',
			'sanitize_callback' => 'wp_kses_post'
		)
	);

	$wp_customize->add_control(
		'total_footer_text',
		array(
			'settings'		=> 'total_footer_text',
			'section'		=> 'total_footer_text_sec',
			'type'			=> 'text',
			'label'			=> __( 'Footer Credit Text', 'total' )
		)
	);
}
add_action( 'customize_register', 'total_child_customize_register', 50 );

if(function_exists('pll_register_string')){
	pll_register_string( 'total', 'Read More' );
	pll_register_string( 'total', 'Detail' );
}