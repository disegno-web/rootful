<?php
/**
 * The header for the theme
 *
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<?php $layout = get_theme_mod( 'layout' ); ?>
	
<div class="main-wrapper <?php echo $layout; ?>">
	
	<header class="site-header">

	<?php if ( get_theme_mod( 'show_top_bar_toggle' ) == 1 ) : ?>
		<div class="header-top">
			<div class="container"><div class="row">
				<div class="col-sm-6">
					<?php echo get_theme_mod('top_bar_left_content'); ?>
				</div>
				<div class="col-sm-6 right-align">
					<?php echo get_theme_mod('top_bar_right_content'); ?>
				</div></div>
			</div>
		</div>
	<?php endif; ?>
		
	<div class="header-bottom">
		<div class="container"><div class="row">
			<div class="col-sm-12">
				 <nav class="navbar navbar-expand-sm">
				  <!-- Brand -->
				  <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
					  <img src="<?php echo get_theme_mod('logo'); ?>" class="logo-img" alt="Logo <?php echo bloginfo('title'); ?>" />
				  </a>

				  <!-- Toggler/collapsibe Button -->
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				  </button>

				  <!-- Navbar links -->
				  <div class="collapse navbar-collapse" id="collapsibleNavbar">
					<?php
					wp_nav_menu( array(
						'theme_location'	=>	'menu-1',
						'menu_id'			=>	'primary-menu',
					));
					?>
				  </div>
				</nav> 
			</div></div>
		
		</div>	
		
	</div>

	</header>

	<div id="content" class="site-content">
