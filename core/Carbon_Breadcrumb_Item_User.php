<?php
/**
 * Breadcrumb item class for author archives.
 * 
 * Used for breadcrumb items that represent a certain author archive page.
 */
class Carbon_Breadcrumb_Item_User extends Carbon_Breadcrumb_Item_DB_Object {

	/**
	 * Configure the title and link URL by using the specified author user ID.
	 *
	 * @access public
	 */
	public function setup() {
		// in order to continue, author user ID must be specified
		if ( ! $this->get_id() ) {
			throw new Carbon_Breadcrumb_Exception( 'The author breadcrumb items must have author ID specified.' );
		}

		parent::setup();
	}

	/**
	 * Setup the title of this item.
	 *
	 * @access public
	 */
	public function setup_title() {
		$title = get_the_author_meta( 'display_name', $this->get_id() );
		$title = apply_filters( 'the_title', $title );
		$this->set_title( $title );
	}

	/**
	 * Setup the link of this item.
	 *
	 * @access public
	 */
	public function setup_link() {
		$link = get_author_posts_url( $this->get_id() );
		$this->set_link( $link );
	}

}