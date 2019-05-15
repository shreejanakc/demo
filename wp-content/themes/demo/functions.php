<?php 
// @ini_set( 'upload_max_size' , '64M' );
function demo_setup() {

	include( get_template_directory() . '/inc/customizer.php' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background' , array(
		'default-image'			 => '',
		'default-size'			 => '',
		'default-image'          => '',
	    'default-preset'         => 'default', 
	    'default-position-x'     => 'left',    
	    'default-position-y'     => 'top',     
	    'default-size'           => 'auto',    
	    'default-repeat'         => 'repeat',  
	    'default-attachment'     => 'scroll', 
	    'default-color'          => '', 
	) );
	add_theme_support( 'custom-header' , array(
		'default-image'          => '',
	    'random-default'         => false,
	    'width'                  => 1500,
	    'height'                 => 150,
	    'flex-height'            => false,
	    'flex-width'             => false,
	    'default-text-color'     => '',
	    'header-text'            => true,
	    'uploads'                => true,
	    'video'					 => true,
	    'audio'					 => true,

	));

	add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 100,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
	) );

	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'audio', 'video' ));

	load_theme_textdomain( 'demo', get_template_directory_uri() . '/languages' );

	
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'demo_setup' );

function demo_scripts() {
	// style
	wp_enqueue_style( 'demo-style', get_stylesheet_uri() );
	wp_enqueue_style( 'demo-custom', get_template_directory_uri() .'/css/custom.css', array() );
	wp_enqueue_style( 'demo-owl-carousel', get_template_directory_uri() .'/owl/css/owl.carousel.css', array() );
	wp_enqueue_style( 'demo-owl-carousel-min', get_template_directory_uri() .'/owl/css/owl.carousel.min.css', array() );
	wp_enqueue_style( 'demo-owl-theme-default', get_template_directory_uri() .'/owl/css/owl.theme.default.css', array() );
	wp_enqueue_style( 'demo-owl-theme-default-min', get_template_directory_uri() .'/owl/css/owl.theme.default.min.css', array() );
	wp_enqueue_style( 'demo-owl-theme-green', get_template_directory_uri() .'/owl/css/owl.theme.green.css', array() );
	wp_enqueue_style( 'demo-owl-theme-green-min', get_template_directory_uri() .'/owl/css/owl.theme.green.min.css', array() );
	//js
	wp_enqueue_style( 'demo-bootstrap-min', get_template_directory_uri() .'/css/bootstrap.min.css', array() );
	wp_enqueue_style( 'demo-bootstrap', get_template_directory_uri() .'/css/bootstrap.css', array() );
	wp_enqueue_script( 'demo-owl-carousel-js', get_template_directory_uri() .'/owl/js/owl.carousel.js', array( 'jquery' ) );
	wp_enqueue_script( 'demo-owl-carousel-min-js', get_template_directory_uri() .'/owl/js/owl.carousel.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'demo-custom-js', get_template_directory_uri() .'/js/custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'demo-sticky-js', get_template_directory_uri() .'/js/jquery.sticky.js', array( 'jquery' ) );

	wp_register_script( 'demo-menu-js', get_template_directory_uri() .'/js/menu.js', array( 'jquery' ) );
	if( get_theme_mod( 'sticky_menu_setting' ) == 1 ) {
		wp_enqueue_script( 'demo-menu-js' );
	}

	//localize script
	// wp_register_script( 'demo-local', get_template_directory_uri() .'/js/local.js' );
	// $translation_array = array(
	// 	'some_string' => __( 'This is localized script ', 'demo' ),
	// 	'a_value' => '10'
	// );
	// wp_localize_script( 'demo-local', 'object_name', $translation_array );
	// wp_enqueue_script( 'demo-local' );
	
} 

add_action( 'wp_enqueue_scripts', 'demo_scripts' );

//live refresh

function custom_customize_preview_js() {
	wp_enqueue_script( 'demo-customizer', get_template_directory_uri() . '/js/customizer.js',  array( 'customize-preview' ), '1.0.0.', true );
}
add_action( 'customize_preview_init', 'custom_customize_preview_js' );


/* to make heade video active on pages or homepage */

add_filter( 'is_header_video_active', 'custom_video_header_pages' );

function custom_video_header_pages( $active ) {
  if( is_home() || is_page() ) {
    return true;
  }
  return false;
}

/* navigation menus*/

add_action( 'after_setup_theme', 'register_my_menu' );

function register_my_menu() {
  register_nav_menu( 'header-menu', __( 'Header Menu') );
}

/* sidebar */
function sidebar_regster() {

	$args = array(
		'name'          => sprintf( __( 'Sidebar 1' ) ),
		'id'            => "sidebar-1",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	);	
	register_sidebar( $args );

	
}

add_action( 'widgets_init', 'sidebar_regster' );

/* Widget */

class custom_text_widget extends WP_Widget {
	function __construct() {
		$widget_options= array(
			'classname'					  => 'widget_custom_text',
			'description'				  => __( 'Description - It displays custom text', 'demo' ),
			'customize_selective_refresh' => true,
		);

		$control_options= array(
			'width'	=> 100,
			'height' => 300,
		);

		parent::__construct( false, $name = __( 'My Custom Text Widget', 'demo' ), $widget_options, $control_options );
	}

