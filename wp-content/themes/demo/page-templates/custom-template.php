<?php
/**
 * Template Name: Custom Template
 * Template Post Type: Post, Page
 * Template for page
 */

get_header();

if( have_posts() ):
	while( have_posts() ): the_post();
?>
		<h2><?php echo the_title(); ?></h2>
		<p><?php echo the_content(); ?></p>
	<?php
	endwhile;
endif;
	?>

<div class="form">
	<h3>Contact Form</h3>
	<form>

		<label for="fname">First Name</label>
	    <input type="text" id="fname" name="firstname" placeholder="Your name..">

	    <label for="lname">Last Name</label>
	    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

	    <label for="subject">Subject</label>
	    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">

	</form>
</div>

