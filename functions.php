<?php
/**
 * Functions and definitions
 *
 */

/*
 * Let WordPress manage the document title.
 */
add_theme_support( 'title-tag' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 */
add_theme_support( 'post-thumbnails' );

/*
 * Enable support for SVG files.
 */
function svg_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'svg_mime_types');


/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
) );

/** 
 * Include primary navigation menu
 */
function rootful_nav_init() {
	register_nav_menus( array(
		'menu-1' => 'Primary Menu',
	) );
}
add_action( 'init', 'rootful_nav_init' );

/**
 * Register widget area.
 *
 */
function rootful_widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Add widgets',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rootful_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rootful_scripts() {
	wp_enqueue_style( 'rootful-style', get_stylesheet_uri() );
	wp_enqueue_style( 'rootful-normalize-styles', get_template_directory_uri() . '/assets/css/normalize.css' );
	wp_enqueue_style( 'rootful-custom-style', get_template_directory_uri() . '/assets/css/style.css' );
	wp_enqueue_script( 'rootful-scripts', get_template_directory_uri() . '/assets/js/scripts.js' );
	
	/* Bootstrap */
	wp_enqueue_style( 'rootful-bootstrap-style', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_script( 'rootful-bootstrap-script', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js' );
}
add_action( 'wp_enqueue_scripts', 'rootful_scripts' );

function rootful_create_post_custom_post() {
	register_post_type('custom_post', 
		array(
		'labels' => array(
			'name' => __('Custom Post', 'rootful'),
		),
		'public'       => true,
		'hierarchical' => true,
		'supports'     => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'thumbnail',
		), 
		'taxonomies'   => array(
				'post_tag',
				'category',
		) 
	));
}
add_action('init', 'rootful_create_post_custom_post'); // Add our work type


/** 
 * Include Theme Files
 *
 */

require_once get_template_directory() . '/inc/customizer/customizer.php'; // Add customizer 


/**
 * Include TGM Plugin Activation
 *
 */

require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';


add_action( 'tgmpa_register', 'rootful_register_required_plugins' );

function rootful_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Page Builder by SiteOrigin',
			'slug'      => 'siteorigin-panels',
			'required'  => true,
		),
		
		array(
			'name'      => 'SiteOrigin Widgets Bundle',
			'slug'      => 'so-widgets-bundle',
			'required'  => true,
		),
		
		array(
			'name'               => 'Custom Facebook Feed Pro', // The plugin name.
			'slug'               => 'custom-facebook-feed-pro', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/inc/plugins/custom-facebook-feed-pro.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'rootful',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'rootful' ),
			'menu_title'                      => __( 'Install Plugins', 'rootful' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'rootful' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'rootful' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'rootful' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'rootful'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'rootful'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'rootful'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'rootful'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'rootful'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'rootful'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'rootful'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'rootful'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'rootful'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'rootful' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'rootful' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'rootful' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'rootful' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'rootful' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'rootful' ),
			'dismiss'                         => __( 'Dismiss this notice', 'rootful' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'rootful' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'rootful' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}

add_action( 'admin_menu', 'font_processing' );

function font_processing() {
	add_options_page( 'Schriften werden hochgeladen', 'Schriften', 'manage_options', 'font-processing', 'font_options' );
}

/** Step 3. */
function font_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} 
	echo '<div class="wrap">';
	echo '<h2>Schriften werden hochgeladen..</h2>';
	
	$fontname = $_POST['fontName'];
$fontweight = $_POST['fontWeight'];
$correct_fontName = str_replace(' ', '-', $fontname);
	
if ( !file_exists( get_template_directory() . '/assets/fonts/'.$correct_fontName.'-'.$fontweight ) ) {
	/* Create new directory according to the fontname */
	mkdir( get_template_directory() . '/assets/fonts/'.$correct_fontName.'-'.$fontweight, 0700 );
}

$target_dir = get_template_directory() . '/assets/fonts/'.$correct_fontName.'-'.$fontweight.'/';

foreach ( $_FILES as $FILE ) {
		
	$target_file = $target_dir . basename($FILE['name']);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Check if file exists
	if ( file_exists( $target_file ) ) {
		echo "<p>Diese Schrift ist bereits hochgeladen.</p>";
		$uploadOk = 0;
	}
	// Check if file is too large
	if ( $FILE['size'] > 5000000 ) {
		echo "<p>Die gewünschte Datei ist zu groß.</p>";
		$uploadOk = 0;
	}
	// Check if filetype is according to the font format
	if ( $fileType != "eot" && $fileType != "ttf" && $fileType != "woff" && $fileType != "svg" && $fileType != "woff2" ) {
		echo "<p>Der Dateityp ist ungültig</p>";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 
	if ( $uploadOk == 0 ) {
		echo "<p>Tut uns Leid, aber die Datei kann leider nicht hochgeladen werden.</p>";
	} else {
		if ( move_uploaded_file($FILE["tmp_name"], $target_file ) ) {
			echo "<p>Die Datei ".basename( $FILE["name"]). " wurde erfolgreich hochgeladen.</p>";
		} else {
			echo "<p>Diese Datei kann leider nicht hochgeladen werden.</p>";
		}
	}
}
	
	echo '<p class="submit"><a id="submit" class="button button-primary" href="/wp-admin/themes.php?page=theme-optionen">Zurück zur Übersicht</a></p>';
	
	echo '</div>';
}






add_action( 'admin_menu', 'post_type_processing' );

function post_type_processing() {
	add_options_page( 'Posttypen', 'Posttypen', 'manage_options', 'post-type-processing', 'post_type_options' );
}

/** Step 3. */
function post_type_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} 
	echo '<div class="wrap">';
	echo '<h2>Post Typ wird generiert..</h2>';
	
	
	
	echo '<p class="submit"><a id="submit" class="button button-primary" href="/wp-admin/themes.php?page=theme-optionen">Zurück zur Übersicht</a></p>';
	
	echo '</div>';
}

add_action( 'admin_menu', 'rootful_remove_admin_submenus', 999 );
function rootful_remove_admin_submenus() {
	remove_submenu_page( 'options-general.php', 'font-processing' );
	remove_submenu_page( 'options-general.php', 'post-type-processing' );
}


/* Include Advanced Custom Fields */

// 1. customize ACF path
add_filter( 'acf/settings/path', 'my_acf_settings_path' );

function my_acf_settings_path( $path ) {
	$path = get_template_directory_uri() . '/inc/plugins/advanced-custom-fields-pro/';
	
	return $path;
	
}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_template_directory_uri() . '/inc/plugins/advanced-custom-fields-pro/';
    
    // return
    return $dir;
    
}
 

// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF
include_once( get_template_directory() . '/inc/plugins/advanced-custom-fields-pro/acf.php' );