	function form( $instance ) {
		$default[ 'title' ]		  = '';
		$default[ 'description' ] = '';
		$instance 				  = wp_parse_args( (array) $instance, $default );
		$title 					  = sanitize_text_field( $instance[ 'title' ] );
		$description 			  = wp_filter_post_kses( $instance[ 'description' ] ) ;
		?>
		<p>
	 	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'demo' ); ?></label> 
		<input id="<?php echo $this->get_field_id( 'title' );?>" name="<?php echo $this->get_field_name( 'title' );?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', 'demo' ); ?></label> 
		<textarea class="widefat" rows="4" cols="10" id="<?php echo $this->get_field_id( 'description' ); ?>" 
			name="<?php echo $this->get_field_name( 'description' ); ?>"> <?php echo $description;?>		
		</textarea> 
		</p> 
	<?php 	
	}

	function update( $new_instance,$old_instance ) {
		$instance 				   = $old_instance;
		$instance[ 'title' ] 	   = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'description' ] = ( $new_instance[ 'description' ] );
		return $instance;		
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $args );
		$title 		 =isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$title 		 =apply_filters( 'widget_title', $title );
		$description =isset( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
	?>
		<h3>
			<?php echo esc_html( $title );?>
		</h3>

		<div>
			<?php echo esc_html( $description );?>
		</div>
	<?php
	}
}

function load_custom_widget() {
	register_widget( 'custom_text_widget' );
}
add_action( 'widgets_init', 'load_custom_widget' );


/* call to action widget*/
class custom_call_to_action_widget extends WP_Widget {
	function __construct()
	{
		$widget_ops = array(
			'classname'					  => 'custom_calltoaction_widget',
			'description'     			  =>  __('This is custom call to acion widget','demo'),
			'customize_selective_refresh' =>  true,

		);

		$control_ops = array(
			'width' => 100,
			'height' => 400,

		);
		parent::__construct( false, $name=__( 'Custom Call to Action Widget','demo' ), $widget_ops, $control_ops );
	}

	function form( $instance )	{
		$defaults[ 'text_main' ]		='';
		$defaults[ 'text_additional' ]	='';
		$defaults[ 'button_text' ]		='';
		$defaults[ 'button_url' ]		='';
		$instance 						= wp_parse_args( (array) $instance, $defaults );
		$text_main						= esc_textarea( $instance[ 'text_main' ] );
		$text_additional				= esc_textarea( $instance[ 'text_additional' ] );
		$button_text					= esc_attr( $instance[ 'button_text' ] );
		$button_url						= esc_url( $instance[ 'button_url' ] );
		?>

		<?php _e( ' main Text', 'demo' ); ?>
		<textarea class="widefat" rows="3" cols="10" id="<?php echo $this->get_field_id( 'text_main' ); ?>" name="<?php echo $this->get_field_name( 'text_main' ); ?>" ><?php echo $text_main; ?> </textarea>

		<?php _e( 'Additional Text', 'demo' ); ?>
		<textarea class="widefat" rows="3" cols="10" id="<?php echo $this->get_field_id( 'text_additional' ); ?>" name="<?php echo $this->get_field_name( 'text_additional' ); ?>" ><?php echo $text_additional; ?> 
		</textarea> 

		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:', 'demo'); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' );?>" type="text" value="<?php echo $button_text; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_url' );?>"><?php _e( 'Button Redirect Url:', 'demo'); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_url' );?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>"/>
		</p>		

	<?php
	}

	function update( $new_instance, $old_instance ) {
		$old_instance =	$old_instance;
		$instance[ 'text_main' ] 		= strip_tags( $new_instance[ 'text_main' ] );
		$instance[ 'text_additional' ]  = strip_tags( $new_instance[ 'text_additional' ] );
		$instance[ 'button_text' ]      = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ]       = esc_url( $new_instance[ 'button_url' ] );
		return $instance;
	}

	function widget( $args, $instance )	{
		extract( $args );
		extract( $instance);
		$text_main 		 = !empty( $instance[ 'text_main' ] ) ? $instance[ 'text_main' ] : '';
		$text_additional = !empty( $instance[ 'text_additional' ] ) ? $instance[ 'text_additional' ] : '';
		$button_text 	 = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
		$button_url      = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '';
		?>
		<div class="callaction_widget_content">
			<?php
			if( !empty( 'text_main' )) {
			?>
				<h3><?php echo esc_html( $text_main )?></h3>

			<?php		
			}

			if( !empty( 'text_additional' )) {
			?>
				<h3><?php echo esc_html( $text_additional )?></h3>

			<?php		
			}
			?>
		</div>

		<?php
		if( !empty( 'button_text' )) {
		?>
		  <a href="<?php echo  $button_url; ?>" title="<?php echo $button_text;?>"> <?php echo esc_html( $button_text );?> </a>
		<?php 
		}
		?>

	<?php

	}
}

	function load_add_to_action_widget() {
		register_widget( 'custom_call_to_action_widget' );
	}
	add_action( 'widgets_init', 'load_add_to_action_widget' );


