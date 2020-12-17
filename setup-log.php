<?php
/**
 * Plugin Name: Setup Log
 * Description: Display custom Guttenburg block via Advanced Custom Fields.
 * Version: 2.0.0
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


// ENQUEUE STYLE IN PUBLIC (LIVE)
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

if ( !is_admin() ) {

    // ENQUEUE SCRIPTS
    add_action( 'wp_enqueue_scripts', 'setup_log_function', 20 );

}


// ENQUEUE ADMIN SCRIPTS
/*add_action( 'admin_enqueue_scripts', 'setup_log_function_admin' );
function setup_log_function_admin() {
        wp_register_script( 'setup_log_wp_admin_css', plugins_url( 'js/asset_admin.js', __FILE__ ), NULL, NULL, TRUE );
        wp_enqueue_script( 'setup_log_wp_admin_css' );
}*/
