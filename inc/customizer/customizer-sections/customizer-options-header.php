<?php

add_action( 'customize_register', 'header_customizer_settings' );

function header_customizer_settings( $wp_customize ) {
	
	// Adding Panel
	
	$wp_customize -> add_panel( 'header', array(
		'title'	=>	'Header',
		'description'	=>	'Einstellungen zum Aussehen und Inhalt des Headers.',
		'priority'	=>	170,
	) );
	
	// Header Top Bar
	
	$wp_customize -> add_section( 'header_top_bar', array(
		'title'	=>	'Header Top Bar',
		'panel'	=>	'header',
	) );
	
	$wp_customize->add_setting( 'show_top_bar_toggle',
	   array(
		  'default' => 0,
		  'transport' => 'refresh',
		  'sanitize_callback' => 'rootful_switch_sanitization'
	   )
	);
	
	$wp_customize -> add_control( new Rootful_Toggle_Switch_Custom_Control( $wp_customize, 'show_top_bar_toggle', array(
		'label'	=>	'Header Top Bar Aktivierung',
		'section'	=>	'header_top_bar'
	) ) );
	
	
	$wp_customize -> add_setting( 'top_bar_left_content', array(
		'default'	=>	'',
		'transport'	=>	'refresh',
	));
	
	$wp_customize -> add_control( new Rootful_TinyMCE_Custom_control ( $wp_customize, 'top_bar_left_content', array(
		'label'	=>	'Text/HTML für linke Seite',
		'section'	=>	'header_top_bar',
		'active_callback'	=>	function ( $control ) {
			return $control->manager->get_setting("show_top_bar_toggle")->value();
		},
	) ) );
	
	$wp_customize -> add_setting( 'top_bar_right_content', array(
		'default'	=>	'',
		'transport'	=>	'refresh',
	));
	
	$wp_customize -> add_control( new Rootful_TinyMCE_Custom_control ( $wp_customize, 'top_bar_right_content', array(
		'label'	=>	'Text/HTML für rechte Seite',
		'section'	=>	'header_top_bar',
		'active_callback'	=>	function ( $control ) {
			return $control->manager->get_setting("show_top_bar_toggle")->value();
		},
	) ) );
	
	$wp_customize -> add_setting( 'top_bar_background', array(
		'default'	=>	'#333333',
		'transport'	=>	'refresh',
	) );
	
	$wp_customize -> add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_background', array(
		'label'		=>	'Hintergrundfarbe',
		'section'	=>	'header_top_bar',
		'active_callback'	=>	function ( $control ) {
			return $control->manager->get_setting("show_top_bar_toggle")->value();
		},
	) ) );
	
	$wp_customize -> add_setting( 'top_bar_color', array(
		'default'	=>	'#333333',
		'transport'	=>	'refresh',
	) );
	
	$wp_customize -> add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_color', array(
		'label'		=>	'Textfarbe',
		'section'	=>	'header_top_bar',
		'active_callback'	=>	function ( $control ) {
			return $control->manager->get_setting("show_top_bar_toggle")->value();
		},
	) ) );
	
	
	// Textgröße Header Top Bar
	$wp_customize -> add_setting( 'top_bar_fontsize', array(
		'default'	=>	14,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'top_bar_fontsize', array(
		'label'	=>	'Schriftgröße (px)',
		'section'	=>	'header_top_bar',
		'input_attrs'	=>	array(
			'min'	=>	7,
			'max'	=>	18,
			'step'	=>	1,
		),
	)));
	
	
	// Header Top Bar
	
	$wp_customize -> add_section( 'header_bottom', array(
		'title'	=>	'Header Bottom',
		'panel'	=>	'header',
	) );
	
	
	$wp_customize->add_setting( 'show_boxshadow_header',
	   array(
		  'default' => 0,
		  'transport' => 'refresh',
		  'sanitize_callback' => 'rootful_switch_sanitization'
	   )
	);
	
	$wp_customize -> add_control( new Rootful_Toggle_Switch_Custom_Control( $wp_customize, 'show_boxshadow_header', array(
		'label'	=>	'Schlagschatten',
		'section'	=>	'header_bottom'
	) ) );
	
	
	$wp_customize->add_setting( 'show_border_header',
	   array(
		  'default' => 0,
		  'transport' => 'refresh',
		  'sanitize_callback' => 'rootful_switch_sanitization'
	   )
	);
	
	$wp_customize -> add_control( new Rootful_Toggle_Switch_Custom_Control( $wp_customize, 'show_border_header', array(
		'label'	=>	'Rahmen (unten)',
		'section'	=>	'header_bottom'
	) ) );
	
	$wp_customize -> add_setting( 'header_bottom_border_color', array(
		'default'	=>	'#333333',
		'transport'	=>	'refresh',
	) );
	
	$wp_customize -> add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bottom_border_color', array(
		'label'		=>	'Rahmenfarbe',
		'section'	=>	'header_bottom',
		'active_callback'	=>	function ( $control ) {
			return $control->manager->get_setting("show_border_header")->value();
		},
	) ) );
	
	
	$wp_customize -> add_setting( 'header_bottom_border_width', array(
		'default'	=>	3,
		'transport'	=>	'refresh',
	)
	);
	
	$wp_customize -> add_control ( new Rootful_Slider_Custom_Control( $wp_customize, 'header_bottom_border_width', array(
		'label'	=>	'Rahmenbreite',
		'section'	=>	'header_bottom',
		'input_attrs'	=>	array(
			'min'	=>	1,
			'max'	=>	12,
			'step'	=>	1,
		),
		'active_callback'	=>	function ( $control ) {
			return $control->manager->get_setting("show_border_header")->value();
		},
	)));


}