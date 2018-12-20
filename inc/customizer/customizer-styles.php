<?php

add_action( 'wp_head', 'customizer_css' );

function customizer_css() {
	?>

<style type="text/css">
	
	/* Schriftklassifizierung */
	
	<?php 
	$schriften = get_theme_mod('google_font_dropdown'); 
	$font_array = explode(",", $schriften);
	
	$font_ueberschriften = get_theme_mod('schrift_ueberschriften');
	$font_fliesstext = get_theme_mod('schrift_fliesstext');
	$font_menu = get_theme_mod('schrift_menu');
	
	
	$search_numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "-" );
	$replace = array("", "", "", "", "", "", "", "", "", "", " " );
	
	$headingFontName = str_replace($search_numbers, $replace, $font_ueberschriften);
	$textFontName = str_replace($search_numbers, $replace, $font_fliesstext);
	$menuFontName = str_replace($search_numbers, $replace, $font_menu);
	
	$headingFontName = rtrim ($headingFontName);
	$textFontName = rtrim ($textFontName);
	$menuFontName = rtrim ($menuFontName);
	
	
	foreach ( $font_array as $font ) {
		$correct_font = str_replace("-", " ", $font );
		$font_dir = get_template_directory() . '/assets/fonts/'.$font;
		
		$search_numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );
		$replace = array("", "", "", "", "", "", "", "", "", "" );
		$fontName = str_replace($search_numbers, $replace, $correct_font);
		$fontName = rtrim ($fontName);
		
		$fontWeight = preg_replace('/[^0-9]/', '', $correct_font );
		
		$fontURLs = array();
		$fileTypes = array();
		
		if ( $handle = opendir($font_dir)) {
			while ( false !== ( $entry = readdir($handle))) {
				if ( $entry != "." && $entry != ".." ) {
					$fontURL = get_template_directory_uri() . '/assets/fonts/'.$font.'/'.$entry;
					$fileType = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
					
					if ( $fileType == 'eot' ) {
						$fileType = 'embedded-opentype';
					} elseif ( $fileType == 'ttf' ) {
						$fileType = 'truetype';
					}
					
					$fontURLs[] = "url('".$fontURL."') format('".$fileType."')";

				}
			}
			closedir( $handle );

		}
		
		$fontStyles = implode( ",\n", $fontURLs );
				
	?>
	@font-face {
		font-family: '<?php echo $fontName; ?>';
		font-style: normal;
		font-weight: <?php echo $fontWeight; ?>;
		src: <?php echo $fontStyles; ?>;
	}
		
		
		
	<?php } ?>

	/* Container */
	
	<?php $containerbreite = get_theme_mod( 'containerbreite' ); 
		  $wrapperbreite = $containerbreite+30;
	?>
	
	.main-wrapper.boxed {
		max-width: <?php echo $wrapperbreite; ?>px;
	}
	
	.container {
		max-width: <?php echo $containerbreite; ?>px;
	}
	
	.header-top {
		background-color: <?php echo get_theme_mod('top_bar_background'); ?>;
		color: <?php echo get_theme_mod('top_bar_color'); ?>;
		font-size: <?php echo get_theme_mod('top_bar_fontsize');?>px;
	}
	
	<?php if ( get_theme_mod('show_boxshadow_header' ) ) : ?>
		.header-bottom {
			box-shadow: 5px 5px 10px rgba(0,0,0,.2);
		}
	<?php endif; ?>
	
	<?php if ( get_theme_mod('show_border_header' ) ) : ?>
		.header-bottom {
			border-bottom: <?php echo get_theme_mod('header_bottom_border_width'); ?>px solid <?php echo get_theme_mod('header_bottom_border_color'); ?>;
		}
	<?php endif; ?>
	

	h1, h2, h3, h4, h5, h6 {
		font-family: <?php echo $headingFontName; ?>;
	}
	
	a { 
		color: <?php echo get_theme_mod('link_default' ); ?>;
		font-size: <?php echo get_theme_mod('groesse_fliesstext'); ?>px;
	}
	
	a:hover, a:focus { color: <?php echo get_theme_mod('link_hover' ); ?> }
	
	/* Überschriften */
	
	h1 { 
		color: <?php echo get_theme_mod('h1_color'); ?>;
		font-size: <?php echo get_theme_mod('groesse_h1'); ?>px;
	}
		
	h2 { 
		color: <?php echo get_theme_mod('h2_color'); ?>;
		font-size: <?php echo get_theme_mod('groesse_h2'); ?>px;
	}
	
	h3 { 
		color: <?php echo get_theme_mod('h3_color'); ?>;
		font-size: <?php echo get_theme_mod('groesse_h3'); ?>px;
	}
	
	h4 { 
		color: <?php echo get_theme_mod('h4_color'); ?>;
		font-size: <?php echo get_theme_mod('groesse_h4'); ?>px;
	}
	
	h5 { 
		color: <?php echo get_theme_mod('h5_color'); ?>;
		font-size: <?php echo get_theme_mod('groesse_h5'); ?>px;
	}
	
	h6 { 
		color: <?php echo get_theme_mod('h6_color'); ?>;
		font-size: <?php echo get_theme_mod('groesse_h6'); ?>px;
	}

	
	p, li, span { 
		color: <?php echo get_theme_mod('text_color'); ?>;
		font-family: <?php echo $textFontName; ?>;
		font-size: <?php echo get_theme_mod('groesse_fliesstext'); ?>px;
		text-transform: <?php echo get_theme_mod('text_transform_fliesstext'); ?>;
		line-height: 1.6;
	}
	
	.widget-title {color: <?php echo get_theme_mod('h3_color'); ?> }
	
	

	/* Navigation */
	
	nav ul li a { 
		font-family: <?php echo $menuFontName; ?>; 
		font-size: <?php echo get_theme_mod('groesse_menu'); ?>px;
		color: <?php echo get_theme_mod('menu_color'); ?>;
	}
	
	nav ul li a:focus, nav ul li a:hover { color: <?php echo get_theme_mod('menu_color_hover'); ?>;}
	
	.current_page_item a { color: <?php echo get_theme_mod('menu_color_active'); ?>; }
	
	.slide h3 { font-family: <?php echo get_theme_mod('slideheading_font'); ?> }
	
	.slide h5, .slider-button { font-family: <?php echo get_theme_mod('slidecontent_font'); ?> }
	
	
</style>

<?php
}