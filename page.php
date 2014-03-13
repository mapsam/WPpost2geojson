<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<section>
    <div class="container">
        <div class="row">
        	<div class="col-lg-8">
        		<h1><?php the_title(); ?></h1>
        		<?php the_content(); ?>
        	</div>
        	<div class="col-lg-4">
        		<?php get_sidebar(); ?>
        	</div>
        </div>
    </div>
</section>
<?php endwhile; ?>

<?php get_footer(); ?>