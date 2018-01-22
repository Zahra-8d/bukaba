<?php

/*
*Template Name: Page With Sidebar
*This is a template for the main content of a page with a widgetised sidebar
*/

  get_header(); ?>

 <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/page/content-page', 'page-with-sidebar' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
</div><!-- .content-area -->

<?php  get_footer(); ?>