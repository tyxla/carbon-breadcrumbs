<?php
/**
 * Manages breadcrumb administration settings.
 */
class Carbon_Breadcrumb_Admin_Settings {

	/**
	 * Constructor.
	 *
	 * Initialize the administration breadcrumb settings.
	 *
	 * @access public
	 */
	public function __construct() {
		// register settings page
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 30 );

		// register settings fields & sections
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Name of the settings page.
	 *
	 * @access public
	 * @static
	 *
	 * @return string $name The name of the options page.
	 */
	public static function get_page_name() {
		return 'carbon_breadcrumbs_settings';
	}

	/**
	 * Title of the settings page.
	 *
	 * @access public
	 * @static
	 *
	 * @return string $title The title of the options page.
	 */
	public static function get_page_title() {
		return 'Carbon Breadcrumbs';
	}

	/**
	 * Register the settings page.
	 *
	 * @access public
	 */
	public function admin_menu() {
		add_options_page(
			self::get_page_title(),
			self::get_page_title(),
			'manage_options',
			self::get_page_name(),
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Register the settings sections and fields.
	 *
	 * @access public
	 */
	public function register_settings() {
	}

	/**
	 * Content of the settings page.
	 *
	 * @access public
	 */
	public function settings_page() {
		?>
		<div class="wrap">
			<h2><?php echo self::get_page_title(); ?></h2>
		</div>

		<form method="POST" action="options.php">
			<?php
			settings_fields( self::get_page_name() );
			do_settings_sections( self::get_page_name() );
			submit_button();
			?>
		</form>
		<?php
	}

}