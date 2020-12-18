<?php

$layout = get_field( 'log_layout' );

global $block_css;

if( array_key_exists( 'className', $block ) ) {
	$block_css = $block[ 'className' ];
} else {

	// unset variable so the styling won't spill over to the next block
	/*if( isset( $block_css ) ) {
		unset( $block_css );
	}*/
	$block_css = '';
	
}

//echo setup_acf_pull_view_template( $layout );
$slayout = setup_acf_pull_view_template( $layout );
if( $slayout === FALSE ) {
	echo '<h4>Template is missing. Please check.</h4>';
} else {
	echo $slayout;
}