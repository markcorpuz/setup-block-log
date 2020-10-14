<?php
/**
 * Plugin Name: SETUP LOG
 * Description: Display custom Guttenburg block via Advanced Custom Fields.
 * Version: 1.0.6
 * Author: Jake Almeda & Mark Corpuz
 * Author URI: https://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


add_action( 'genesis_setup', 'setup_log_fn', 15 );
function setup_log_fn() {
	include_once( plugin_dir_path( __FILE__ ).'setup-log-acf.php' );
}

// Enqueue Style
function setup_log_function() {

	// 'jquery-effects-core', 'jquery-effects-fade', 'jquery-ui-accordion'
	$scripts = array( 'jquery-ui-core', 'jquery-effects-slide' );
	foreach ( $scripts as $value ) {
		if( !wp_script_is( $value, 'enqueued' ) ) {
        	wp_enqueue_script( $value );
    	}
	}

    // last arg is true - will be placed before </body>
    wp_enqueue_script( 'setup_log_script', plugins_url( 'js/asset.js', __FILE__ ), NULL, NULL, TRUE );
	
    // enqueue styles
    wp_enqueue_style( 'setup_log_style', plugins_url( 'css/setup_log_style.css', __FILE__ ) );

}

/**
 * NOTE: Temporarily disabling plugin based styling due to the repetitive nature of reusing styles.
 * Remove comments below to allow if we want the styles to be independent but at the moment, we're using the default child theme styles
 * 
 */

if ( !is_admin() ) {

    // ENQUEUE SCRIPTS
    add_action( 'wp_enqueue_scripts', 'setup_log_function', 20 );

}
