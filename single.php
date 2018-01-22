<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				//get the post navigation

				the_post_navigation( array (
					'prev_text' => __('<span class="fa fa-chevron-circle-left">%title</span>', 'bukaba'),
					'next_text' => __('<span class="fa fa-chevron-circle-right">%title</span>', 'bukaba'),
				));

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
