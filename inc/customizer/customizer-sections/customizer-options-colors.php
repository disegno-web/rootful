<?php

add_action( 'customize_register', 'color_customizer_settings' );

function color_customizer_settings( $wp_customize ) {

	// Adding Panel
	
	$wp_customize -> add_panel( 'farben', array(
		'title'	=>	'Farben',
		'description'	=>	'Einstellungen der Farben',
		'priority'	=>	190,
	) );
	
	// Textfarben
	$wp_customize -> add_section( 'textfarben', array(
		'title'	=>	'Textfarben',
		'panel'	=>	'farben',
	) );
	
	/* Fließtext */
		
	$wp_customize 	->	add_setting( 'text_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'text_color', array(
		'label'		=>	'Schriftfarbe Fließtext',
		'section'	=>	'textfarben',
		'settings'	=>	'text_color',
	)));
	
	/* Headings */
	
	$wp_customize 	->	add_setting( 'h1_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'h1_color', array(
		'label'		=>	'Schriftfarbe H1',
		'section'	=>	'textfarben',
		'settings'	=>	'h1_color',
	)));
	
	
	$wp_customize 	->	add_setting( 'h2_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'h2_color', array(
		'label'		=>	'Schriftfarbe H2',
		'section'	=>	'textfarben',
		'settings'	=>	'h2_color',
	)));
	
	
	$wp_customize 	->	add_setting( 'h3_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'h3_color', array(
		'label'		=>	'Schriftfarbe H3',
		'section'	=>	'textfarben',
		'settings'	=>	'h3_color',
	)));
	
	
	$wp_customize 	->	add_setting( 'h4_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'h4_color', array(
		'label'		=>	'Schriftfarbe H4',
		'section'	=>	'textfarben',
		'settings'	=>	'h4_color',
	)));
	
	
	$wp_customize 	->	add_setting( 'h5_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'h5_color', array(
		'label'		=>	'Schriftfarbe H5',
		'section'	=>	'textfarben',
		'settings'	=>	'h5_color',
	)));
	
	
	$wp_customize 	->	add_setting( 'h6_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'h6_color', array(
		'label'		=>	'Schriftfarbe H6',
		'section'	=>	'textfarben',
		'settings'	=>	'h6_color',
	)));

	
	// Links
	$wp_customize -> add_section( 'menu_links', array(
		'title'	=>	'Menü & Links',
		'panel'	=>	'farben',
	) );
	
	/* Menütext */
		
	$wp_customize 	->	add_setting( 'menu_color', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'menu_color', array(
		'label'		=>	'Schriftfarbe Menü (Default)',
		'section'	=>	'menu_links',
		'settings'	=>	'menu_color',
	)));
	
	$wp_customize 	->	add_setting( 'menu_color_hover', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'menu_color_hover', array(
		'label'		=>	'Schriftfarbe Menü (Hover)',
		'section'	=>	'menu_links',
		'settings'	=>	'menu_color_hover',
	)));
	
	$wp_customize 	->	add_setting( 'menu_color_active', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'menu_color_active', array(
		'label'		=>	'Schriftfarbe Menü (Aktiv)',
		'section'	=>	'menu_links',
		'settings'	=>	'menu_color_active',
	)));
	
	
	
	/* Link */
		
	$wp_customize 	->	add_setting( 'link_default', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'link_default', array(
		'label'		=>	'Schriftfarbe Links (Default)',
		'section'	=>	'menu_links',
		'settings'	=>	'link_default',
	)));
	
	$wp_customize 	->	add_setting( 'link_hover', array(
		'default'	=>	'#244093',
		'transport'	=>	'refresh',
	));
	
	$wp_customize	->	add_control ( new WP_Customize_Color_Control ( $wp_customize, 'link_hover', array(
		'label'		=>	'Schriftfarbe Links (Hover)',
		'section'	=>	'menu_links',
		'settings'	=>	'link_hover',
	)));
	
	
}