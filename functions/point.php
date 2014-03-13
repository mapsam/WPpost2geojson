<?php

add_action( 'init', 'create_point_post_type' );
function create_point_post_type() {
  register_post_type( 'point',
    array(
      'labels' => array(
        'name' => __( 'Point' ),
        'singular_name' => __( 'Point' )
      ),
    'public' => true,
    'has_archive' => true,
    'supports' => array( 'title', 'thumbnail', 'editor' )
    )
  );
}