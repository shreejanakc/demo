<?php
/**
 * This page is for displaying  pages
 */

get_header();
?>

<div class="content">
	<?php
	if( have_posts() ):
		while( have_posts() ): the_post();
		?>

			<h3><?php the_title(); ?></h3>
			<p><?php the_content(); ?></p>
		<?php
		endwhile;
	endif;
		?>

</div>

<?php get_footer(); ?>