<?php get_header(); ?>

<div id="ttr_main" class="row">
	<div id="ttr_content" >
	<?php
	/*
		<h3> Sanitization: </h3>
		<?php echo sanitize_email( "ravi23<   4@yahoo.com" ); ?> <br />
		<?php echo sanitize_title( "this is <demo> demo title" ); ?> <br />
		<?php echo sanitize_text_field( "<hello    there @ !! <1234" ); ?> <br />
		<?php echo sanitize_file_name( "functions >custom.php" ); ?> <br />
		<h3> Escaping: </h3>
		<?php echo esc_attr( "<hello> <b>hello</b> 'helo' &&;;hello </>" ); ?> <br />
		<?php echo esc_html( '<a href="http://www.example.com/">A link</a>' ); ?> <br />
		<?php echo esc_url( "<www.google.  com>" ); ?> <br />
		<?php echo esc_url_raw( "<www.google.com>" ); ?> <br />
		<?php echo esc_textarea( "this is text area //>" ); ?> <br />
		<h3>Validation</h3>
		<?php if ( is_email ( 'ravi1234.com' ) ) {
					echo "This is Valid email"; 
			  }
			  else {
			  		echo "This is Invalid email"; 
			  }
		?>

		<?php 
		$allowed_tag= array(
		    'strong' => array(),
		 );
			  echo wp_kses( '<strong> this is kses </strong>', $allowed_tag ); ?> <br />
		<?php echo wp_filter_nohtml_kses( '<strong> this is kses </strong>' );?>
		<?php echo wp_filter_post_kses( '<strong> hello </strong>' );
	
	*/

	?> 
	
	
	    
		<div class="row">
			<?php
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' =>  3,
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="col-sm-4">
						<h1 class="colored"><?php the_title(); ?></h1>
						<?php do_action( 'custom_hook' ); ?>
						<h4>Posted on <?php the_time('F jS, Y') ?></h4>
						<p><?php the_excerpt(); ?></p>
						<?php
						// $data = the_excerpt();
						echo wp_filter_post_kses( $data );
						?>
					</div>
				<?php endwhile; 
			else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php 
			endif; 
			wp_reset_query();
			?>
		</div>

		<h3>PAGES</h3>
		<?php do_action( 'string_hook' ); ?>

		<div class="row">
			<?php
			$args = array(
				'post_type'      => 'page',
				'posts_per_page' =>  4,
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) :
				 	 while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-sm-4">
							<h1 class="colored"><?php the_title(); ?></h1>
							<h4>Posted on <?php the_time('F jS, Y') ?></h4>
							<p><?php the_excerpt(); ?></p>
							<?php apply_filters( 'custom', 'Hello this is apply filter' );?>
						</div>
					<?php endwhile; 
			else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php 
			endif; 
			wp_reset_query();
			?>
		</div>

		<h3>Categories</h3>
		
		<div class="row">
			<?php
			$args = array(
				'post_type'      => 'post',
				'cat'			 => 'popular',
				'posts_per_page' =>  2,
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) :
				 	 while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-sm-4">
							<h1 class="colored"><?php the_title(); ?></h1>
							<h4>Posted on <?php the_time('F jS, Y') ?></h4>
							<p><?php the_content(); ?></p>
						</div>
					<?php endwhile; 
			else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php 
			endif; 
			wp_reset_query();
			?>
		</div>

		<h3>Tag</h3>
		
		<div class="row">
			<?php
			$args = array(
				'post_type'      => 'post',
				'tag'			 => 'newtag',
				'posts_per_page' =>  2,
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) :
				 	 while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="col-sm-4">
							<h1 class="colored"><?php the_title(); ?></h1>
							<h4>Posted on <?php the_time('F jS, Y') ?></h4>
							<p><?php the_content(); ?></p>
						</div>
					<?php endwhile; 
			else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php 
			endif; 
			wp_reset_query();
			?>
		</div>


		<div class="row">
			<div class="col-sm-4">
				<?php if (is_active_sidebar( 'Sidebar 1' ))
				 {
					dynamic_sidebar('Sidebar 1');

				}
				?>
			</div>
			
		</div> 

	</div>
	
	
	
	</div>
	
	<?php get_footer();?>
</div>

