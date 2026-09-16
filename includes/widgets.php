<?php

/**
 * Widget includes
 */
require_once get_template_directory() . '/includes/widgets/orbis-widget-stats.php';

/**
 * Register our sidebars and widgetized areas.
 */
function orbis_widgets_init() {

	/* Unregister default WordPress Widgets */

	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Recent_Comments' );

	/* Register custom WordPress Widgets */

	register_widget( 'Orbis_Stats_Widget' );

	/* Register Widget Areas */

	register_sidebar(
		[
			'name'          => __( 'Main Widget Area', 'orbis-5' ),
			'id'            => 'main-widget',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		]
	);

	register_sidebar(
		[
			'name'          => __( 'Dashboard Widget Area', 'orbis-5' ),
			'id'            => 'dashboard-sidebar',
			'before_widget' => '<div class="col-md-6"><div id="%1$s" class="mb-3 card %2$s">',
			'after_widget'  => '</div></div></div>',
			'before_title'  => '<div class="card-header">',
			'after_title'   => '</div><div class="card-body">',
		]
	);

}

add_action( 'widgets_init', 'orbis_widgets_init' );
