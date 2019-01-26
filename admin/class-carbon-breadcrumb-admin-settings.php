<?php
/**
 * Manages breadcrumb administration settings.
 *
 * @package carbon-breadcrumbs
 */

/**
 * Class that manages breadcrumb administration settings.
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
		// Register settings page.
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 30 );

		// Register settings fields & sections.
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
			'glue'              => array(
				'type'    => 'text',
				'title'   => __( 'Glue', 'carbon_breadcrumbs' ),
				'default' => ' > ',
				'help'    => __( 'This is displayed between the breadcrumb items.', 'carbon_breadcrumbs' ),
			),
			'link_before'       => array(
				'type'    => 'text',
				'title'   => __( 'Link Before', 'carbon_breadcrumbs' ),
				'default' => '',
				'help'    => __( 'This is displayed before the breadcrumb item link.', 'carbon_breadcrumbs' ),
			),
			'link_after'        => array(
				'type'    => 'text',
				'title'   => __( 'Link After', 'carbon_breadcrumbs' ),
				'default' => '',
				'help'    => __( 'This is displayed after the breadcrumb item link.', 'carbon_breadcrumbs' ),
			),
			'wrapper_before'    => array(
				'type'    => 'text',
				'title'   => __( 'Wrapper Before', 'carbon_breadcrumbs' ),
				'default' => '',
				'help'    => __( 'This is displayed before displaying the breadcrumb items.', 'carbon_breadcrumbs' ),
			),
			'wrapper_after'     => array(
				'type'    => 'text',
				'title'   => __( 'Wrapper After', 'carbon_breadcrumbs' ),
				'default' => '',
				'help'    => __( 'This is displayed after displaying the breadcrumb items.', 'carbon_breadcrumbs' ),
			),
			'title_before'      => array(
				'type'    => 'text',
				'title'   => __( 'Title Before', 'carbon_breadcrumbs' ),
				'default' => '',
				'help'    => __( 'This is displayed before the breadcrumb item title.', 'carbon_breadcrumbs' ),
			),
			'title_after'       => array(
				'type'    => 'text',
				'title'   => __( 'Title After', 'carbon_breadcrumbs' ),
				'default' => '',
				'help'    => __( 'This is displayed after the breadcrumb item title.', 'carbon_breadcrumbs' ),
			),
			'min_items'         => array(
				'type'    => 'text',
				'title'   => __( 'Min Items', 'carbon_breadcrumbs' ),
				'default' => 2,
				'help'    => __( 'Determines the minimum number of items, required to display the breadcrumb trail.', 'carbon_breadcrumbs' ),
			),
			'last_item_link'    => array(
				'type'    => 'checkbox',
				'title'   => __( 'Last Item Link', 'carbon_breadcrumbs' ),
				'default' => true,
				'help'    => __( 'Whether the last breadcrumb item should be a link.', 'carbon_breadcrumbs' ),
			),
			'display_home_item' => array(
				'type'    => 'checkbox',
				'title'   => __( 'Display Home Item?', 'carbon_breadcrumbs' ),
				'default' => true,
				'help'    => __( 'Whether the home breadcrumb item should be displayed.', 'carbon_breadcrumbs' ),
			),
			'home_item_title'   => array(
				'type'    => 'text',
				'title'   => __( 'Home Item Title', 'carbon_breadcrumbs' ),
				'default' => __( 'Home', 'carbon_breadcrumbs' ),
				'help'    => __( 'Determines the title of the home item.', 'carbon_breadcrumbs' ),
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
		return __( 'Carbon Breadcrumbs', 'carbon_breadcrumbs' );
	}

	/**
	 * Register the settings page & default section.
	 *
	 * @access public
	 */
	public function admin_menu() {

		// Register settings page.
		add_options_page(
			self::get_page_title(),
			self::get_page_title(),
			'manage_options',
			self::get_page_name(),
			array( $this, 'settings_page' )
		);

		// Register settings section.
		add_settings_section(
			self::get_page_name(),
			__( 'General Settings', 'carbon_breadcrumbs' ),
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
		// Register fields.
		$field_data = self::get_field_data();
		foreach ( $field_data as $field_id => $field ) {
			$this->fields[] = Carbon_Breadcrumb_Admin_Settings_Field::factory( $field['type'], 'carbon_breadcrumbs_' . $field_id, $field['title'], self::get_page_name() );
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
			<h2><?php echo esc_html( self::get_page_title() ); ?></h2>
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
