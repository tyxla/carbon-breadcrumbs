<?php
/**
 * Database object interface.
 *
 * @package carbon-breadcrumbs
 */

/**
 * Represents an item that corresponds to a database object.
 */
interface Carbon_Breadcrumb_DB_Object {

	/**
	 * Get the database ID of the object.
	 */
	public function get_id();

	/**
	 * Set the database ID of the object.
	 *
	 * @param int $id The database ID of the object.
	 */
	public function set_id( $id = 0 );

}
