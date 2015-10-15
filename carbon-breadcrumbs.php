<?php
/**
 * Plugin Name: Carbon Breadcrumbs
 * Description: A basic plugin for breadcrumbs with advanced capabilities for extending.
 * Version: 1.0
 * Author: tyxla
 * Author URI: https://github.com/tyxla
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 4.3.1
 */

// allows the plugin to be included as a library in themes
if ( class_exists( 'Carbon_Breadcrumb_Trail' ) ) {
	return;
}

// define directories
$base_dir = dirname( __FILE__ );
$includes_dir = $base_dir . '/includes/';

// main classes
include_once( $includes_dir . 'Carbon_Breadcrumb_Trail.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Trail_Setup.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Trail_Renderer.php' );

// interfaces
include_once( $includes_dir . 'Carbon_Breadcrumb_DB_Object.php' );	

// locators
include_once( $includes_dir . 'Carbon_Breadcrumb_Locator.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Locator_Post.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Locator_Term.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Locator_User.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Locator_Date.php' );

// items
include_once( $includes_dir . 'Carbon_Breadcrumb_Item.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Item_DB_Object.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Item_Post.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Item_Term.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Item_User.php' );
include_once( $includes_dir . 'Carbon_Breadcrumb_Item_Custom.php' );

// exceptions
include_once( $includes_dir . 'Carbon_Breadcrumb_Exception.php' );

// administration
include_once( $base_dir . '/admin/Carbon_Breadcrumb_Admin.php' );

// initialize the administration interface
Carbon_Breadcrumb_Admin::get_instance();