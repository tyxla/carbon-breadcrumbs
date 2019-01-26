<?php
/**
 * Custom breadcrumb item
 *
 * @package carbon-breadcrumbs
 */

/**
 * Custom breadcrumb item class.
 *
 * Used for breadcrumb items with custom title and link.
 */
class Carbon_Breadcrumb_Item_Custom extends Carbon_Breadcrumb_Item {
	/**
	 * Setup this breadcrumb item.
	 *
	 * Custom items don't need a special setup, so we only define an empty method.
	 *
	 * @abstract
	 * @access public
	 */
	public function setup() {
		// Custom breadcrumb items should be setup manually.
	}

}
