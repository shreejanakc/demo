<?php
/**
 * Customizer for customizing theme options
 */

function customize_options( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
 	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';


	$wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector'            => '#blog-title',
        'render_callback'     => 'site_title_live_refresh',
    ) );

 	//header-color

	$wp_customize->add_setting( 'header_color', array(
    'default'     => '#000000',
    'transport'   => 'postMessage',

    ) );
	$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'header_color',
			array(
			    'label'      => __( 'Header Color' ),
			    'section'    => 'colors',
			    'settings'   => 'header_color'
			)
				
	));

	//header-text
	$wp_customize->add_panel( 'header_panel', array(
				'title'		 => esc_html__( 'Header Panel', 'demo' ),
				'capability' => 'edit_theme_options',
	));

	$wp_customize->add_section( 'header_section', array(
				'title' =>	esc_html__( 'Header Section', 'demo' ),
				'panel'	=>	'header_panel',
	));

	$wp_customize->add_setting( 'header_setting', array(
				'capability' => 'edit_theme_options',
				'default'	 => '',
				'transport'	 => 'postMessage',

	));
	$wp_customize->add_control( 'header_setting', array(
				'type'	   => 'text',
				'section'  => 'header_section',
				'settings' => 'header_setting',
				'label'	   =>  esc_html__( 'Header Text' ),
				
	));
	$wp_customize->selective_refresh->add_partial( 'header_setting', array(
        'selector'            => '.header-refresh-wrap',
        'settings' 			  => 'header_setting',
        'container_inclusive' => true,
        'render_callback'     => 'header_selective_refresh',
    ) );

    //header-checkbox

    $wp_customize->add_setting( 'header_checkbox_setting', array(
				'capability' 		=> 'edit_theme_options',
				'default'	 		=> '',
				'sanitize_callback' => 'header_checkbox_sanitize_callback'
	));
	$wp_customize->add_control( 'header_checkbox_setting', array(
				'type'	   => 'checkbox',
				'section'  => 'header_section',
				'settings' => 'header_checkbox_setting',
				'label'	   =>  esc_html__( 'Check this to display header image' ),
	));

	//header radiobutton
	 
	$wp_customize->add_setting( 'header_radio_setting', array(
		'default'           => 'text_only',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'header_radio_sanitize_callback',
	) );

	$wp_customize->add_control( 'header_radio_setting', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the option that you want.', 'demo' ),
		'section' => 'title_tagline',
		'choices' => array(
			'logo_only' => __( 'Header Logo Only', 'demo' ),
			'text_only' => __( 'Header Text Only', 'demo' ),
			'both'      => __( 'Show Both', 'demo' ),
			'none'      => __( 'Disable', 'demo' ),
		),
	) );
   

	//sticky menu

	$wp_customize->add_section( 'menus', array(
				'title' =>	esc_html__( 'Sticky Menu', 'demo' ),
				'panel'	=>	'nav_menus',
	));
	
	 $wp_customize->add_setting( 'sticky_menu_setting', array(
				'capability' 		=> 'edit_theme_options',
				'default'	 		=> '',
				'sanitize_callback' => 'header_checkbox_sanitize_callback'
	));
	$wp_customize->add_control( 'sticky_menu_setting', array(
				'type'	   => 'checkbox',
				'section'  => 'menus',
				'settings' => 'sticky_menu_setting',
				'label'	   =>  esc_html__( 'Check this to enable sticky menu' ),
				
	));

//test

	$wp_customize->add_section( 'test_section', array(
				'panel' => 'header_panel',
				'title' => esc_html__( 'Test', 'demo' ),
				
	));

	$wp_customize->add_setting( 'test_setting', array(
				'default' => '',
       			'capability' => 'edit_theme_options',
      			
	));
	$wp_customize->add_control( 'test_setting', array(
				'type'	   => 'text',
				'section'  => 'test_section',
				'settings' => 'test_setting',
				'label'	   =>  esc_html__( 'Test Text' ),			
	));


	$wp_customize->add_panel( 'slider_panel', array(
				'title' 	 => esc_html__( 'Slider', 'demo' ),
				'capability' => 'edit_theme_options',

	));

/*Slider*/
	$wp_customize->add_section( 'slider_section', array(
				'panel' => 'slider_panel',
				'title' => esc_html__( 'Slider', 'demo' ),
				
	));

	$wp_customize->add_setting( 'slider_setting', array(
				'default' => '',
       			'capability' => 'edit_theme_options',
      			
	));
	$wp_customize->add_control( 'slider_setting', array(
				'type'	   => 'checkbox',
				'section'  => 'slider_section',
				'settings' => 'slider_setting',
				'label'	   =>  esc_html__( 'Check this to enable the slider' ),			
	));

/*No.of slider*/
	$wp_customize->add_setting( 'slider_no_setting', array(
				'capability' => 'edit_theme_options',
				'default'	 => 3,
	));

	$wp_customize->add_control( 'slider_no_setting', array(
				'section'  => 'slider_section',
				'settings' => 'slider_no_setting',
				'label'	   => esc_html__( 'Total Number of slider' ),
	));

/* Upload Image*/
	$slider = get_theme_mod( 'slider_no_setting', 3 );
	for ( $i=1; $i <= $slider; $i++ ) {
		$wp_customize->add_setting( 'slider_image_setting'.$i, array(
				'capability' => 'edit_theme_options',
				'default'	 => '',
		));

		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize, 'slider_image_setting'.$i, array(
				'label'   => esc_html__( 'Upload Image', 'demo' ),
				'section' => 'slider_section',
				'settings'=> 'slider_image_setting'.$i,
				'label'	  => sprintf(__( 'slider image %1$s', 'demo'), $i ),
		)));
	}



	
}

add_action( 'customize_register', 'customize_options' );


?>