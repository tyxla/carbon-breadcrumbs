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
	 * @access private
	 *
	 * @var Carbon_Breadcrumb_Admin
	 */
	private static $instance = null;

	/**
	 * Settings container.
	 *
	 * @static
	 * @access public
	 *
	 * @var Carbon_Breadcrumb_Admin_Settings
	 */
	public static $settings = null;

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

		// if administration is enabled, initialize
		if ( $this->is_enabled() ) {
			add_action( 'init', array( $this, 'init' ) );
			add_action( 'admin_menu', array( $this, 'admin_init' ), 20 );
		}
	}

	/**
	 * Retrieve or create the Carbon_Breadcrumb_Admin instance.
	 *
	 * @static
	 * @access public
	 *
	 * @return Carbon_Breadcrumb_Admin $instance
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
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
		$dir = dirname( __FILE__ );

		include_once($dir . '/Carbon_Breadcrumb_Admin_Settings.php');
		include_once($dir . '/Carbon_Breadcrumb_Admin_Settings_Field.php');
		include_once($dir . '/Carbon_Breadcrumb_Admin_Settings_Field_Text.php');
		include_once($dir . '/Carbon_Breadcrumb_Admin_Settings_Field_Checkbox.php');
	}

	/**
	 * Initialize breadcrumb administration.
	 *
	 * @access public
	 */
	public function admin_init() {
		// register settings
		$this->register_settings();
	}

	/**
	 * Initialize breadcrumb frontend.
	 *
	 * @access public
	 */
	public function init() {
		// apply the breadcrumb renderer settings
		add_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'apply_settings' ), 20 );
	}

	/**
	 * Register and setup the settings page and fields.
	 *
	 * @access public
	 */
	public function register_settings() {
		// register the settings page and fields
		self::$settings = new Carbon_Breadcrumb_Admin_Settings();
	}

	/**
	 * Apply the settings to the breadcrumb trail renderer
	 *
	 * @access public
	 *
	 * @param array $settings The default settings.
	 * @return array $settings The modified settings.
	 */
	public function apply_settings( $settings ) {
		$settings_fields = Carbon_Breadcrumb_Admin_Settings::get_field_data();

		foreach ( $settings_fields as $field_id => $field ) {
			$settings[ $field_id ] = get_option( 'carbon_breadcrumbs_' . $field_id );
			if ( 'checkbox' == $field['type'] ) {
				$settings[ $field_id ] = (bool) $settings[ $field_id ];
			}
		}

		return $settings;
	}

	/**
	 * Whether the administration interface should be enabled.
	 *
	 * @access public
	 *
	 * @return bool $is_enabled True if the admin interface is enabled.
	 */
	public function is_enabled() {
		$enabled = false;

		// enabled if this plugin is installed as a regular WordPress plugin
		$plugin_path = untrailingslashit( ABSPATH ) . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins';
		$current_dir = dirname( __FILE__ );
		if ( false !== strpos( $current_dir, $plugin_path ) ) {
			$enabled = true;
		}

		// enabled if the CARBON_BREADCRUMB_ENABLE_ADMIN is defined as `true`
		if ( defined( 'CARBON_BREADCRUMB_ENABLE_ADMIN' ) && CARBON_BREADCRUMB_ENABLE_ADMIN ) {
			$enabled = true;
		}

		// allow manual enabling/disabling
		return apply_filters( 'carbon_breadcrumb_enable_admin', $enabled );
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