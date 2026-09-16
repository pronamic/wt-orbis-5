<?php

/**
 * Shortcode support for text widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Fix shortcode output
 */
function orbis_shortcode_empty_paragraph_fix( $content ) {
	$array = [
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']',
	];

	$content = strtr( $content, $array );

	return $content;
}

add_filter( 'the_content', 'orbis_shortcode_empty_paragraph_fix' );

/**
 * Grid
 */
function orbis_row_grid( $atts, $content = null ) {
	$output = '<div class="row">' . do_shortcode( $content ) . '</div>';

	return $output;
}

function orbis_columns_grid( $atts, $content = null ) {
	$atts = shortcode_atts(
		[
			'number' => '12',
			'offset' => '',
		],
		$atts
	);

	return '<div class="col-md-' . $atts['number'] . ' ' . ( $atts['offset'] ? 'col-md-offset-' . $atts['offset'] : '' ) . '">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'row', 'orbis_row_grid' );
add_shortcode( 'col', 'orbis_columns_grid' );
