<?php 
get_header();
?>
<script>
var group = [];
var lats = [];
var lons = [];
</script>
<section id="map"></section>
<section id="content">
	<div class="content-container">
		<nav class="navbar navbar-default" role="navigation">
        	<!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	          	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
	          	</button>
	          	<a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="http://placehold.it/100x30"></a>
	        </div>

	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	        <?php
			    wp_nav_menu( array(
			        'menu'              => 'main',
			        'theme_location'    => 'primary',
			        'depth'             => 2,
			        'menu_class'        => 'nav navbar-nav',
			        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			        'walker'            => new wp_bootstrap_navwalker())
			    );
			?>
        	</div><!-- /.navbar-collapse -->
      	</nav>
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
		<!-- <div id="close-content"></div> -->
	</div>
</section>
<section id="add"></section>

<div class="clearfix"></div>

<?php get_footer();