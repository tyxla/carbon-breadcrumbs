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
	protected $renderer;

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
		if ( ! isset( $settings['renderer'] ) ) {
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

		// start setup
		do_action( 'carbon_breadcrumbs_before_setup_trail', $this );

		// perform setup
		new Carbon_Breadcrumb_Trail_Setup( $this );

		// end setup
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
			$priority                   = $item->get_priority();
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
	 * @param int    $priority Breadcrumb item priority.
	 */
	public function add_custom_item( $title, $link = '', $priority = 1000 ) {
		$custom_item = Carbon_Breadcrumb_Item::factory( 'custom', $priority );
		$custom_item->set_title( $title );
		$custom_item->set_link( $link );
		$custom_item->setup();
		$this->add_item( $custom_item );
	}

	/**
	 * Remove an item from the breadcrumb trail by both title and link.
	 *
	 * @access public
	 *
	 * @param string $title Title to remove breadcrumb item by.
	 * @param string $link Link URL to remove breadcrumb item by.
	 */
	public function remove_item( $title = '', $link = '' ) {
		// if both title and link are specified, search for exact match
		$all_items = $this->get_items();
		foreach ( $all_items as $items_priority => $items ) {
			foreach ( $items as $item_key => $item ) {
				if ( 0 === strcasecmp( $item->get_title(), $title ) && 0 === strcasecmp( $item->get_link(), $link ) ) {
					// if we have a match, remove that item
					unset( $all_items[ $items_priority ][ $item_key ] );
				}
			}
		}

		// update the items
		$this->set_items( $all_items );
	}

	/**
	 * Remove an item from the breadcrumb trail by a specified method.
	 *
	 * @access public
	 *
	 * @param string $method Item method to remove breadcrumb item by.
	 * @param string $data Additional data to pass to the method.
	 */
	public function remove_item_by_method( $method, $data ) {
		// search all items for one with the same title
		$all_items = $this->get_items();
		foreach ( $all_items as $priority => $items ) {
			foreach ( $items as $item_key => $item ) {
				$method_result = call_user_func( array( $item, $method ), $data );
				if ( 0 === strcasecmp( $method_result, $data ) ) {
					// if we have a match, remove that item
					unset( $all_items[ $priority ][ $item_key ] );
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
		$this->remove_item_by_method( 'get_title', $title );
	}

	/**
	 * Remove an item from the breadcrumb trail by its link.
	 *
	 * @access public
	 *
	 * @param string $link Link URL to remove breadcrumb item by.
	 */
	public function remove_item_by_link( $link = '' ) {
		$this->remove_item_by_method( 'get_link', $link );
	}

	/**
	 * Remove an item from the breadcrumb trail by its priority.
	 *
	 * @access public
	 *
	 * @param int $priority Priority to remove breadcrumb item by.
	 */
	public function remove_item_by_priority( $priority = 0 ) {
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
	 * Retrieve the breadcrumb items in a flat list.
	 *
	 * @access public
	 *
	 * @return array $flat_items The breadcrumb items, contained in the trail.
	 */
	public function get_flat_items() {
		$flat_items = array();

		foreach ( $this->items as $priority => $items ) {
			$flat_items = array_merge( $flat_items, $items );
		}

		return $flat_items;
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
		$all_items = $this->get_flat_items();
		return count( $all_items );
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

		echo wp_kses( $output, wp_kses_allowed_html( 'post' ) );
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
