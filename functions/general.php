<?php

// add menu support for your theme
add_theme_support( 'menus' );

// create a primary menu that is used in your header.php file
register_nav_menus( array(
    'primary' => __( 'Primary', 'wp-bootstrap-starter' ),
) );

// load bootstrap css and js first, then the site's css from style.css in the root
function wpbootstrap_queue() {
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js' );
	wp_enqueue_style( 'site-css',  get_stylesheet_uri() );
}

// use the WP action to hook these into our page build
add_action( 'wp_enqueue_scripts', 'wpbootstrap_queue' );