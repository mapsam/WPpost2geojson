<?php 
get_header();
?>
<script>
var group = [];
var lats = [];
var lons = [];
</script>
hehoooooo
<section class="container">
	<?php
	$args = array( 
		'post_type'			=> 'point',
		'order'			=> 'DESC',
		'posts_per_page'	=> 999
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
			$name = the_title('', '', false);
			$lat = get_field( "latitude" );
			$lon = get_field( "longitude" ); ?>
			<script>
			var name = <?php echo json_encode($name); ?>;
			var lat = <?php echo json_encode($lat); ?>;
			var lon = <?php echo json_encode($lon); ?>;
			group.push(name);
			lats.push(parseFloat(lat));
			lons.push(parseFloat(lon));
			</script>
			<p><?php the_title(); ?></p>
			<p><strong>Latitude:</strong> <?php echo $lat; ?>, <strong>Longitude:</strong> <?php echo $lon; ?></p>
		<?php endwhile;
		wp_reset_postdata(); ?>
	<?php endif; ?>
</section>

<section id="map"></section>

<script>
var length = group.length;
for(mug=0; mug<length; mug++) {
	console.log(group[mug], lats[mug], lons[mug]);
}
var geoJson = {};
geoJson['type'] = 'FeatureCollection';
geoJson['features'] = [];
groups = [];

len = group.length;
for (i=0; i<len; i++) {
	var newFeature = {
		"type": "Feature",
		"geometry": {
			"type": "Point",
			"coordinates": [lons[i], lats[i]]
		},
		"properties": {
			"group_name": group[i]
		}
	}
	geoJson['features'].push(newFeature);	
}
console.log(geoJson);
</script>

<?php get_footer();