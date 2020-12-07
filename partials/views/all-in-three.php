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


// ###########################################################
// # GROUPING | ONE (LEFT)
// ###########################################################	
$log_group_one = get_field( 'log_group_one' );
if( is_array( $log_group_one ) ) {
	
	foreach( $log_group_one as $value ) {
		$outs_left .= pull_custom_fielders( $value, $z );
	}

} else {

	// OUTPUT DEFAULT LAYOUT
	$outs_left 	= 	pull_custom_fielders( 'log_code', $z ).
					pull_custom_fielders( 'log_label', $z ).
					pull_custom_fielders( 'log_date', $z ).
					pull_custom_fielders( 'log_time', $z ).
					pull_custom_fielders( 'log_user', $z ).
					pull_custom_fielders( 'log_link', $z ). // external
					pull_custom_fielders( 'log_link_internal', $z );

}


// ###########################################################
// # GROUPING | ONE (LEFT)
// ###########################################################	
$log_group_two = get_field( 'log_group_two' );
if( is_array( $log_group_two ) ) {

	foreach( $log_group_two as $value ) {
		$outs_right .= pull_custom_fielders( $value, $z );
	}

} else {

	// OUTPUT DEFAULT LAYOUT
	$outs_right 	= 	pull_custom_fielders( 'log_title', $z ).
						pull_custom_fielders( 'log_summary', $z ).
						pull_custom_fielders( 'log_info', $z ).
						pull_custom_fielders( 'log_cta_term', $z ).
						pull_custom_fielders( 'log_innerblock', $z );

}


// ###########################################################
// # HANDLE THE DISPLAY - DEFAULT (JUST SHOW THEM ALL)
// ###########################################################
if( $log_state == 'default' ) {

	$out = 	pull_custom_fielders( 'log_date', $z ).
			pull_custom_fielders( 'log_time', $z ).
			pull_custom_fielders( 'log_code', $z ).
			pull_custom_fielders( 'log_label', $z ).
			pull_custom_fielders( 'log_title', $z ).
			pull_custom_fielders( 'log_summary', $z ).
			pull_custom_fielders( 'log_info', $z ).
			pull_custom_fielders( 'log_cta_term', $z ).
			pull_custom_fielders( 'log_user', $z ).
			pull_custom_fielders( 'log_link', $z ). // external
			pull_custom_fielders( 'log_link_internal', $z ).
			pull_custom_fielders( 'log_innerblock', $z );

}


// ###########################################################
// # HANDLE THE DISPLAY - MINIMIZED
// ###########################################################
if( $log_state == 'minimized' ) {

	$out = '<div class="group bar">
				<div class="left"><a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO EXPAND</a></div>
				<div class="right">'.$outs_left.'</div>
			</div>			
			<div class="group info hide" id="group_info__'.$block_counter.'">'.$outs_right.'</div>';
			
}


// ###########################################################
// # HANDLE THE DISPLAY - EXPANDED
// ###########################################################
if( $log_state == 'expanded' ) {

	$out = '<div class="group bar">
				<div class="left"><a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO HIDE</a></div>
				<div class="right">'.$outs_left.'</div>
			</div>			
			<div class="group info" id="group_info__'.$block_counter.'">'.$outs_right.'</div>';

}


if( empty( strip_tags( $out ) ) ) {
	// show default notification that the block exists
	//SETUP-LOG | Template: All-In | Show: Title Summary InnerBlock
	$out = 'SETUP-LOG | Template: '.get_field( 'log_layout' ).' | Show: (Jake show all fields that are selected)';
}

// OUTPUT
echo '<div class="'.join( ' ', $classes ).'"><div class="module-wrap">'.$out.'</div></div>';
