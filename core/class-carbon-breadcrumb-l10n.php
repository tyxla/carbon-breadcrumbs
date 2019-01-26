<?php
/**
 * L10n
 *
 * @package carbon-breadcrumbs
 */

/**
 * Localization class.
 * Adds support for translations.
 */
class Carbon_Breadcrumb_L10n {

	/**
	 * Constructor.
	 *
	 * Initializes and hooks the plugin localization functionality.
	 *
	 * @access public
	 */
	public function __construct() {
		// Register our plugins_loaded method.
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
	}

	/**
	 * Load the plugin textdomain.
	 *
	 * @access public
	 */
	public function plugins_loaded() {
		// Initialize translations.
		$path = dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages';
		load_plugin_textdomain( 'carbon_breadcrumbs', false, $path );
	}

}
