<?php
/**
 * Abstract breadcrumb item locator class for hierarchical types.
 *
 * Used as a base for taxonomy, post type and other hierarchical locators.
 */
abstract class Carbon_Breadcrumb_Locator_Hierarchical extends Carbon_Breadcrumb_Locator {

	/**
	 * Retrieve the items, found by this locator.
	 *
	 * @access public
	 *
	 * @param int $id The object ID, used to go up the item tree.
	 * @param int $priority The priority of the located items.
	 * @return array $items The items hierarchy.
	 */
	public function get_item_hierarchy( $id, $priority ) {
		$items = array();

		do {
			$item = Carbon_Breadcrumb_Item::factory( $this->get_type(), $priority );
			$item->set_id( $id );
			$item->set_subtype( $this->get_subtype() );
			$item->setup();

			$items[] = $item;

			$id = $this->get_parent_id( $id );
		} while ( $id );

		return array_reverse( $items );
	}

	/**
	 * Get the parent ID of a specific item ID
	 *
	 * @access public
	 *
	 * @param int $id The ID of the item to retrieve the parent of.
	 */
	abstract public function get_parent_id( $id );

}