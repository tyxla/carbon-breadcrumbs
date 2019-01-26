<?php
/**
 * Breadcrumb item in the database.
 *
 * @package carbon-breadcrumbs
 */

/**
 * Breadcrumb item class for objects from the database.
 *
 * Should be extended by any database object class (for example post, term, user).
 */
abstract class Carbon_Breadcrumb_Item_DB_Object extends Carbon_Breadcrumb_Item implements Carbon_Breadcrumb_DB_Object {

	/**
	 * ID of the object, associated with this breadcrumb item.
	 *
	 * @access protected
	 * @var int
	 */
	protected $id = 0;

	/**
	 * Configure the title and link URL by using the specified post ID.
	 *
	 * @access public
	 */
	public function setup() {
		// Setup item title.
		$this->setup_title();

		// Setup item link.
		$this->setup_link();
	}

	/**
	 * Retrieve the object ID.
	 *
	 * @access public
	 *
	 * @return int $id The ID of the object associated with this breadcrumb item.
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Modify the ID of the object associated with this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param int $id The new object ID.
	 */
	public function set_id( $id = 0 ) {
		$this->id = $id;
	}

	/**
	 * Setup the title of this item.
	 *
	 * @abstract
	 * @access public
	 */
	abstract public function setup_title();

	/**
	 * Setup the link of this item.
	 *
	 * @abstract
	 * @access public
	 */
	abstract public function setup_link();

}
