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
include_once( $core_dir . 'class-carbon-breadcrumb-factory.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-l10n.php' );

// Main classes.
include_once( $core_dir . 'class-carbon-breadcrumb-trail.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-trail-setup.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-trail-renderer.php' );

// Interfaces.
include_once( $core_dir . 'class-carbon-breadcrumb-db-object.php' );

// Locators.
include_once( $core_dir . 'class-carbon-breadcrumb-locator.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-locator-hierarchical.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-locator-post.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-locator-term.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-locator-user.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-locator-date.php' );

// Items.
include_once( $core_dir . 'class-carbon-breadcrumb-item.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-item-db-object.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-item-post.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-item-term.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-item-user.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-item-custom.php' );
include_once( $core_dir . 'class-carbon-breadcrumb-item-renderer.php' );

// Exceptions.
include_once( $core_dir . 'class-carbon-breadcrumb-exception.php' );

// Administration.
include_once( $base_dir . '/admin/class-carbon-breadcrumb-admin.php' );

// Initialize l10n support.
global $carbon_breadcrumb_l10n;
$carbon_breadcrumb_l10n = new Carbon_Breadcrumb_L10n();

// Initialize the administration interface.
global $carbon_breadcrumb_admin;
$carbon_breadcrumb_admin = new Carbon_Breadcrumb_Admin();
