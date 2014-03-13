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

add_action( 'load-post.php', 'p2g_coords_setup' );
add_action( 'load-post-new.php', 'p2g_coords_setup' );

function p2g_coords_setup() {
  add_action( 'add_meta_boxes', 'p2g_lat_meta_box' );
  add_action( 'save_post', 'p2g_lat_save_meta_box', 10, 2 );
  add_action( 'add_meta_boxes', 'p2g_lon_meta_box' );
  add_action( 'save_post', 'p2g_lon_save_meta_box', 10, 2 );
}

function p2g_lat_meta_box() {
  add_meta_box(
    'latitude',
    esc_html__('Latitude', 'example'),
    'p2g_lat',
    'point',
    'side',
    'default'
  );
}

function p2g_lat( $object, $box ) {
  wp_nonce_field( basename( __FILE__ ), 'p2g_lat_nonce' ); ?>
  <p>
    <input class="widefat" type="text" name="coordinates-lat" id="coordinates-lat" value="<?php echo esc_attr( get_post_meta( $object->ID, 'coordinates_lat', true ) ); ?>" size="30" >
  </p>
<?php }

function p2g_lat_save_meta_box( $post_id, $post ) {
  if ( !isset( $_POST['p2g_lat_nonce'] ) || !wp_verify_nonce( $_POST['p2g_lat_nonce'], basename( __FILE__ ) ) )
    return $post_id;
  $post_type = get_post_type_object( $post->post_type );
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;
  $new_meta_value = ( isset( $_POST['coordinates-lat'] ) ? $_POST['coordinates-lat'] : '' );
  $meta_key = 'coordinates_lat';
  $meta_value = get_post_meta( $post_id, $meta_key, true );
  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  elseif ( $new_meta_value && $new_meta_value != $meta_value )
    update_post_meta( $post_id, $meta_key, $new_meta_value );
  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, $meta_key, $meta_value );
}

add_action( 'load-post.php', 'p2g_lon_setup' );
add_action( 'load-post-new.php', 'p2g_lon_setup' );

function p2g_lon_setup() {
  
}

function p2g_lon_meta_box() {
  add_meta_box(
    'lonitude',
    esc_html__('Longitude', 'example'),
    'p2g_lon',
    'point',
    'side',
    'default'
  );
}

function p2g_lon( $object, $box ) {
  wp_nonce_field( basename( __FILE__ ), 'p2g_lon_nonce' ); ?>
  <p>
    <input class="widefat" type="text" name="coordinates-lon" id="coordinates-lon" value="<?php echo esc_attr( get_post_meta( $object->ID, 'coordinates_lon', true ) ); ?>" size="30" >
  </p>
<?php }

function p2g_lon_save_meta_box( $post_id, $post ) {
  if ( !isset( $_POST['p2g_lon_nonce'] ) || !wp_verify_nonce( $_POST['p2g_lon_nonce'], basename( __FILE__ ) ) )
    return $post_id;
  $post_type = get_post_type_object( $post->post_type );
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;
  $new_meta_value = ( isset( $_POST['coordinates-lon'] ) ? $_POST['coordinates-lon'] : '' );
  $meta_key = 'coordinates_lon';
  $meta_value = get_post_meta( $post_id, $meta_key, true );
  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  elseif ( $new_meta_value && $new_meta_value != $meta_value )
    update_post_meta( $post_id, $meta_key, $new_meta_value );
  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, $meta_key, $meta_value );
}









