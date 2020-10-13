<?php

$layout = get_field( 'log_layout' );

global $block_css;

if( array_key_exists( 'className', $block ) ) {
	$block_css = $block[ 'className' ];
}

echo setup_acf_pull_view_template( $layout );