/* Service Widget*/

class demo_service_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname' 				  => 'widget_service',
			'description'				  => __( 'Display pages as services', 'demo'),
			'customize_selective_refresh' => true,
			); 

		$control_ops = array(
			'width'	 => 200,
			'height' => 200
			);
		parent::__construct( false, $name =__( 'Custom Service Widget' ), $widget_ops, $control_ops );
	}			

	function form( $instance ) {
		for ( $i = 0; $i < 5; $i++ ) {
			$var		       = 'page_id'  .$i;
			$defaults[ $var ]  = '';

		}
		$instance = wp_parse_args( ( array ) $instance, $defaults );
		for ( $i = 0; $i < 5; $i++ ) {
			$var = 'page_id'  .$i;
			$var = absint( $instance[ $var ] );
		}

		for ( $i = 0; $i <5; $i++ ) {
		?>
		<p>
			<label for="<?php echo $this->get_field_id( key( $defaults ) );?>"><?php _e( 'Page', 'demo');?>
			<?php wp_dropdown_pages( array( 'show_option_none' => ' ', 'name' => $this->get_field_name( key( $defaults ) ), 'selected' => $instance[ key( $defaults) ] ) );?>
		</p>
		<?php next( $defaults );
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for	( $i = 0; $i < 5; $i++) {
			$var			  = 'page_id' .$i ;
			$instance[ $var ] = absint( $new_instance[ $var] );
			}
		return $instance;
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		global $post;
		$page_array = array();
		for	( $i =0; $i < 5; $i++) {
			$var			  = 'page_id' .$i ;
			$page_id		  = isset( $instance[ $var ] )? $instance[ $var ] : '';

			if ( !empty( $page_id ) ) {
				array_push( $page_array, $page_id );
			}
		}

		$get_pages = new WP_Query( array(
			'posts_per_page' => -1,
			'post_type'		 => array( 'page' ),
			'post__in'		 => $page_array,
			'orderby'		 => 'post__in',
		) );

		
		while( $get_pages->have_posts() ): $get_pages->the_post();
			$page_title	= get_the_title();
			?>
			<div>
				<?php if ( has_post_thumbnail( ) ) {
					$tilte_attribute =get_the_title( $post->ID );
					echo '<div class="service-image">' . get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $tilte_attribute ) ) ) .'</div>' ;


				}
				echo $before_title; ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink();?>"><?php echo $page_title; ?></a>
				<?php echo $after_title; ?>
				<?php the_excerpt();?>
				<div class="more-link-wrap">
					<a class="more-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink();?>"><?php _e( 'Read more', 'demo' ); ?></a>
				</div>
			</div>
			<?php  
		endwhile;
		wp_reset_query();
		echo $after_widget;
	 
	}
}

function load_service_widget() {
	register_widget( 'demo_service_widget' );
}
add_action( 'widgets_init', 'load_service_widget' );
remove_action( 'widgets_init', 'load_service_widget' );

/* filters */
function callback() {
  echo 'first';
}

function callback2() {
	echo 'second';

}

add_action( 'custom_hook', 'callback', 2 );
add_action( 'custom_hook', 'callback2', 1 );


function filter_content_callback() {
	return 3;		
}
add_filter( 'excerpt_length', 'filter_content_callback', 10);

 
function f_callback( $output ) {
 	echo  $output;
 	}
add_filter( 'custom', 'f_callback' );

 remove_filter( 'excerpt_length', 'filter_content_callback' );

function string_callback2( $content ) {
	 $content = str_replace( 'Lorem Ipsum', 'second string',  $content ) ;
	 return $content;
}
add_filter( 'the_content', 'string_callback2', 1 );


function remove_body_classes( $wp_classes ) {
    foreach ( $wp_classes as $key => $value ) {
        if ( $value == 'home' ) 
        	unset( $wp_classes[ $key ] );
    } 
     return $wp_classes; 
 }
add_filter( 'body_class', 'remove_body_classes' );

/*more link*/
function the_excerpt_more_link( $excerpt ){
    $excerpt .= '... <a class="more-link" href="'. get_permalink() . '">Read More</a>.';
    return $excerpt;
}
add_filter( 'the_excerpt', 'the_excerpt_more_link' );

/* Selective refresh*/

function header_selective_refresh() {

	if( ( get_theme_mod( 'header_setting' ) )!='' ) {
		echo get_theme_mod( 'header_setting' );
	echo '<div class="header-refresh-wrap">';
            echo '<h1>' . esc_html( $header ) . '</h1>' ;
    echo '</div';
	}
	
}

function site_title_live_refresh() {
	bloginfo( 'name' );
}


//sanitize callback
function header_checkbox_sanitize_callback( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
}

function header_radio_sanitize_callback( $input, $setting ) {
	//input must be a slug
    $input = sanitize_key($input);

    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default ); 
}







