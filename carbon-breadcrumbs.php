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
 * Text Domain: carbon_breadcrumbs
 * Domain Path: /languages
 */

// allows the plugin to be included as a library in themes
if ( class_exists( 'Carbon_Breadcrumb_Trail' ) ) {
	return;
}

// define directories
$base_dir = dirname( __FILE__ );
$core_dir = $base_dir . '/core/';

// utility classes
include_once( $core_dir . 'Carbon_Breadcrumb_Factory.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_L10n.php' );

// main classes
include_once( $core_dir . 'Carbon_Breadcrumb_Trail.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Trail_Setup.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Trail_Renderer.php' );

// interfaces
include_once( $core_dir . 'Carbon_Breadcrumb_DB_Object.php' );

// locators
include_once( $core_dir . 'Carbon_Breadcrumb_Locator.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Locator_Hierarchical.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Locator_Post.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Locator_Term.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Locator_User.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Locator_Date.php' );

// items
include_once( $core_dir . 'Carbon_Breadcrumb_Item.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Item_DB_Object.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Item_Post.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Item_Term.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Item_User.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Item_Custom.php' );
include_once( $core_dir . 'Carbon_Breadcrumb_Item_Renderer.php' );

// exceptions
include_once( $core_dir . 'Carbon_Breadcrumb_Exception.php' );

// administration
include_once( $base_dir . '/admin/Carbon_Breadcrumb_Admin.php' );

// initialize l10n support
new Carbon_Breadcrumb_L10n();

// initialize the administration interface
Carbon_Breadcrumb_Admin::get_instance();