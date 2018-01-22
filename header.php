
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script src="https://use.fontawesome.com/a8ce4975ee.js"></script>

	<?php wp_head(); ?>

</head>


<body <?php body_class( 'class-name' ); ?>>


<!-- Site branding-->
	<div id="Home">
		<?php

			// check if the primary navigation menu has been set 
			if (has_nav_menu('primary')) {
		?>
		 <!-- icon for navigation display -->
		<div class="slicknav">
			<a href="#" aria-haspopup="true" tabindex="0" class="menu-button">
				<span class="menu-icon">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</span>	
			</a>
		</div>
		<nav>
		<?php

		/* get the navigation menu for the headers */

				wp_nav_menu( 
					array( 
						'theme_location' => 'primary', 
						'menu_class' => 'main-nav', 
						'before' => '<div class="nav-item">', 
						'after' => '</div>' 
						) 
				);
			?>
		</nav>
	

		<?php } ?>

	<main class="content">
<!-- header styling -->
	<div class="header" style="background-image:url(<?php esc_url(header_image()); ?>)">
  		<div class="heading">
			<h1 class="site-title"><a href="<?php echo esc_url(site_url()); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
			<p class="site-description"><?php echo get_bloginfo('description'); ?></p>
		</div>
	</div>

	<div class="down">
	<a href="#" aria-haspopup="true" tabindex="0" class="menu-button">
		<span class="fa fa-chevron-circle-down" aria-hidden="true"></span>	
	</a>
	</div>
