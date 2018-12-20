<?php
/**
 * The template for displaying all pages
 *
 */

get_header();
?>

<main id="main" class="site-main" role="main">
	<div class="container"><div class="row">
	
	<?php
	while ( have_posts() ) : the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		
		<?php the_content(); 
	endwhile; 
	?>

</div></div>
</main>

<?php
get_footer();