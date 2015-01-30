<?php
/**
 * Manages breadcrumb administration settings field registration.
 * Should be extended for each field type.
 *
 * @abstract
 */
abstract class Carbon_Breadcrumb_Admin_Settings_Field {

	/**
	 * Constructor.
	 *
	 * Register an administration breadcrumb settings field.
	 *
	 * @access public
	 */
	public function __construct($id, $title, $section = '', $args = array()) {
		add_settings_field( 
			$id,
			$title,
			array($this, 'render'),
			Carbon_Breadcrumb_Admin_Settings::get_page_name(),
			$section,
			$args
		);
	}

	/**
	 * Render this field.
	 *
	 * @access public
	 * @abstract
	 */
	abstract public function render();

}