<?php 
/*
* Template for displaying the post and page comments and the comment form
*
*/


/*
*If the post is password protected return without loading the comments
*/
if(post_password_required()) {
	return;
}

?>

<div id="comments" class="comments-area">
	<?php

	/* Comments heading */
	if(have_comments()) :
		echo "<h3 class='comments-title'>";
		// translators: Comments on 'comments title'
		printf(esc_html_x("Comments on &ldquo;%s&rdquo;", "comments-title", "bukaba"), get_the_title());
		echo "</h3>";
	?>

	<!-- list of comments -->
	<ol class="comments-list">
		<?php 
			wp_list_comments( array (
				'avatar_size' => 75, 
				'style' => 'ol',
				'short_ping' => true,
			));
		?>
	</ol>

	<?php

		the_comments_pagination( array (
			'prev_text' =>'<span class="fa fa-chevron-circle-left">' . __('Previous', 'bukaba') . '</span>',
			'next_text' => '<span class="fa fa-chevron-circle-right">' . __('Next', 'bukaba') . '</span>',
		));

	endif;

	comment_form();
	?>

</div>