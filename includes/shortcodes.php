<?php

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
