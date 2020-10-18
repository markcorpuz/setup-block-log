<?php

/*
 * TEMPLATE: PULL ALL
 */

global $block_css, $pid;

// add more class selectors here
$classes = array();

$classes = array_merge( $classes, explode( ' ', $block_css ) );

// container wrap
echo '<div class="'.join( ' ', $classes ).'">';

	echo '<strong>Title:</strong> '.get_the_title( $pid );

	?><hr /><?php

	$wp_content = get_the_content( NULL, FALSE, $pid );
    if( $wp_content ) {
        
        echo '<strong>Content of '.$pid.':</strong> '.$wp_content;
        
    }

echo '</div>';