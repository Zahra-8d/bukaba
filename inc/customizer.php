<?php


/*
*This is a function to add new controls and setting to the customiser.
*main nav bar and footer background control and setting
*main nav bar and footer font colour control and setting
*new footer section, footer text control and settings 
*also adds css to relevant classes for the controls that need css updates 
*/

function bukaba_customize_register( $wp_customize ) {
   //Add control for navbar background colour
	$wp_customize->add_setting( 'nav_footer_background_colour' , array(
    	'default'   => '#617c9b',
    	'sanitize_callback' => 'esc_attr',
	) 
	);
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_footer_background_colour', array(
		'label' => 'Navigation and Footer Background',
		'section' => 'colors',
	)));

	//Add control for navbar font colour
	$wp_customize->add_setting( 'nav_footer_font_colour' , array(
    	'default'   => '#444444',
    	'sanitize_callback' => 'esc_attr',
	) 
	);
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_footer_font_colour', array(
		'label' => 'Navigation and Footer Font',
		'section' => 'colors',
	)));

	//Add section, setting and control for footer heading text 
	$wp_customize->add_section( 'footer_custom' , array(
	    'title'      => 'Footer',
	    'priority'   => 30,
	));
	$wp_customize->add_setting( 'footer_text' , array(
    	'default'   => __('Contact', 'bukaba'),
    	'sanitize_callback' => 'esc_attr',
	));
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'footer_text', array(
		'label' => 'Footer Heading Text',
		'section' => 'footer_custom',
		'type' => 'textarea',
	)));

	//add setting and control for footer email address text
	$wp_customize->add_setting( 'footer_email' , array(
    	'default'   => __('Email Address', 'bukaba'),
    	'sanitize_callback' => 'esc_attr',
	));
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'footer_email', array(
		'label' => 'Footer Email Text',
		'section' => 'footer_custom',
		'type' => 'text',
	)));
}
add_action( 'customize_register', 'bukaba_customize_register' );

function bukaba_customise_css() {
	?>
	<style type="text/css">
		.main-nav { background-color:<?php echo esc_attr(get_theme_mod('nav_footer_background_colour','#617c9b'));?> ; }
		.main-nav a { color:<?php echo esc_attr(get_theme_mod('nav_footer_font_colour','#444444')); ?>; }
		.menu-item {border-bottom:1px solid <?php echo esc_attr(get_theme_mod('nav_footer_font_colour','#617c9b')); ?>;}
		.footer{ background-color:<?php echo esc_attr(get_theme_mod('nav_footer_background_colour','#617c9b'));?> ; }
		.footer h3, .footer a { color:<?php echo esc_attr(get_theme_mod('nav_footer_font_colour','#444444')); ?>; }
	</style>
	<?php
}

add_action('wp_head', 'bukaba_customise_css');

