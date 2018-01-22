<?php 

/**
Build the custom social links walker class extending Walker_Nav_Menu.
The custom class will set the target attribute to _blank so that links open in a new window or a new tab. It will also build the output for the social links nav bar which does not display the title attribute, instead obtains the relevent social media icon and displays. 
**/

class Bukaba_Social_Links_Walker extends Walker_Nav_Menu {
 
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
 
    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
 
        //get hte social media icon relevant to the url input
        $link =  esc_attr( $item->url );
        $social_icons = bukaba_get_socials();
        //loop through supported social icons
        foreach ( $social_icons as $attr => $value ) {
            if ( false !== strpos( $link, $attr ) ) {
                $icon = '<span class="fa fa-' . esc_attr($value) . '"></span>';
                $args->link_after = $icon;
            }
        } 

        // Link attributes. 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        //added target=_blank attribute to the link so that it opens in a new tab or window
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : ' target="_blank" ';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
 
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            //$item-$title set to blank so only the icon is displayed
            apply_filters( 'the_title', "", $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
   } 
}

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
    function bukaba_get_socials() {
    // Supported social links icons.
    $social_links_icons = array(
        'behance.net'     => 'behance',
        'codepen.io'      => 'codepen',
        'deviantart.com'  => 'deviantart',
        'digg.com'        => 'digg',
        'docker.com'      => 'dockerhub',
        'dribbble.com'    => 'dribbble',
        'dropbox.com'     => 'dropbox',
        'facebook.com'    => 'facebook',
        'flickr.com'      => 'flickr',
        'foursquare.com'  => 'foursquare',
        'plus.google.com' => 'google-plus',
        'github.com'      => 'github',
        'instagram.com'   => 'instagram',
        'linkedin.com'    => 'linkedin',
        'mailto:'         => 'envelope-o',
        'medium.com'      => 'medium',
        'pinterest.com'   => 'pinterest-p',
        'pinterest.co.uk'   => 'pinterest-p',
        'pscp.tv'         => 'periscope',
        'getpocket.com'   => 'get-pocket',
        'reddit.com'      => 'reddit-alien',
        'skype.com'       => 'skype',
        'skype:'          => 'skype',
        'slideshare.net'  => 'slideshare',
        'snapchat.com'    => 'snapchat-ghost',
        'soundcloud.com'  => 'soundcloud',
        'spotify.com'     => 'spotify',
        'stumbleupon.com' => 'stumbleupon',
        'tumblr.com'      => 'tumblr',
        'twitch.tv'       => 'twitch',
        'twitter.com'     => 'twitter',
        'vimeo.com'       => 'vimeo',
        'vine.co'         => 'vine',
        'vk.com'          => 'vk',
        'wordpress.org'   => 'wordpress',
        'wordpress.com'   => 'wordpress',
        'yelp.com'        => 'yelp',
        'youtube.com'     => 'youtube',
    );

    /**
     Filter social links to obtain the icon
     */
    return apply_filters( 'bukaba_get_socials', $social_links_icons ); 
}
