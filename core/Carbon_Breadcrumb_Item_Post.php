<?php
/**
 * Breadcrumb item class for posts.
 *
 * Used for breadcrumb items that represent a post of any post type.
 */
class Carbon_Breadcrumb_Item_Post extends Carbon_Breadcrumb_Item_DB_Object {

	/**
	 * Configure the title and link URL by using the specified post ID.
	 *
	 * @access public
	 */
	public function setup() {
		// in order to continue, post ID must be specified
		if ( ! $this->get_id() ) {
			throw new Carbon_Breadcrumb_Exception( 'The post breadcrumb items must have post ID specified.' );
		}

		parent::setup();
	}

	/**
	 * Setup the title of this item.
	 *
	 * @access public
	 */
	public function setup_title() {
		$title = get_post_field( 'post_title', $this->get_id() );
		$title = apply_filters( 'the_title', $title, $this->get_id() );
		$this->set_title( $title );
	}

	/**
	 * Setup the link of this item.
	 *
	 * @access public
	 */
	public function setup_link() {
		$link = get_permalink( $this->get_id() );
		$this->set_link( $link );
	}

}