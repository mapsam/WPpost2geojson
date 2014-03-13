<?php 
get_header();
?>
<script>
var group = [];
var lats = [];
var lons = [];
</script>
<section id="map"></section>
<section class="content">
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
			$lat = get_post_meta($post->ID, "coordinates_lat", true );
			$lon = get_post_meta($post->ID, "coordinates_lon", true ); ?>
			<script>
				var name = <?php echo json_encode($name); ?>;
				var lat = <?php echo json_encode($lat); ?>;
				var lon = <?php echo json_encode($lon); ?>;
				group.push(name);
				lats.push(parseFloat(lat));
				lons.push(parseFloat(lon));
			</script>
			<div class="group" id="<?php echo $name ?>">				
				<p><?php the_title(); ?></p>
				<p><strong>Latitude:</strong> <?php echo $lat; ?>, <strong>Longitude:</strong> <?php echo $lon; ?></p>
			</div>
		<?php endwhile;
		wp_reset_postdata(); ?>
	<?php endif; ?>
</section>
<section id="add"></section>

<div class="clearfix"></div>

<?php get_footer();