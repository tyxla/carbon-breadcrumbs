<?php
/**
 * Post breadcrumb item locator class.
 * 
 * Used to locate the breadcrumb items for post types.
 */
class Carbon_Breadcrumb_Locator_Post extends Carbon_Breadcrumb_Locator_Hierarchical {

	/**
	 * Whether this the items of this locator should be included in the trail.
	 *
	 * @access public
	 *
	 * @return bool $is_included Whether the found items should be included.
	 */
	public function is_included() {
		return is_singular() && get_post_type() == $this->get_subtype();
	}

	/**
	 * Retrieve the items, found by this locator.
	 *
	 * @access public
	 *
	 * @param int $priority The priority of the located items.
	 * @param int $post_id The post ID, used to go up the post type tree.
	 * @return array $items The items, found by this locator.
	 */
	public function get_items( $priority = 1000, $post_id = 0 ) {
		$items = array();

		// get the current post ID, if not specified
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// if this is the front page, skip it, as it is added separately
		if ( is_front_page() && $post_id == get_option( 'page_on_front' ) ) {
			return array();
		}

		// walk the tree of ancestors of the post up to the top
		return $this->get_item_hierarchy( $post_id, $priority );
	}

	/**
	 * Generate a set of breadcrumb items that found by this locator type and any subtype.
	 * Will generate all necessary breadcrumb items of all post types.
	 *
	 * @access public
	 *
	 * @return array $items The items, generated by this locator.
	 */
	public function generate_items() {
		$post_types = get_post_types( array(
			'public' => true,
		) );
		
		return $this->generate_items_for_subtypes( $post_types );
	}

	/**
	 * Get the parent ID of a specific post ID
	 *
	 * @access public
	 *
	 * @param int $id The ID of the post to retrieve the parent of.
	 * @return int $parent The parent ID.
	 */
	public function get_parent_id( $id ) {
		return get_post_field( 'post_parent', $id ); 
	}
	
}