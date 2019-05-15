<?php 
/**
 * The template for displaying all single posts and attachments
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		//start the loop
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to use this in a child 
			 * theme, then include a file called content-___.php(where __ is the post format) 
			 * and that will be used instead.
			 */
			// get_template_part( 'content', get_post_format() );
			?>

			<h1> <?php the_title(); ?></h1>
			<p> <?php the_content(); ?></p>

			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// //previous/next post navigation.
			// the_post_navigation( array(
			// 	'next_text'	=>	'<span class="meta-nav" aria-hidden="true">' .__( 'Next', 'demo' ) . '</span>'
			// ) );
		endwhile;
		?>
		</main>
	</div>

<?php get_footer(); ?>