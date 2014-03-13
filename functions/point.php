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
  add_action( 'add_meta_boxes', 'p2g_meta_box' );
  add_action( 'save_post', 'p2g_save_meta_box', 10, 2 );
}

function p2g_meta_box() {
  add_meta_box(
    'coordinates',
    esc_html__('Coordinates', 'example'),
    'p2g_coordinates',
    'point',
    'side',
    'default'
  );
}

function p2g_coordinates( $object, $box ) {
  wp_nonce_field( basename( __FILE__ ), 'p2g_coordinates_nonce' ); ?>
  <p>
    <label for="coordinates_lat"><?php _e( "Latitude", 'example' ); ?></label>
    <br>
    <input class="widefat" type="text" name="coordinates-lat" id="coordinates-lat" value="<?php echo esc_attr( get_post_meta( $object->ID, 'coordinates_lat', true ) ); ?>" size="30" >
    <br>
    <label for="coordinates_lon"><?php _e( "Longitude", 'example' ); ?></label>
    <br>
    <input class="widefat" type="text" name="coordinates-lon" id="coordinates-lon" value="<?php echo esc_attr( get_post_meta( $object->ID, 'coordinates_lon', true ) ); ?>" size="30" >
  </p>
<?php }

function p2g_save_meta_box( $post_id, $post ) {
  if ( !isset( $_POST['p2g_coordinates_nonce'] ) || !wp_verify_nonce( $_POST['p2g_coordinates_nonce'], basename( __FILE__ ) ) )
    return $post_id;
  $post_type = get_post_type_object( $post->post_type );
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;
  $new_lat_value = ( isset( $_POST['coordinates-lat'] ) ? $_POST['coordinates-lat'] : '' );
  $lat_key = 'coordinates-lat';
  $meta_value = get_post_meta( $post_id, $lat_key, true );
  if ( $new_lat_value && '' == $meta_value )
    add_post_meta( $post_id, $lat_key, $new_lat_value, true );
  elseif ( $new_lat_value && $new_lat_value != $meta_value )
    update_post_meta( $post_id, $lat_key, $new_lat_value );
  elseif ( '' == $new_lat_value && $meta_value )
    delete_post_meta( $post_id, $lat_key, $meta_value );

  $new_lon_key = ( isset( $_POST['coordinates-lon'] ) ? $_POST['coordinates-lon'] : '' );
  $lon_key = 'coordinates-lon';
  $meta_value = get_post_meta( $post_id, $lon_key, true );
  if ( $new_lon_key && '' == $meta_value )
    add_post_meta( $post_id, $lon_key, $new_lon_key, true );
  elseif ( $new_lon_key && $new_lon_key != $meta_value )
    update_post_meta( $post_id, $lon_key, $new_lon_key );
  elseif ( '' == $new_lon_key && $meta_value )
    delete_post_meta( $post_id, $lon_key, $meta_value );

}









