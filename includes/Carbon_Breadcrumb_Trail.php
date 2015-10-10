<?php
/**
 * The main breadcrumb trail class.
 * 
 * Contains and manages the breadcrumb trail settings and breadcrumb items.
 */
class Carbon_Breadcrumb_Trail {

	/**
	 * Breadcrumb items.
	 *
	 * @access protected
	 * @var array
	 */
	protected $items = array();

	/**
	 * Breadcrumb trail renderer.
	 *
	 * @access protected
	 * @var Carbon_Breadcrumb_Trail_Renderer
	 */
	protected $renderer = array();

	/**
	 * Constructor.
	 *
	 * Creates and configures a new breadcrumb trail with the provided settings.
	 *
	 * @access public
	 *
	 * @param array $settings Configuration options to modify the breadcrumb trail output.
	 */
	public function __construct( $settings = array() ) {

		// make sure renderer is specified
		if ( ! isset($settings['renderer'] ) ) {
			$settings['renderer'] = 'Carbon_Breadcrumb_Trail_Renderer';
		}

		// determine the renderer class
		$renderer_class = apply_filters( 'carbon_breadcrumbs_renderer_class', $settings['renderer'] );

		// build a new renderer
		$renderer = new $renderer_class( $settings );

		// set the renderer
		$this->set_renderer( $renderer );
	}

	/**
	 * Retrieve the renderer object.
	 *
	 * @access public
	 *
	 * @return Carbon_Breadcrumb_Trail_Renderer $renderer The renderer object.
	 */
	public function get_renderer() {
		return $this->renderer;
	}

	/**
	 * Modify the rendering object.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Trail_Renderer $renderer The modified rendering object.
	 */
	public function set_renderer( Carbon_Breadcrumb_Trail_Renderer $renderer ) {
		$this->renderer = $renderer;
	}

	/**
	 * Populate the breadcrumb items for the current context.
	 *
	 * @access public
	 */
	public function setup() {

		// starting setup
		do_action( 'carbon_breadcrumbs_before_setup_trail', $this );

		// process post types, terms, authors
		$locators = array(
			'post',
			'term',
			'user'
		);
		foreach ( $locators as $locator_name ) {
			$locator = Carbon_Breadcrumb_Locator::factory( $locator_name );
			$items = $locator->generate_items();
			if ( $items ) {
				$this->add_item( $items );	
			}
		}

		// process date archives
		if ( is_date() ) {
			$locator = Carbon_Breadcrumb_Locator::factory( 'date' );
			$items = $locator->get_items( 700 );
			if ( $items ) {
				$this->add_item( $items );
			}
		}

		// process search results
		if ( is_search() ) {
			$search_title = sprintf( __( 'Search results for: "%1$s"', 'carbon_breadcrumbs' ), get_search_query() );
			$this->add_custom_item( $search_title, '', 700 );
		}

		// process 404 not found
		if (is_404()) {
			$not_found_title = __( 'Error 404 - Not Found', 'carbon_breadcrumbs' );
			$this->add_custom_item( $not_found_title, '', 700 );
		}

		// add category hierarchy for single posts
		if ( is_single() && get_post_type() == 'post' ) {
			$taxonomy = 'category';
			$categories = wp_get_object_terms( get_the_ID(), $taxonomy, 'orderby=term_id' );
			$last_category = array_pop( $categories );
			$locator = Carbon_Breadcrumb_Locator::factory( 'term', $taxonomy );
			$items = $locator->get_items( 700, $last_category->term_id );
			if ( $items ) {
				$this->add_item( $items );
			}
		}

		// process page for posts where necessary
		if ( is_home() || is_category() || is_tag() || is_date() || is_author() || ( is_single() && get_post_type() == 'post' ) ) {
			if ( $page_for_posts = get_option( 'page_for_posts' ) ) {
				$locator = Carbon_Breadcrumb_Locator::factory( 'post', 'page' );
				$items = $locator->get_items( 500, $page_for_posts );
				if ( $items ) {
					$this->add_item( $items );
				}
			}
		}

		// add home item (if enabled)
		if ( $this->get_renderer()->get_display_home_item() ) {
			$home_title = $this->get_renderer()->get_home_item_title();
			$home_link = home_url( '/' );
			$this->add_custom_item( $home_title, $home_link, 10 );
		}

		// completing setup
		do_action( 'carbon_breadcrumbs_after_setup_trail', $this );

	}

	/**
	 * Add a single Carbon_Breadcrumb_Item or an array of them to the trail.
	 *
	 * @access public
	 *
	 * @param mixed $item The item or array of items to add.
	 */
	public function add_item( $item ) {
		if ( is_array( $item ) ) {
			foreach ( $item as $single_item ) {
				$this->add_item( $single_item );
			}
		} else {
			$priority = $item->get_priority();
			$this->items[ $priority ][] = $item;
		}
	}

	/**
	 * Add a custom breadcrumb item to the trail.
	 *
	 * @access public
	 *
	 * @param string $title Breadcrumb item title.
	 * @param string $link Breadcrumb item link.
	 * @param int $priority Breadcrumb item priority.
	 */
	public function add_custom_item( $title, $link = '', $priority = 1000 ) {
		$custom_item = Carbon_Breadcrumb_Item::factory( 'custom', $priority );
		$custom_item->set_title( $title );
		$custom_item->set_link( $link );
		$custom_item->setup();
		$this->add_item( $custom_item );
	}

