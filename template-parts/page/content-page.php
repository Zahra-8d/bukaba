<?php
/**
 * Template part for displaying page content in page.php
 *
 */

?>

<section id="<?php the_title(); ?>">
	<div class="container">
		<header class="row entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div class=" row entry-content">
			<?php
				the_content();

			?>
		</div><!-- .entry-content -->
	</div>
</section><!-- #post-## -->