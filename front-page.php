<?php get_header(); ?>

<?php

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		the_content();
	}
}

?>

<?php if ( is_active_sidebar( 'frontpage-top-widget' ) ) : ?>

	<div class="row">
		<?php dynamic_sidebar( 'frontpage-top-widget' ); ?>
	</div>

<?php endif; ?>

<?php if ( is_active_sidebar( 'frontpage-left-widget' ) || is_active_sidebar( 'frontpage-right-widget' ) ) : ?>

	<div class="row">
		<div class="col-md-6">
			<?php dynamic_sidebar( 'frontpage-left-widget' ); ?>
		</div>

		<div class="col-md-6">
			<?php dynamic_sidebar( 'frontpage-right-widget' ); ?>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>
