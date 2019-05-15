
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	
  <?php
  	if( get_theme_mod( 'header_radio_setting' ) != '' ) {
		 if ( ( get_theme_mod( 'header_radio_setting' ) == 'logo_only' ) ||  ( get_theme_mod( 'header_radio_setting' ) == 'both' ) ) {
		 	?>
		 	<div id="header-left-section">
				<div id="header-logo">
					 <?php the_custom_logo();?>
				</div>
			</div>
		<?php
		 }

		 if ( ( get_theme_mod( 'header_radio_setting' ) == 'text_only' ) ||  ( get_theme_mod( 'header_radio_setting' ) == 'both' ) ) {
		 ?>
		 	<div id="header-text">
				<h1 id="blog-title"><?php bloginfo( 'name' ); ?></h1>
			 	<h4 id="site-description"> <?php bloginfo( 'description' );?></h4>
			</div>

   		<?php }
   		 if ( ( get_theme_mod( 'header_radio_setting' ) == 'none' ) ) {
   		 	return '';
   		 }
    }
	?>
		
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	/**
	 * This hook is important for wordpress plugins and other many things
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?> >

	<?php
	 if( get_theme_mod( 'header_checkbox_setting' ) == 1 ) {
	 	the_custom_header_markup();
	 }		
	?>

	<div class="stickymenu">
			<ul>
				<li> <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) );?></li> 
			</ul>
		</div>
				
	<div class="owl-carousel owl-theme">
   	 <?php 
		$slider = get_theme_mod( 'slider_no_setting', 3 );
		for ( $i=1; $i <= $slider; $i++ ) { 
		?>
    	<div class="item">
		       
			<img src="<?php echo get_theme_mod( 'slider_image_setting' .$i )?>"/>
				
		</div>
		<?php } ?>
	</div>
		
	<!-- </div> -->
	<div class="container">
		
		