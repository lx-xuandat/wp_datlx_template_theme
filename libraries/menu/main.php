<?php

// Register Navigation Menus
function datlx_avaocuoi_register_menu() {

	$locations = array(
		'primary' => __( 'Menu Header', 'datlx' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'datlx_avaocuoi_register_menu' );

if (!function_exists('datlx_avaocuoi_menu_main')) {
    function datlx_avaocuoi_menu_main () {
        $args = [
            'theme_location' => 'primary',
            'container' => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'navbarCollapse',
            'menu_class' => 'navbar-nav ms-auto py-0',
            'fallback_cb' => 'false',

        ];

        wp_nav_menu( $args );
    }
}

function add_li_class($classes, $item, $args) {
    $classes[] = 'nav-item nav-link';
    return $classes;
}
// add_filter('nav_menu_css_class', 'add_li_class', 1, 3);

function add_a_class($atts, $item, $args) {
    $atts['class'] = 'nav-item nav-link';
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_a_class', 1, 3);


add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active';
  }
  return $classes;
}