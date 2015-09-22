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
if (class_exists('Carbon_Breadcrumb_Trail')) {
	return;
}

/**
 * The main Carbon Breadcrumbs plugin class.
 *
 * Singleton, used as a bootstrap to include the plugin files.
 */
final class Carbon_Breadcrumbs {
	/**
	 * Instance container.
	 *
	 * @static
	 * @access private
	 *
	 * @var Carbon_Breadcrumbs
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 *	
	 * Private so only the get_instance() can instantiate it.
	 *
	 * @access private
	 */
	private function __construct() {
		// include the plugin files
		self::include_files();
	}

	/**
	 * Retrieve or create the Carbon_Breadcrumbs instance.
	 *
	 * @static
	 * @access public
	 *
	 * @return Carbon_Breadcrumbs $instance
	 */
	public static function get_instance() {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Include the plugin files.
	 *
	 * @static
	 * @access public
	 */
	public static function include_files() {
		$base_dir = dirname(__FILE__);
		$includes_dir = $base_dir . '/includes/';

		include_once($includes_dir . 'Carbon_Breadcrumb_Trail.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Trail_Renderer.php');

		include_once($includes_dir . 'Carbon_Breadcrumb_DB_Object.php');	

		include_once($includes_dir . 'Carbon_Breadcrumb_Locator.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Locator_Post.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Locator_Term.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Locator_User.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Locator_Date.php');

		include_once($includes_dir . 'Carbon_Breadcrumb_Item.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Item_Post.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Item_Term.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Item_User.php');
		include_once($includes_dir . 'Carbon_Breadcrumb_Item_Custom.php');

		include_once($includes_dir . 'Carbon_Breadcrumb_Exception.php');

		include_once($base_dir . '/admin/Carbon_Breadcrumb_Admin.php');
	}

	/**
	 * Private __clone() to prevent cloning the singleton instance.
	 *
	 * @access private
	 */
	private function __clone() {}

	/**
	 * Private __wakeup() to prevent singleton instance unserialization.
	 *
	 * @access private
	 */
	private function __wakeup() {}

}

// initialize the plugin
Carbon_Breadcrumbs::get_instance();