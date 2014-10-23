<?php
/**
 * Breadcrumb item class for taxonomy terms.
 * 
 * Used for breadcrumb items that represent a term of any taxonomy.
 */
class Carbon_Breadcrumb_Item_Term extends Carbon_Breadcrumb_Item implements Carbon_Breadcrumb_DB_Object {

	/**
	 * ID of the taxonomy term, associated with this breadcrumb item.
	 *
	 * @access private
	 * @var int
	 */
	private $id = 0;

	/**
	 * Configure the title and link URL by using the specified term ID.
	 *
	 * @access public
	 */
	function setup() {
		// in order to continue, taxonomy term ID must be specified
		if (!$this->get_id()) {
			throw new Carbon_Breadcrumb_Exception('The term breadcrumb items must have term ID specified.');
		}

		$subtype = $this->get_locator()->get_subtype();
		$term = get_term_by('id', $this->get_id(), $subtype);

		// configure title
		$title = apply_filters('the_title', $term->name);
		$this->set_title( $title );

		// configure link URL
		$link = get_term_link($term->term_id, $subtype);
		$this->set_link( $link );
	}

	/**
	 * Retrieve the taxonomy term ID.
	 *
	 * @access public
	 *
	 * @return int $id The ID of the taxonomy term associated with this breadcrumb item.
	 */
	function get_id() {
		return $this->id;
	}

	/**
	 * Modify the ID of the taxonomy term associated with this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param int $id The new taxonomy term ID.
	 */
	function set_id($id = 0) {
		$this->id = $id;
	}

}