	/**
	 * Remove an item from the breadcrumb trail by either link or title, or both.
	 *
	 * @access public
	 *
	 * @param string $title Title to remove breadcrumb item by.
	 * @param string $link Link URL to remove breadcrumb item by.
	 */
	public function remove_item( $title = '', $link = '' ) {
		// if there is nothing specified, skip
		if ( ! $title && ! $link ) {
			return;
		}

		// if no link is specified, use remove_item_by_title()
		if ( $title && ! $link ) {
			$this->remove_item_by_title( $title );
			return;
		}

		// if no title is specified, use remove_item_by_link()
		if ( ! $title && $link ) {
			$this->remove_item_by_link( $link );
			return;
		}

		// if both title and link are specified, search for exact match
		$all_items = $this->get_items();
		foreach ( $all_items as $items_priority => $items ) {
			foreach ( $items as $item_key => $item ) {
				if ( strcasecmp( $item->get_title(), $title ) === 0 && strcasecmp( $item->get_link(), $link ) === 0 ) {
					// if we have a match, remove that item
					unset( $all_items[ $items_priority ][ $item_key ] );
				}
			}
		}

		// update the items
		$this->set_items( $all_items );
	}

	/**
	 * Remove an item from the breadcrumb trail by its title.
	 *
	 * @access public
	 *
	 * @param string $title Title to remove breadcrumb item by.
	 */
	public function remove_item_by_title( $title = '' ) {
		// if there is no title specified, skip
		if ( ! $title ) {
			return;
		}

		// search all items for one with the same title
		$all_items = $this->get_items();
		foreach ( $all_items as $priority => $items ) {
			foreach ( $items as $item_key => $item ) {
				if ( strcasecmp( $item->get_title(), $title ) === 0 ) {
					// if we have a match, remove that item
					unset( $all_items[ $priority ][ $item_key ] );
				}
			}
		}

		// update the items
		$this->set_items( $all_items );
	}

	/**
	 * Remove an item from the breadcrumb trail by its link.
	 *
	 * @access public
	 *
	 * @param string $link Link URL to remove breadcrumb item by.
	 */
	public function remove_item_by_link( $link = '' ) {
		// if there is no link specified, skip
		if ( ! $link ) {
			return;
		}

		// search all items for one with the same link
		$all_items = $this->get_items();
		foreach ( $all_items as $priority => $items ) {
			foreach ( $items as $item_key => $item ) {
				if ( strcasecmp( $item->get_link(), $link ) == 0 ) {
					// if we have a match, remove that item
					unset( $all_items[ $priority ][ $item_key ] );
				}
			}
		}

		// update the items
		$this->set_items( $all_items );
	}

	/**
	 * Remove an item from the breadcrumb trail by its priority.
	 *
	 * @access public
	 *
	 * @param int $priority Priority to remove breadcrumb item by.
	 */
	public function remove_item_by_priority( $priority = 0 ) {
		// if there is no priority specified, skip
		if ( ! $priority ) {
			return;
		}

		// search all items for the same priority
		$all_items = $this->get_items();
		if ( array_key_exists( $priority, $all_items ) ) {
			// remove all items with that priority
			unset( $all_items[ $priority ] );
		}

		// update the items
		$this->set_items( $all_items );
	}

	/**
	 * Retrieve the breadcrumb items that are currently loaded.
	 *
	 * @access public
	 *
	 * @return array $items The breadcrumb items, contained in the trail.
	 */
	public function get_items() {
		return $this->items;
	}

	/**
	 * Modify the currently loaded breadcrumb items.
	 *
	 * @access public
	 *
	 * @param array $items The new set of breadcrumb items.
	 */
	public function set_items( $items = array() ) {
		$this->items = $items;
	}

	/**
	 * Sort the currently loaded breadcrumb items by their priority.
	 *
	 * @access public
	 */
	public function sort_items() {
		$items = $this->get_items();
		ksort( $items );
		$this->set_items( $items );
	}

	/**
	 * Retrieve the total number of breadcrumb items in the trail.
	 *
	 * @access public
	 *
	 * @return int $total_items Number of items in the breadcrumb trail.
	 */
	public function get_total_items() {
		$total = 0;
		$all_items = $this->get_items();
		foreach ( $all_items as $priority => $items ) {
			$total += count( $items );
		}
		return $total;
	}

	/**
	 * Render the breadcrumb trail.
	 *
	 * @access public
	 *
	 * @param bool $return Whether to return the output.
	 * @return string|void $output The output HTML if $return is true.
	 */
	public function render( $return = false ) {

		// get the rendered output
		$output = $this->get_renderer()->render( $this, true );

		if ( $return ) {
			return $output;
		}

		echo $output;
	}

	/**
	 * Build, setup and display a new breadcrumb trail.
	 *
	 * @static
	 * @access public
	 *
	 * @param array $args Configuration options to modify the breadcrumb trail output.
	 */
	public static function output( $args = array() ) {
		$trail = new self( $args );
		$trail->setup();
		$trail->render();
	}
	
}