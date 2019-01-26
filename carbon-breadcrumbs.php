<?php
/**
 * Plugin Name: Carbon Breadcrumbs
 * Description: A basic plugin for breadcrumbs with advanced capabilities for extending.
 * Version: 1.0.2
 * Author: tyxla
 * Author URI: http://marinatanasov.com/
 * Plugin URI: https://github.com/tyxla/carbon-breadcrumbs
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 4.5
 * Text Domain: carbon_breadcrumbs
 * Domain Path: /languages
 *
 * @package carbon-breadcrumbs
 */

// Allows the plugin to be included as a library in themes.
if ( class_exists( 'Carbon_Breadcrumb_Trail' ) ) {
	return;
}

// Define directories.
$base_dir = dirname( __FILE__ );
$core_dir = $base_dir . '/core/';

// Utility classes.
include_once( $core_dir . 'class-Carbon-Breadcrumb-Factory.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-L10n.php' );

// Main classes.
include_once( $core_dir . 'class-Carbon-Breadcrumb-Trail.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Trail-Setup.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Trail-Renderer.php' );

// Interfaces.
include_once( $core_dir . 'class-Carbon-Breadcrumb-DB-Object.php' );

// Locators.
include_once( $core_dir . 'class-Carbon-Breadcrumb-Locator.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Locator-Hierarchical.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Locator-Post.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Locator-Term.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Locator-User.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Locator-Date.php' );

// Items.
include_once( $core_dir . 'class-Carbon-Breadcrumb-Item.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Item-DB-Object.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Item-Post.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Item-Term.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Item-User.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Item-Custom.php' );
include_once( $core_dir . 'class-Carbon-Breadcrumb-Item-Renderer.php' );

// Exceptions.
include_once( $core_dir . 'class-Carbon-Breadcrumb-Exception.php' );

// Administration.
include_once( $base_dir . '/admin/class-Carbon-Breadcrumb-Admin.php' );

// Initialize l10n support.
global $carbon_breadcrumb_l10n;
$carbon_breadcrumb_l10n = new Carbon_Breadcrumb_L10n();

// Initialize the administration interface.
global $carbon_breadcrumb_admin;
$carbon_breadcrumb_admin = new Carbon_Breadcrumb_Admin();
