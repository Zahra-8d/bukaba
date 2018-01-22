<?php

/*
*Registers a widget area in the sidebar
*
*/

// register the primary sidebar widget, more widget areas can be registered by adding to this function

function bukaba_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'bukaba' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
 }
add_action( 'widgets_init', 'bukaba_widgets_init' );