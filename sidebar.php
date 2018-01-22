<?php
/*
* The side bar of in page main content. This is only available for the page template 'Page With Sidebar'
*
*/

?>



<div id="sidebar-primary" class="sidebar">
    <?php do_action( 'before_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        <aside id="search" class="widget widget_search">
           <?php get_search_form(); ?>
        </aside>
        <aside id="archives" class="widget">
            <h3 class="widget-title"><?php _e( 'Archives', 'bukaba' ); ?></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
        <aside id="meta" class="widget">
            <h3 class="widget-title"><?php _e( 'Meta', 'bukaba' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
   <?php endif; ?>
</div>