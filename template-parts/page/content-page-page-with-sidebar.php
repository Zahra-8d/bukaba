<?php
/**
 * Template part for displaying page content in the page with sidebar
 *
 */

?>

<section id="<?php the_title(); ?>">
	<div class="container">
		<header class="row entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div class="row entry-content entry-content-with-sidebar">
			<?php
				the_content();

			?>
		</div><!-- .entry-content -->
		<div class="sidebar-<?php the_id(); ?>">
		<?php get_sidebar(); ?>
		</div>
	</div>
</section><!-- #post-## -->

