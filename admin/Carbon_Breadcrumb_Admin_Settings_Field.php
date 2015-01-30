<?php
/**
 * Manages breadcrumb administration settings field registration.
 * Should be extended for each field type.
 *
 * @abstract
 */
abstract class Carbon_Breadcrumb_Admin_Settings_Field {

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
	 * @param array $args Additional args.
	 */
	public function __construct($id, $title, $section = '', $args = array()) {

		$this->set_id($id);
		$this->set_title($title);

		add_settings_field( 
			$id,
			$title,
			array($this, 'render'),
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
	 *
	 * @param string $type Type of the field.
	 * @param string $id The ID of the field.
	 * @param string $title The title of the field.
	 * @param string $section The name of the section.
	 * @param array $args Additional args.
	 * @return Carbon_Breadcrumb_Admin_Settings_Field $field
	 */
	static function factory($type, $id, $title, $section = '', $args = array()) {
		$type = str_replace(" ", '', ucwords(str_replace("_", ' ', $type)));

		$class = 'Carbon_Breadcrumb_Admin_Settings_Field_' . $type;

		if (!class_exists($class)) {
			throw new Carbon_Breadcrumb_Exception('Unknown settings field type "' . $type . '".');
		}

		$field = new $class($id, $title, $section, $args);

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
	public function set_title($title) {
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
	public function set_id($id) {
		$this->id = $id;
	}

	/**
	 * Render this field.
	 *
	 * @access public
	 * @abstract
	 */
	abstract public function render();

}