
<?php

/*
This function sets up the theme defaults and registers support for wordpress features that can 
be hooked into the after_setup_theme hook
*/

function bukaba_setup() {

/* register nav menu in two locations */

	register_nav_menus( 
		array(
			'primary' => esc_html__('Primary', 'bukaba'),
			'social-footer' => esc_html__('Social Links Footer', 'bukaba') 
		) 
	);

/* 
This registers the header customisations including image and header text colour 
*/

	$header_info = array (

	'default-image'          => get_parent_theme_file_uri('/assets/images/grey.jpg'),
	'default-text-color'     => '000000',
	'width'                  => 1000,
	'height'                 => 250,
	'flex-height'            => true,
	'flex-width'             => true,
	'wp-head-callback'   => 'bukaba_header_style',
	);

	add_theme_support('custom-header', $header_info);

	// set default header images
	$header_images = array(
		'grey' => array (
			'url' => '%s/assets/images/grey.jpg',
			'description' => __('Grey', 'bukaba'),
			'thumbnail_url' => '%s/assets/images/grey.jpg',
		),
		'blue' => array (
			'url' => '%s/assets/images/blue.jpg',
			'description' => __('Blue', 'bukaba'),
			'thumbnail_url' => '%s/assets/images/blue.jpg',
		),
	);
	register_default_headers($header_images);

/*
This will register theme support for logos and customise the logo
*/
	$defaults = array (
		'height' => 100,
		'width' => 100,
	);
	add_theme_support('custom-logo', $defaults);

/*
This will register theme support for post formats
*/

add_theme_support('post-formats', array('aside', 'quote', 'link', 'image'));

/*
This will register theme support for post thumbnails
*/

add_theme_support('post-thumbnails', array('post', 'image'));

/*
This will register theme support for html5
*/

add_theme_support('html5');

/*
This will register theme support for aautomatic feed links
*/

add_theme_support('automatic-feed-links');

/* 
Registers theme support for WordPress Titles
*/

add_theme_support( 'title-tag' );

/* Set up the WordPress core custom background feature.
*/
add_theme_support( 'custom-background', apply_filters( 'bukaba_custom_background_args', array(
	'default-color' => '#FFFFF0',
	'default-image' => '',
) ) );

/* set the content width */

function bukaba_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bukaba_content_width', 640 );
}

} //end of theme setup function

add_action( 'after_setup_theme', 'bukaba_setup' );



//function to add styling for the header text colour

if (! function_exists('bukaba_header_style')):

function bukaba_header_style() {
	$text_colour = get_header_textcolor();

	if(get_theme_support( 'custom-header', 'default-text-color' ) === $text_colour) {
		return;		
	} 
	else {
		?>
		<style id="-custom-header-styles" type="text/css">
		.site-title a, .site-description {
			color:#<?php echo esc_attr($text_colour); ?>;
		}
		.down .fa {
			color:#<?php echo esc_attr($text_colour); ?>;
		}
		</style>

		<?php 
	}  
} //end function
endif; // End of header styling


/*
This is to create a single page template for the home page. When a new page is created it is added to the single page template for the home page and displayed using the given page template. Here the home page is created, the other pages are called in single-page-home.php
*/

if(get_page_by_title("Home") == null) {
	$post = array(
		"post_title" => "Home",
		"post_status" => "publish",
		"post_type" => "page",
		"menu_order" => "-100",
		"page_template" => "single-page-home.php"
	);

	wp_insert_post($post);

	$home_page = get_page_by_title("Home");
	update_option("page_on_front", $home_page->ID);
	update_option("show_on_front", "page");
}


/*
Function to link the main menu items to the internal parts of the single page home page - the link for the post should not take the user to another page but the page location on the single page homepage.

Preconditions for this function are 
1. Front page is a static front page
2. Home page template is the single-page-home.php page
3 The menu location is 'primary' so no other navs are affected
*/


function bukaba_main_nav_menu_reroute($items, $args) {

	if(get_option('show_on_front') == 'page' && get_page_by_title("Home")->page_template =="single-page-home.php" && $args->theme_location == 'primary') {
		$items="";
		$filters = array ("post_type" => "page", "order" => "ASC", "orderby" => "menu_order");
		$the_query = new WP_Query($filters);
		if($the_query->have_posts()):
			while($the_query->have_posts()):
				$the_query->the_post();
					$items .= '<li class="menu-item"><a href="#' .get_the_title() . '">' . get_the_title() . '</a></li>';
			endwhile;
		endif;
		return $items;
	} else {
		return $items;
	}
}
add_filter("wp_nav_menu_items", "bukaba_main_nav_menu_reroute", 10, 2);



/**
**add custom scripts
**custom.js for all additional javascript
*/

function bukaba_add_custom_scripts() {

	wp_register_script('jquery_script', get_template_directory_uri() .'/assets/js/jquery-3.2.1.min.js');
    wp_enqueue_script('jquery_script');
    wp_register_script('custom_script', home_url() . '/wp-content/themes/bukaba/assets/js/custom.js', array( 'jquery' ));
    wp_enqueue_script('custom_script');
}  
add_action( 'wp_enqueue_scripts', 'bukaba_add_custom_scripts' );

/* Add comment-reply script */
	function bukaba_queue_comments_reply(){
		if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
		  wp_enqueue_script( 'comment-reply' );
		}
	add_action('wp_print_scripts', 'bukaba_queue_comments_reply');

/**
**add custom google font styles and boostrap styles
*/

function bukaba_styles() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css', array(), false ,'screen' );
	wp_enqueue_style('custom-google-fonts','https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i', false);
	wp_enqueue_style( 'custom-styles', get_template_directory_uri() .'/style.css');
}
add_action('wp_enqueue_scripts', 'bukaba_styles' );

/**
**add TinyMCE customisations
*/

function bukaba_custom_editor_styles() {
	add_editor_style('assets/css/custom-editor-style.css');
}
add_action('admin_init', 'bukaba_custom_editor_styles');


/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );


/**
 * Include template file which creates a custom walker class for the social media menu
 */
require get_parent_theme_file_path( '/inc/social-menu.php' );


/**
 * Include sidebar widget
*/
require get_parent_theme_file_path( '/inc/sidebar-widget.php' );


