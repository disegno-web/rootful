<?php
/**
 * The template for displaying all single posts
 *
 */

get_header();
?>

<main id="main" class="site-main" role="main">
	<div class="container"><div class="row">
	
	<?php
	while ( have_posts() ) : the_post();
		the_content(); 
	endwhile; 
	?>

</div></div>
</main>

<?php
get_footer();