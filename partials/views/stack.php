<?php

global $block_css, $block_counter;

// increment counter
$block_counter ++ ;

$classes = array(
	'module',
	'log',
	'stack',
);

// Include CSS selectors manually entered thru wp-admin
//if( array_key_exists( 'className', $block ) ) {
    $classes = array_merge( $classes, explode( ' ', $block_css ) );
//}

$z = get_field( 'log_show' );
/*foreach ($z as $val) {
	echo $val.'<br />';
}*/
$log_state = get_field( 'log_state' );


/**
 * GET VARIABLES
 *
 */
$out = ''; // initialize variable

 // DATE
if( in_array( 'log_date', $z ) ) {
	$log_date = setup_child_log_date();
}

// TIME
if( in_array( 'log_time', $z ) ) {
	$log_time = setup_child_log_time();
}

// CODE
if( in_array( 'log_code', $z ) ) {
	$log_code = setup_child_log_code();
}

// LABEL
if( in_array( 'log_label', $z ) ) {
	$log_label = setup_child_log_label();
}

// TITLE
if( in_array( 'log_title', $z ) ) {
	$log_title = setup_child_log_title();
}

// SUMMARY
if( in_array( 'log_summary', $z ) ) {
	$log_summary = setup_child_log_summary();
}

// INFO
if( in_array( 'log_info', $z ) ) {
	$log_info = setup_child_log_info();
}

// CTA Term
if( in_array( 'log_cta', $z ) ) {
	$log_cta = setup_child_log_cta();
}

// USER
if( in_array( 'log_user', $z ) ) {
	$log_user = setup_child_log_user();
}

// LINK EXTERNAL
if( in_array( 'log_link', $z ) ) {
	$log_link_external_link = setup_child_log_link_ext_link();
}
if( in_array( 'log_link', $z ) ) {
	$log_link_external_url = setup_child_log_link_ext_url();
}

// LINK INTERNAL
if( in_array( 'log_link_internal', $z ) ) {
	$log_link_internal_link = setup_child_log_link_int_link();
}
if( in_array( 'log_link_internal', $z ) ) {
	$log_link_internal_url = setup_child_log_link_int_url();
}

// INNERBLOCK
if( in_array( 'log_innerblock', $z ) ) {
	$log_innerblock .= '<InnerBlocks />';
}


/**
 * STATE: DEFAULT
 * Default setting typically for showing everything
 *
 */
if( $log_state == 'default' ) {

	$out = '<div class="info">
				'.$log_title.$log_summary.'
			</div>
			<div class="spec">
				'.$log_code.$log_user.$log_label.$log_date.$log_cta.$log_link_external_link.$log_link_internal_link.'
			</div>
			<div class="item innerblock>
				'.$log_innerblock.'
			</div>';

}


/**
 * STATE: MINIMIZED
 * Show a minimized version by default with the option to expand
 *
 */
if( $log_state == 'minimized' ) {

	$out = '<div class="info">
				'.$log_title.$log_summary.'
			</div>
			<div class="spec">
				'.$log_code.$log_user.$log_label.$log_date.$log_cta.$log_link_external_link.$log_link_internal_link.'
			</div>
			<div class="item expand"><a class="alink" id="group_line_expander__'.$block_counter.'">CLICK TO EXPAND</a></div>
			<div class="item innerblock hide" id="group_info__'.$block_counter.'">
				'.$log_innerblock.'
			</div>';
			
}


/**
 * STATE: EXPANDED
 * Show an expanded version with an option to minimize
 *
 */
if( $log_state == 'expanded' ) {

	$out = '<div class="info">
				'.$log_title.$log_summary.'
			</div>
			<div class="spec">
				'.$log_code.$log_user.$log_label.$log_date.$log_cta.$log_link_external_link.$log_link_internal_link.'
			</div>
			<div class="item expand"><a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO HIDE</a></div>
			<div class="group innerblock hide" id="group_info__'.$block_counter.'">
				'.$log_innerblock.'
			</div>';

}


if( empty( strip_tags( $out ) ) && empty( $log_innerblock ) ) {
	// show default notification that the block exists
	//SETUP-LOG | Template: All-In | Show: Title Summary InnerBlock
	$out = 'SETUP-LOG | Template: '.get_field( 'log_layout' ).' | Show: (Jake show all fields that are selected)';
}

// OUTPUT
echo '<div class="'.join( ' ', $classes ).'"><div class="module-wrap">'.$out.'</div></div>';