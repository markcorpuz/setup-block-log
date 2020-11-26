<?php

$z = get_field( 'log_filter' );
	
/*
	log_filter_spec : Spec
		log_code
		log_label
		log_user

	log_filter_date : Date
		log_date
		log_time

	log_filter_info : Info
		log_title
		log_summary
		log_info

	log_filter_link : Link
		log_link (external)
		log_link_internal

	log_filter_innerblock : Block
		log_display_innerblock
		log_expanded_innerblock
*/

$out = ''; // initialize variable

// SPEC
if( in_array( 'log_filter_spec', $z ) ) {

	if( get_field( 'log_code_display' ) == 'show' ) {
		$out .= setup_be_log_code();
	}

	if( get_field( 'log_label_display' ) == 'show' ) {
		$out .= setup_be_log_label();
	}

	if( get_field( 'log_user_display' ) == 'show' ) {
		$out .= setup_be_log_user();
	}
	//$out .= .setup_be_log_user();
}

// DATE
if( in_array( 'log_filter_date', $z ) ) {
	$out .= setup_be_log_date().setup_be_log_time();
}

// INFO
if( in_array( 'log_filter_info', $z ) ) {
	$out .= setup_be_log_title().setup_be_log_summary().setup_be_log_info();
}

// LINK
if( in_array( 'log_filter_link', $z ) ) {
	$out .= '<div>'.setup_be_log_link().'</div><div>'.setup_be_log_link_external_dynamic().'</div>';
}

// INNERBLOCK
/*if( in_array( 'log_filter_innerblock', $z ) ) {

	// get field contents
	$ib_checker = get_field( 'log_display_innerblock' );
	$ib_checker_ex = get_field( 'log_expanded_innerblock' );

	// initialize variable
	$ib_var = '<div class="group innerblock"><InnerBlocks /></div>';


	// check if we're to show InnerBlocks in WP-ADMIN
	if( is_admin() && is_user_logged_in() ) {

		if( in_array( 'show_admin', $ib_checker ) ) {

			$val_inner_block = $ib_var;

		} else {

			$val_inner_block = '';

		}

	} else {
		
		// LIVE user is NOT logged in
		if( in_array( 'show_live', $ib_checker ) ) {

			if( $ib_checker_ex == 'show' ) {

				// SHOW INNERBLOCK OUTSIDE THE HIDDEN DIV

				$innerblock_expanded = $ib_var;
				
				$val_inner_block = '';

			} elseif( $ib_checker_ex == 'collapse' ) {

				// COLLAPSABLE

				$innerblock_expanded = '';
				
				$val_inner_block = '<div class="left"><a class="item expand" id="group_line_ib_expander__'.$block_counter.'">CLICK TO EXPAND</a></div>
									<div class="group info hide" id="group_info_ib__'.$block_counter.'">'.$ib_var.'</div>';

			} else {

				// just show InnerBlock inside the hidden div
				$innerblock_expanded = '';
				
				$val_inner_block = $ib_var;

			}	

		} else {

			$val_inner_block = '';

		}

	}

}*/

echo '<div class="'.join( ' ', $classes ).'"><div class="module-wrap">'.$out.'</div></div>';