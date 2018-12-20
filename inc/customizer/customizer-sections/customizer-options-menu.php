<?php

add_action( 'customize_register', 'menu_customizer_settings' );

function menu_customizer_settings( $wp_customize ) {
	
	$wp_customize -> add_section( 'primary_menu', array(
		'title'	=>	'Hauptmenü',
		'priority'	=>	250,
	) );
	
	$wp_customize->add_setting( 'menu_item_color',
	   array(
		  'default' => '#333333',
		  'transport' => 'refresh',
	   )
	);
	
	$wp_customize -> add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_color', array(
		'label'		=>	'Farbe Menüpunkt',
		'section'	=>	'primary_menu',
	) ) );
	
	$wp_customize->add_setting( 'menu_item_hover_color',
	   array(
		  'default' => '#333333',
		  'transport' => 'refresh',
	   )
	);
	
	$wp_customize -> add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_hover_color', array(
		'label'		=>	'Farbe Menüpunkt Hover',
		'section'	=>	'primary_menu',
	) ) );
	
	$wp_customize->add_setting( 'menu_item_active_color',
	   array(
		  'default' => '#333333',
		  'transport' => 'refresh',
	   )
	);
	
	$wp_customize -> add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_item_active_color', array(
		'label'		=>	'Farbe aktiver Menüpunkt',
		'section'	=>	'primary_menu',
	) ) );
	
	$wp_customize->add_setting( 'menu_item_active_border',
	   array(
		  'default' => '#333333',
		  'transport' => 'refresh',
		   'sanitize_callback'	=>	'rootful_text_sanitization'
	   )
	);
	
	$wp_customize->add_control( new Rootful_Dropdown_Select2_Custom_Control( $wp_customize, 'menu_item_active_border',
	array(
		'label' => 'Stil aktiver Menüpunkt',
		'section' => 'primary_menu',
		'input_attrs' => array(
			'placeholder' => 'Bitte wählen Sie einen Menüstil aus.',
			'multiselect' => false,
		),
		'choices' => array(
			'none'	=>	'Kein Rahmen',
			'underline'	=>	'Unterstrichen',
			'border-right'	=>	'Rahmen Rechts',
			'border-left'	=>	'Rahmen Links',
		)
	)
) );
	
	
	
}