<?php
/**
 * Term breadcrumb item
 *
 * @package carbon-breadcrumbs
 */

/**
 * Breadcrumb item class for taxonomy terms.
 *
 * Used for breadcrumb items that represent a term of any taxonomy.
 */
class Carbon_Breadcrumb_Item_Term extends Carbon_Breadcrumb_Item_DB_Object {

	/**
	 * Term object.
	 *
	 * @access public
	 * @var object
	 */
	public $term_object;

	/**
	 * Configure the title and link URL by using the specified term ID.
	 *
	 * @access public
	 * @throws Carbon_Breadcrumb_Exception When term ID or taxonomy isn't specified.
	 */
	public function setup() {
		// In order to continue, taxonomy term ID must be specified.
		if ( ! $this->get_id() ) {
			throw new Carbon_Breadcrumb_Exception( 'The term breadcrumb items must have term ID specified.' );
		}

		// In order to continue, taxonomy must be specified.
		if ( ! $this->get_subtype() ) {
			throw new Carbon_Breadcrumb_Exception( 'The term breadcrumb items must have taxonomy specified.' );
		}

		// Retrieve term object.
		$subtype           = $this->get_subtype();
		$this->term_object = get_term_by( 'id', $this->get_id(), $subtype );

		parent::setup();
	}

	/**
	 * Setup the title of this item.
	 *
	 * @access public
	 */
	public function setup_title() {
		$filter_name = 'single_term_title';
		if ( 'category' === $this->term_object->taxonomy ) {
			$filter_name = 'single_cat_title';
		} elseif ( 'post_tag' === $this->term_object->taxonomy ) {
			$filter_name = 'single_tag_title';
		}

		$title = apply_filters( $filter_name, $this->term_object->name );
		$this->set_title( $title );
	}

	/**
	 * Setup the link of this item.
	 *
	 * @access public
	 */
	public function setup_link() {
		$link = get_term_link( $this->term_object->term_id, $this->term_object->taxonomy );
		$this->set_link( $link );
	}

}
