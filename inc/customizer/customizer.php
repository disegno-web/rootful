<?php

require get_template_directory() . '/inc/customizer/customizer-controls/custom-controls.php'; // Include custom controls, e.g. Radio Image Buttons,..

/* Add Customizer Styles */

require get_template_directory() . '/inc/customizer/customizer-styles.php';
	
require_once get_template_directory() . '/inc/customizer/options.php';

require_once get_template_directory() . '/inc/customizer/customizer-sections/customizer-options-header.php'; // Header

require_once get_template_directory() . '/inc/customizer/customizer-sections/customizer-options-general.php'; // Layout

require_once get_template_directory() . '/inc/customizer/customizer-sections/customizer-options-colors.php'; // Farben

require_once get_template_directory() . '/inc/customizer/customizer-sections/customizer-options-menu.php'; // Hauptmenü

require_once get_template_directory() . '/inc/customizer/customizer-sections/customizer-options-fonts.php'; // Hauptmenü


function enqueue_customizer_stylesheet() {
	wp_register_style( 'customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', NULL, NULL, 'all' );
	wp_enqueue_style( 'customizer-css' );
}

add_action( 'customize_controls_print_styles', 'enqueue_customizer_stylesheet' );

?>