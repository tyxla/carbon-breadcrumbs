<?php
/**
 * Breadcrumb item class for posts.
 * 
 * Used for breadcrumb items that represent a post of any post type.
 */
class Carbon_Breadcrumb_Item_Post extends Carbon_Breadcrumb_Item implements Carbon_Breadcrumb_DB_Object {

	/**
	 * ID of the post, associated with this breadcrumb item.
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
		// in order to continue, post ID must be specified
		if (!$this->get_id()) {
			throw new Carbon_Breadcrumb_Exception('The post breadcrumb items must have post ID specified.');
		}

		// configure title
		$title = get_post_field('post_title', $this->get_id());
		$title = apply_filters('the_title', $title);
		$this->set_title( $title );

		// configure link URL
		$link = get_permalink($this->get_id());
		$this->set_link( $link );
	}

	/**
	 * Retrieve the post ID.
	 *
	 * @access public
	 *
	 * @return int $id The ID of the post associated with this breadcrumb item.
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Modify the ID of the post associated with this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param int $id The new post ID.
	 */
	public function set_id($id = 0) {
		$this->id = $id;
	}

}