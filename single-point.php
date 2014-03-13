<?php 
get_header();
?>
<?php while ( have_posts() ) : the_post();
	$current_id = get_the_id();
	global $current_id;
	$location = get_field( "location_name" );
	$address = get_field( "address" );
	$hours = get_field( "hours" );
	$phone = get_field( "phone_number" );
	$lat = get_field( "latitude" );
	$lon = get_field( "longitude" );
	$dir = get_field( "google_directions_link" ); ?>
	<script>
	var locationName = <?php echo json_encode($location); ?>;
	var latitude = <?php echo json_encode($lat); ?>;
	var longitude = <?php echo json_encode($lon); ?>;
	var address = <?php echo json_encode($address); ?>;
	var hours = <?php echo json_encode($hours); ?>;
	</script>
	<?php endwhile; // end of the loop.
	wp_reset_postdata(); ?>
		

<?php 
get_footer();