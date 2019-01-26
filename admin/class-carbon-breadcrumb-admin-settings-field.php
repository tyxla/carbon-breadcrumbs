<?php
/**
 * Main breadcrumb administration settings field registration.
 *
 * @package carbon-breadcrumbs
 */

/**
 * Manages breadcrumb administration settings field registration.
 * Should be extended for each field type.
 *
 * @abstract
 */
abstract class Carbon_Breadcrumb_Admin_Settings_Field extends Carbon_Breadcrumb_Factory {

	/**
	 * Field title.
	 *
	 * @access protected
	 * @var string
	 */
	protected $title;

	/**
	 * Field ID.
	 *
	 * @access protected
	 * @var string
	 */
	protected $id;


	/**
	 * Constructor.
	 *
	 * Register an administration breadcrumb settings field.
	 *
	 * @access public
	 *
	 * @param string $id The ID of the field.
	 * @param string $title The title of the field.
	 * @param string $section The name of the section.
	 * @param array  $args Additional args.
	 */
	public function __construct( $id, $title, $section = '', $args = array() ) {

		$this->set_id( $id );
		$this->set_title( $title );

		add_settings_field(
			$id,
			$title,
			array( $this, 'render' ),
			Carbon_Breadcrumb_Admin_Settings::get_page_name(),
			$section,
			$args
		);

		register_setting( Carbon_Breadcrumb_Admin_Settings::get_page_name(), $id );
	}

	/**
	 * Register a new administration breadcrumb settings field of a certain type.
	 *
	 * @static
	 * @access public
	 *
	 * @param string $type Type of the field.
	 * @param string $id The ID of the field.
	 * @param string $title The title of the field.
	 * @param string $section The name of the section.
	 * @param array  $args Additional args.
	 * @return Carbon_Breadcrumb_Admin_Settings_Field $field
	 */
	public static function factory( $type, $id, $title, $section = '', $args = array() ) {
		$class = self::verify_class_name( __CLASS__ . '_' . $type, 'Unknown settings field type "' . $type . '".' );
		$field = new $class( $id, $title, $section, $args );

		return $field;
	}

	/**
	 * Retrieve the field title.
	 *
	 * @access public
	 *
	 * @return string $title The title of this field.
	 */
	public function get_title() {
		return $this->title;
	}

	/**
	 * Modify the title of this field.
	 *
	 * @access public
	 *
	 * @param string $title The new title.
	 */
	public function set_title( $title ) {
		$this->title = $title;
	}

	/**
	 * Retrieve the field ID.
	 *
	 * @access public
	 *
	 * @return string $id The ID of this field.
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Modify the ID of this field.
	 *
	 * @access public
	 *
	 * @param string $id The new ID.
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}

	/**
	 * Retrieve the field value. If there is no value, use the default one.
	 *
	 * @access public
	 *
	 * @return mixed $value The value of this field.
	 */
	public function get_value() {
		$original_name = str_replace( 'carbon_breadcrumbs_', '', $this->get_id() );
		$field_data    = Carbon_Breadcrumb_Admin_Settings::get_field_data();
		$default       = ! empty( $field_data[ $original_name ]['default'] ) ? $field_data[ $original_name ]['default'] : '';

		$value = get_option( $this->get_id() );
		if ( false === $value ) {
			$value = $default;
		}

		return $value;
	}

	/**
	 * Render the help description of this field.
	 *
	 * @access public
	 */
	public function render_help() {
		$field_data    = Carbon_Breadcrumb_Admin_Settings::get_field_data();
		$original_name = str_replace( 'carbon_breadcrumbs_', '', $this->get_id() );
		$help          = ! empty( $field_data[ $original_name ]['help'] ) ? $field_data[ $original_name ]['help'] : '';
		if ( ! $help ) {
			return;
		}
		?>
		<p class="description"><?php echo esc_html( $help ); ?></p>
		<?php
	}

	/**
	 * Render this field.
	 *
	 * @access public
	 * @abstract
	 */
	abstract public function render();

}
