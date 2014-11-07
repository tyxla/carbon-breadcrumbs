<?php
/**
 * Breadcrumb item class for author archives.
 * 
 * Used for breadcrumb items that represent a certain author archive page.
 */
class Carbon_Breadcrumb_Item_User extends Carbon_Breadcrumb_Item implements Carbon_Breadcrumb_DB_Object {

	/**
	 * ID of the author user, associated with this breadcrumb item.
	 *
	 * @access protected
	 * @var int
	 */
	protected $id = 0;

	/**
	 * Configure the title and link URL by using the specified author user ID.
	 *
	 * @access public
	 */
	function setup() {
		// in order to continue, author user ID must be specified
		if (!$this->get_id()) {
			throw new Carbon_Breadcrumb_Exception('The author breadcrumb items must have author ID specified.');
		}

		// configure title
		$title = get_the_author_meta('display_name', $this->get_id());
		$title = apply_filters('the_title', $title);
		$this->set_title( $title );

		// configure link URL
		$link = get_author_posts_url($this->get_id());
		$this->set_link( $link );
	}

	/**
	 * Retrieve the author user ID.
	 *
	 * @access public
	 *
	 * @return int $id The ID of the author user associated with this breadcrumb item.
	 */
	function get_id() {
		return $this->id;
	}

	/**
	 * Modify the ID of the author user associated with this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param int $id The new author user ID.
	 */
	function set_id($id = 0) {
		$this->id = $id;
	}

}