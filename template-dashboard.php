<?php
/**
 * Template Name: Dashboard
 */

get_header(); ?>

<?php
while ( have_posts() ) :
	the_post();
	?>

	<?php the_content(); ?>

	<div class="dashboard-loader">
		<?php esc_html_e( 'Loading…', 'orbis-5' ); ?>
	</div>

	<div id="dashboard-content-holder">
	</div>

<?php endwhile; ?>

<?php get_footer(); ?>
