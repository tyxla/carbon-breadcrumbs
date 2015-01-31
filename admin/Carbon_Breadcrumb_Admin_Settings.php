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
	 * Get field data. Defines and describes the fields that will be registered.
	 *
	 * @access public
	 * @static
	 *
	 * @return array $fields The fields and their data.
	 */
	public static function get_field_data() {
		return array(
			'glue' => array(
				'type' => 'text',
				'title' => 'Glue',
				'default' => ' > ',
				'help' => 'This is displayed between the breadcrumb items.',
			),
			'link_before' => array(
				'type' => 'text',
				'title' => 'Link Before',
				'default' => '',
				'help' => 'This is displayed before the breadcrumb item link.',
			),
			'link_after' => array(
				'type' => 'text',
				'title' => 'Link After',
				'default' => '',
				'help' => 'This is displayed after the breadcrumb item link.',
			),
			'wrapper_before' => array(
				'type' => 'text',
				'title' => 'Wrapper Before',
				'default' => '',
				'help' => 'This is displayed before displaying the breadcrumb items.',
			),
			'wrapper_after' => array(
				'type' => 'text',
				'title' => 'Wrapper After',
				'default' => '',
				'help' => 'This is displayed after displaying the breadcrumb items.',
			),
			'title_before' => array(
				'type' => 'text',
				'title' => 'Title Before',
				'default' => '',
				'help' => 'This is displayed before the breadcrumb item title.',
			),
			'title_after' => array(
				'type' => 'text',
				'title' => 'Title After',
				'default' => '',
				'help' => 'This is displayed after the breadcrumb item title.',
			),
			'min_items' => array(
				'type' => 'text',
				'title' => 'Min Items',
				'default' => 2,
				'help' => 'Determines the minimum number of items, required to display the breadcrumb trail.',
			),
			'last_item_link' => array(
				'type' => 'checkbox',
				'title' => 'Last Item Link',
				'default' => true,
				'help' => 'Whether the last breadcrumb item should be a link.',
			),
			'display_home_item' => array(
				'type' => 'checkbox',
				'title' => 'Display Home Item?',
				'default' => true,
				'help' => 'Whether the home breadcrumb item should be displayed.',
			),
			'home_item_title' => array(
				'type' => 'text',
				'title' => 'Home Item Title',
				'default' => __('Home', 'crb'),
				'help' => 'Determines the title of the home item.',
			),
		);
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

		// register fields
		$field_data = self::get_field_data();
		foreach ($field_data as $field_id => $field) {
			$this->fields[] = Carbon_Breadcrumb_Admin_Settings_Field::factory($field['type'], 'carbon_breadcrumbs_' . $field_id, $field['title'], self::get_page_name());
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