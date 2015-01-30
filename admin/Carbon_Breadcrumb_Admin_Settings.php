<?php
/**
 * Manages breadcrumb administration settings.
 */
class Carbon_Breadcrumb_Admin_Settings {

	/**
	 * Registered fields.
	 *
	 * @access protected
	 * @var array
	 */
	public $fields = array();

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
	 * Register the settings page & default section.
	 *
	 * @access public
	 */
	public function admin_menu() {

		// register settings page
		add_options_page(
			self::get_page_title(),
			self::get_page_title(),
			'manage_options',
			self::get_page_name(),
			array( $this, 'settings_page' )
		);

		// register settings section
		add_settings_section(
			self::get_page_name(),
			'',
			'',
			self::get_page_name()
		);

	}

	/**
	 * Register the settings sections and fields.
	 *
	 * @access public
	 */
	public function register_settings() {
		// define fields
		$fields = array(
			'glue' => array(
				'type' => 'text',
				'title' => 'Glue',
			),
			'link_before' => array(
				'type' => 'text',
				'title' => 'Link Before',
			),
			'link_after' => array(
				'type' => 'text',
				'title' => 'Link After',
			),
			'wrapper_before' => array(
				'type' => 'text',
				'title' => 'Wrapper Before',
			),
			'wrapper_after' => array(
				'type' => 'text',
				'title' => 'Wrapper After',
			),
			'title_before' => array(
				'type' => 'text',
				'title' => 'Title Before',
			),
			'title_after' => array(
				'type' => 'text',
				'title' => 'Title After',
			),
			'min_items' => array(
				'type' => 'text',
				'title' => 'Min Items',
			),
			'last_item_link' => array(
				'type' => 'checkbox',
				'title' => 'Last Item Link',
			),
			'display_home_item' => array(
				'type' => 'checkbox',
				'title' => 'Display Home Item?',
			),
			'home_item_title' => array(
				'type' => 'text',
				'title' => 'Home Item Title',
			),
		);

		// register fields
		foreach ($fields as $field_id => $field_data) {
			$this->fields[] = Carbon_Breadcrumb_Admin_Settings_Field::factory($field_data['type'], 'carbon_breadcrumbs_' . $field_id, $field_data['title'], self::get_page_name());
		}
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