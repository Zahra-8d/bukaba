<?php 

/* Main template file displaying all the posts
*Where single page home page template is not selected and your latest posts are selected in the front page settings
*/

get_header();

?>

<div class="container">

	<!-- header of the page -->
	
	<h1 class="page-title"><?php _e('Latest Posts', 'bukaba'); ?></h1>

	<!-- page content -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			if (have_posts()) : while (have_posts()) : the_post();
				get_template_part('template-parts/post/content', get_post_format() );
				endwhile;

				the_posts_pagination( array (
					'prev_text' => '<span class="fa fa-chevron-circle-left">' . __('Previous Posts', 'bukaba') . '</span>',
					'next_text' => '<span class="fa fa-chevron-circle-right">' . __('Next Posts', 'bukaba') . '</span>',
				));

			else :
				echo '<h2>' . _e('There are no posts to display', 'bukaba') . '</h2>';

			endif;
			?>
		</main>
	</div>
</div>	


<?php get_footer(); ?>
