<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// set global variable for css selectors
global $block_css;
if( array_key_exists( 'className', $block ) ) {
	// get css selectors indicated in the wp-admin editor gutenberg block
	$block_css = $block[ 'className' ];
}


// get field - layout (template)
$layout = get_field( 'pull_layout' );

/*
//echo setup_acf_pull_view_template( $layout );
$slayout = setup_acf_pull_view_template( $layout );

if( $slayout === FALSE ) {

	echo '<h4>Template is missing. Please check.</h4>';

} else {

	// get field - relationship (pull from)
	$pull_from = get_field( 'pull_from' );
	if( is_array( $pull_from) ) {

		foreach( $pull_from as $pid ) {
			echo '<h1 style="color:red;">'.$pid.'</h1>';
			echo $slayout;

		}

	} else {

		// pull from field is empty
		echo '<h3>Please choose an article to pull from.</h3>';

	}

}
*/
$pull_from = get_field( 'pull_from' );
if( is_array( $pull_from) ) {

	foreach( $pull_from as $pid ) {
		//echo '<h1 style="color:red;">'.$pid.'</h1>';
		//echo $slayout;
		$args = array(
			'id'		=> $pid,
		);
		$slayout = setup_acf_pull_view_template( $layout, $args );

		if( $slayout === FALSE ) {

			echo '<h4>Template is missing. Please check.</h4>';

		} else {

			echo $slayout;

		}

	}

} else {

	// pull from field is empty
	echo '<h3>Please choose an article to pull from.</h3>';

}