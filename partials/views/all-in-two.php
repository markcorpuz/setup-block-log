<?php

global $block_css, $block_counter;

// increment counter
$block_counter ++ ;

$classes = array(
	'module',
	'log',
	'stack',
	'minimal',
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

// ###########################################################
// # GET VARIABLES
// ###########################################################
$out = ''; // initialize variable

 // DATE
if( in_array( 'log_date', $z ) ) {
	$log_date = setup_be_log_date();
}

// TIME
if( in_array( 'log_time', $z ) ) {
	$log_time = setup_be_log_time();
}

// CODE
if( in_array( 'log_code', $z ) ) {
	$log_code = setup_be_log_code();
}

// LABEL
if( in_array( 'log_label', $z ) ) {
	$log_label = setup_be_log_label();
}

// TITLE
if( in_array( 'log_title', $z ) ) {
	$log_title = setup_be_log_title();
}

// SUMMARY
if( in_array( 'log_summary', $z ) ) {
	$log_summary = setup_be_log_summary();
}

// INFO
if( in_array( 'log_info', $z ) ) {
	$log_info = setup_be_log_info();
}

// CTA Term
if( in_array( 'log_cta_term', $z ) ) {
	$log_cta_term = setup_be_log_info();	// HEY MARK, NOT SURE IF YOU HAVE A FUNCTION FOR THIS FIELD ALREADY; PLEASE CHANGE NA LANG PRE.
}

// USER
if( in_array( 'log_user', $z ) ) {
	$log_user = setup_be_log_user();
}

// LINK EXTERNAL
if( in_array( 'log_link', $z ) ) {
	$log_link_external = '<div>'.setup_be_log_link_external_dynamic().'</div>';
}

// LINK INTERNAL
if( in_array( 'log_link_internal', $z ) ) {
	$log_link_internal = '<div>'.setup_be_log_link().'</div>';
}

// INNERBLOCK
if( in_array( 'log_innerblock', $z ) ) {
	$log_innerblock .= '<div class="group innerblock"><InnerBlocks /></div>';
}


// ###########################################################
// # HANDLE THE DISPLAY - DEFAULT (JUST SHOW THEM ALL)
// ###########################################################
if( $log_state == 'default' ) {

	$out = $log_date.$log_time.$log_code.$log_label.$log_title.$log_summary.$log_info.
			$log_cta_term.$log_user.$log_link_external.$log_link_internal.$log_innerblock;

}


// ###########################################################
// # HANDLE THE DISPLAY - MINIMIZED
// ###########################################################
if( $log_state == 'minimized' ) {

	$out = '<div class="group bar">
				<div class="left"><a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO EXPAND</a></div>
				<div class="right">
					'.$log_code.$log_label.$log_date.$log_time.$log_user.$log_link_external.$log_link_internal.'
				</div>
			</div>			
			<div class="group info hide" id="group_info__'.$block_counter.'">
				'.$log_title.$log_summary.$log_info.$log_cta_term.$log_innerblock.'
			</div>';
			
}


// ###########################################################
// # HANDLE THE DISPLAY - EXPANDED
// ###########################################################
if( $log_state == 'expanded' ) {

	$out = '<div class="group bar">
				<div class="left"><a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO HIDE</a></div>
				<div class="right">
					'.$log_code.$log_label.$log_date.$log_time.$log_user.$log_link_external.$log_link_internal.'
				</div>
			</div>			
			<div class="group info" id="group_info__'.$block_counter.'">
				'.$log_title.$log_summary.$log_info.$log_cta_term.$log_innerblock.'
			</div>';

}


if( empty( strip_tags( $out ) ) && empty( $log_innerblock ) ) {
	// show default notification that the block exists
	//SETUP-LOG | Template: All-In | Show: Title Summary InnerBlock
	$out = 'SETUP-LOG | Template: '.get_field( 'log_layout' ).' | Show: (Jake show all fields that are selected)';
}

// OUTPUT
echo '<div class="'.join( ' ', $classes ).'"><div class="module-wrap">'.$out.'</div></div>';
