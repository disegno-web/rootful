<?php

add_action( 'customize_register', 'general_customizer_settings' );

function general_customizer_settings( $wp_customize ) {
	
	// Logo
	
	$wp_customize -> add_setting( 'logo', array(
		'default'	=>	'',
		'transport'	=>	'refresh',
	));
	
	$wp_customize -> add_control( new WP_Customize_Image_Control ( $wp_customize, 'logo', array(
		'label'	=>	'Logo',
		'section'	=>	'title_tagline',
		'settings'	=>	'logo',
		'priority'	=>	0,
	) ) );
	
	
	
	// Adding Panel
	
	$wp_customize -> add_panel( 'allgemeines', array(
		'title'	=>	'Allgemeines',
		'description'	=>	'Einstellungen zum Aussehen und Inhalt der Webseite.',
		'priority'	=>	190,
	) );
	
	// Add a custom layout section
	$wp_customize -> add_section( 'layout', array(
		'title'	=>	'Layout',
		'panel'	=>	'allgemeines',
	) );
	
	// Add layout setting
	$wp_customize -> add_setting( 'layout', array(
		'default'	=>	'full-width-content-boxed',
		'transport'	=>	'refresh',
		'sanitize_callback'	=>	'rootful_text_sanitization',
	)
	);
	
	// Add layout control
	$wp_customize -> add_control( new Rootful_Image_Radio_Button_Custom_Control( $wp_customize, 'layout', array(
		'label'	=>	'Layout',
		'section'	=>	'layout',
		'choices'	=>	array(
			'full-width-content-boxed'	=>	array(
				'image'	=>	trailingslashit( get_template_directory_uri() ). '/inc/customizer/assets/img/rootful-web-layout_full-width-content-boxed.png',
				'name'	=>	'Full-Width | Content boxed'
			),
			'full-width'	=>	array(
				'image'	=>	trailingslashit( get_template_directory_uri() ). '/inc/customizer/assets/img/rootful-web-layout_full-width.png',
				'name'	=>	'Full-Width'
			),
			'boxed'	=>	array(
				'image'	=>	trailingslashit( get_template_directory_uri() ). '/inc/customizer/assets/img/rootful-web-layout_boxed.png',
				'name'	=>	'Boxed'
			),
		)
	)));	
	
	
	// Containerbreite
	$wp_customize -> add_setting( 'containerbreite', array(
		'default'	=>	1040,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'containerbreite', array(
		'label'	=>	'Containerbreite (px)',
		'section'	=>	'layout',
		'input_attrs'	=>	array(
			'min'	=>	768,
			'max'	=>	1920,
			'step'	=>	5,
		),
	)));


}