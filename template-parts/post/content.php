<?php

/* Template part to display a post
* Used when no post type has been assigned to the post
*/

?>

<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- header -->
	<header class="entry-header">
		<?php if (is_single()) {
			the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
		} else {
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		}
		?>
	</header><!-- end header -->

	<!--entry thumbnail -->
	<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink('') ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive'); ?>			
		</a>
	<?php
	}
	?>

	<!-- the post content -->
	<div class="entry-content">

		<?php the_content(); ?>
	   
	</div><!-- end content -->
	<!-- entry tags -->
	<div class="entry-footer">
		<?php $tags_list = get_the_tag_list( '', esc_html__( ', ', 'bukaba' ) );
		if ( $tags_list ) {
			/* translators: list of post tags */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'bukaba' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		} ?>
	</div>
	<!-- meta data for the post-->
     <?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<div class="meta-date">
			<?php the_date(get_option('date-format')); ?></div> <?php
			     wp_link_pages( array(
	                'before' => '<div class="page-links">' . esc_html__( 'Pages: ', 'bukaba' ),
	                'after'  => '</div>',
	                'link_before' => '<span class="page-no">',
	                'link_after' => '</span>'
	            ) );

			?>
		</div><!-- end meta -->
		<?php
		endif; ?>



</article>


