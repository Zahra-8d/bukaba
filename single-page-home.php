<?php

/*

Template Name: Single Page Home

This is for the home page where all the pages of post type 'page' are displayed in a single page

*/

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">

		<?php
			$args = array("post_type" => "page", "order" => "ASC", "orderby" => "menu_order");
			$the_query = new WP_Query($args);

			if(have_posts()): while($the_query->have_posts()):$the_query->the_post(); //the loop

				$id = get_the_ID();
				$template = get_post_meta($id, '_wp_page_template', true);

				/* for all pages other than the home page get the page content,this will be content-page.php for all pages by default, if you wish to create custom content for a custom page template create a new content-page.php with the name of the template appended to the name.

				e.g template file name is "two-column.php", name the content page "content-page-two-column.php" and save it in template-parts/page/. 

				*/
				if ($template !=="single-page-home.php") {
					get_template_part("template-parts/page/content-page", substr($template, 0, -4) );
				}

			endwhile; endif; //end the loop
		?>

	</div>
</div>



<?php get_footer(); ?>