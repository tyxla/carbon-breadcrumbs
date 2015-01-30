<?php
/**
 * The main breadcrumb administration class.
 * 
 * Includes, wraps and manages the administration functionality.
 */
final class Carbon_Breadcrumb_Admin {

	/**
	 * Instance container.
	 *
	 * @static
	 *
	 * @var Carbon_Breadcrumbs_Admin
	 */
	static $instance = null;

	/**
	 * Constructor.
	 * Private so only the get_instance() can instantiate it.
	 *
	 * Creates the administration functionality wrapper.
	 *
	 * @access private
	 */
	private function __construct() {
		// include the plugin files
		$this->include_files();

		// initialize
		add_action('admin_menu', array($this, 'init'), 20);
	}

	/**
	 * Retrieve or create the Carbon_Breadcrumbs instance._Admin
	 *
	 * @static
	 * @access public
	 *
	 * @return Carbon_Breadcrumbs $instance_Admin
	 */
	public static function get_instance() {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Include the administration files.
	 *
	 * @access public
	 */
	public function include_files() {
		$dir = dirname(__FILE__);

		include_once($dir . '/Carbon_Breadcrumb_Admin_Settings.php');
		include_once($dir . '/Carbon_Breadcrumb_Admin_Settings_Field.php');
		include_once($dir . '/Carbon_Breadcrumb_Admin_Settings_Field_Text.php');
	}

	/**
	 * Initialize breadcrumb administration.
	 *
	 * @access public
	 */
	public function init() {

		// if admin interface should not be enabled, bail
		if ( !$this->is_enabled() ) {
			return;
		}

		// register settings
		$this->register_settings();
	}

	/**
	 * Register and setup the settings page and fields.
	 *
	 * @access public
	 */
	public function register_settings() {
		// register the settings page and fields
		$settings_page = new Carbon_Breadcrumb_Admin_Settings();
	}
	
	/**
	 * Whether the administration interface should be enabled.
	 *
	 * @access public
	 *
	 * @return bool $is_enabled True if the admin interface is enabled.
	 */
	public function is_enabled() {

		// enabled if this plugin is installed as a regular WordPress plugin
		$plugin_path = untrailingslashit(ABSPATH) . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins';
		$current_dir = dirname(__FILE__);
		if ( strpos($current_dir, $plugin_path) !== false ) {
			return true;
		}

		// enabled if the CARBON_BREADCRUMB_ENABLE_ADMIN is defined as `true`
		if ( defined('CARBON_BREADCRUMB_ENABLE_ADMIN') && CARBON_BREADCRUMB_ENABLE_ADMIN ) {
			return true;
		}

		// disabled otherwise
		return false;
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

// initialize the admin interface
Carbon_Breadcrumb_Admin::get_instance();