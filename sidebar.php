<?php
/*
* The side bar of in page main content. This is only available for the page template 'Page With Sidebar'
*
*/

?>



<div id="sidebar-primary" class="sidebar">
    <?php do_action( 'before_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

        <aside id="archives" class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'Archives', 'bukaba' ); ?></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>

   <?php endif; ?>
</div>