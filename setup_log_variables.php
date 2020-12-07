<?php

function pull_custom_fielders( $field, $z ) {

	// DATE
	if( in_array( $field, $z ) && $field == 'log_date' ) {
		return setup_be_log_date();
	}

	// TIME
	if( in_array( $field, $z ) && $field == 'log_time' ) {
		return setup_be_log_time();
	}

	// CODE
	if( in_array( $field, $z ) && $field == 'log_code' ) {
		return setup_be_log_code();
	}

	// LABEL
	if( in_array( $field, $z ) && $field == 'log_label' ) {
		return setup_be_log_label();
	}

	// TITLE
	if( in_array( $field, $z ) && $field == 'log_title' ) {
		return setup_be_log_title();
	}

	// SUMMARY
	if( in_array( $field, $z ) && $field == 'log_summary' ) {
		return setup_be_log_summary();
	}

	// INFO
	if( in_array( $field, $z ) && $field == 'log_info' ) {
		return setup_be_log_info();
	}

	// CTA Term
	if( in_array( $field, $z ) && $field == 'log_cta_term' ) {
		return setup_be_log_info();	// HEY MARK, NOT SURE IF YOU HAVE A FUNCTION FOR THIS FIELD ALREADY; PLEASE CHANGE NA LANG PRE.
	}

	// USER
	if( in_array( $field, $z ) && $field == 'log_user' ) {
		return setup_be_log_user();
	}

	// LINK EXTERNAL
	if( in_array( $field, $z ) && $field == 'log_link' ) {
		return '<div>'.setup_be_log_link_external_dynamic().'</div>';
	}

	// LINK INTERNAL
	if( in_array( $field, $z ) && $field == 'log_link_internal' ) {
		return '<div>'.setup_be_log_link().'</div>';
	}

	// INNERBLOCK
	if( in_array( $field, $z ) && $field == 'log_innerblock' ) {
		return '<div class="group innerblock"><InnerBlocks /></div>';
	}

}