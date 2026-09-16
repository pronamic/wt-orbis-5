<?php

/**
 * Widget includes
 */
require_once get_template_directory() . '/includes/widgets/orbis-widget-stats.php';

/**
 * Register our sidebars and widgetized areas.
 */
function orbis_widgets_init() {

	/* Register custom WordPress Widgets */

	register_widget( 'Orbis_Stats_Widget' );

	/* Register Widget Areas */

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
