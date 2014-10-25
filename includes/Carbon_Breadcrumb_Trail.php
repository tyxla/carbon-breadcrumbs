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
	 * @access private
	 * @var array
	 */
	private $items = array();

	/**
	 * String used between the breadcrumb items when displaying the breadcrumbs.
	 *
	 * @access private
	 * @var string
	 */
	private $glue = '';

	/**
	 * String before the opening link tag.
	 *
	 * @access private
	 * @var string
	 */
	private $link_before = '';

	/**
	 * String after the closing link tag.
	 *
	 * @access private
	 * @var string
	 */
	private $link_after = '';

	/**
	 * String before all breadcrumb items.
	 *
	 * @access private
	 * @var string
	 */
	private $wrapper_before = '';

	/**
	 * String after all breadcrumb items.
	 *
	 * @access private
	 * @var string
	 */
	private $wrapper_after = '';

	/**
	 * String before the title of a breadcrumb item.
	 *
	 * @access private
	 * @var string
	 */
	private $title_before = '';

	/**
	 * String before the title of a breadcrumb item.
	 *
	 * @access private
	 * @var string
	 */
	private $title_after = '';

	/**
	 * Minimum items necessary to display the breadcrumb trail.
	 *
	 * @access private
	 * @var int
	 */
	private $min_items = 2;

	/**
	 * Constructor.
	 *
	 * Creates and configures a new breadcrumb trail with the provided settings.
	 *
	 * @access public
	 *
	 * @param string $glue String used between the breadcrumb items when displaying the breadcrumbs. 
	 * @param string $link_before String before the opening link tag of a breadcrumb item.
	 * @param string $link_after String after the closing link tag of a breadcrumb item.
	 * @param string $wrapper_before String before all breadcrumb items.
	 * @param string $wrapper_after String after all breadcrumb items.
	 * @param string $title_before String before the breadcrumb item title.
	 * @param string $title_after String after the breadcrumb item title.
	 * @return Carbon_Breadcrumb_Trail
	 */
	function __construct($glue = ' &gt; ', $link_before = '', $link_after = '', $wrapper_before = '', $wrapper_after = '', $title_before = '', $title_after = '') {

		// configure settings
		$this->set_glue($glue);
		$this->set_link_before($link_before);
		$this->set_link_after($link_after);
		$this->set_wrapper_before($wrapper_before);
		$this->set_wrapper_after($wrapper_after);
		$this->set_title_before($title_before);
		$this->set_title_after($title_after);

		// schedule sorting of all items after they are created
		add_action('carbon_breadcrumb_after_setup_trail', array($this, 'sort_items'), 999);

	}

	/**
	 * Populate the breadcrumb items for the current context.
	 *
	 * @access public
	 */
	function setup() {

		// starting setup
		do_action('carbon_breadcrumb_before_setup_trail', $this);

		// process post types, terms, authors
		$locators = array(
			'post',
			'term',
			'user'
		);
		foreach ($locators as $locator_name) {
			$locator = Carbon_Breadcrumb_Locator::factory($locator_name);
			$items = $locator->generate_items();
			if ($items) {
				$this->add_item($items);	
			}
		}

		// process date archives
		if (is_date()) {
			$locator = Carbon_Breadcrumb_Locator::factory('date');
			$items = $locator->get_items(700);
			if ($items) {
				$this->add_item($items);
			}
		}

		// process search results
		if (is_search()) {
			$search_title = sprintf(__('Search results for: "%1$s"', 'crb'), get_search_query());
			$this->add_custom_item($search_title, '', 700);
		}

		// process 404 not found
		if (is_404()) {
			$not_found_title = __('Error 404 - Not Found', 'crb');
			$this->add_custom_item($not_found_title, '', 700);
		}

		// process page for posts where necessary
		if (is_home() || is_archive() || is_search() || (is_single() && get_post_type() == 'post') ) {
			if ($page_for_posts = get_option('page_for_posts')) {
				$locator = Carbon_Breadcrumb_Locator::factory('post', 'page');
				$items = $locator->get_items(500, $page_for_posts);
				if ($items) {
					$this->add_item($items);	
				}
			}
		}

		// add home item
		if (!is_front_page()) {
			$front_page_id = get_option('page_on_front');
			if ($front_page_id) {
				$home_title = get_the_title($front_page_id);
				$home_link = get_permalink($front_page_id);
			} else {
				$home_title = __('Home', 'crb');
				$home_link = home_url('/');
			}
			
			$this->add_custom_item($home_title, $home_link, 10);
		}

		// completing setup
		do_action('carbon_breadcrumb_after_setup_trail', $this);

	}

	/**
	 * Add a single Carbon_Breadcrumb_Item or an array of them to the trail.
	 *
	 * @access public
	 *
	 * @param mixed $item The item or array of items to add.
	 */
	function add_item($item) {
		if (is_array($item)) {
			foreach ($item as $single_item) {
				$this->add_item($single_item);
			}
		} else {
			$priority = $item->get_priority();
			$this->items[$priority][] = $item;
		}
	}

	/**
	 * Retrieve the breadcrumb items that are currently loaded.
	 *
	 * @access public
	 *
	 * @return array $items The breadcrumb items, contained in the trail.
	 */
	function get_items() {
		return $this->items;
	}

	/**
	 * Modify the currently loaded breadcrumb items.
	 *
	 * @access public
	 *
	 * @param array $items The new set of breadcrumb items.
	 */
	function set_items($items = array()) {
		$this->items = $items;
	}

	/**
	 * Retrieve the string, used for concatenating the breadcrumb items.
	 *
	 * @access public
	 *
	 * @return string $glue String, used for concatenating the breadcrumb items.
	 */
	function get_glue() {
		return $this->glue;
	}

	/**
	 * Modify the string, used for concatenating the breadcrumb items.
	 *
	 * @access public
	 *
	 * @param string $glue String, used for concatenating the breadcrumb items.
	 */
	function set_glue($glue = '') {
		$this->glue = $glue;
	}

	/**
	 * Retrieve the string before the opening link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $link_before String before the opening link tag of a breadcrumb item.
	 */
	function get_link_before() {
		return $this->link_before;
	}

	/**
	 * Modify the string before the opening link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $link_before String before the opening link tag of a breadcrumb item.
	 */
	function set_link_before($link_before = '') {
		$this->link_before = $link_before;
	}

	/**
	 * Retrieve the string after the closing link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $link_after String after the closing link tag of a breadcrumb item.
	 */
	function get_link_after() {
		return $this->link_after;
	}

	/**
	 * Modify the string after the closing link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $link_after String after the closing link tag of a breadcrumb item.
	 */
	function set_link_after($link_after = '') {
		$this->link_after = $link_after;
	}

	/**
	 * Retrieve the string before the breadcrumb items.
	 *
	 * @access public
	 *
	 * @return string $wrapper_before String before the breadcrumb items.
	 */
	function get_wrapper_before() {
		return $this->wrapper_before;
	}

	/**
	 * Modify the string before the breadcrumb items.
	 *
	 * @access public
	 *
	 * @param string $wrapper_before String before the breadcrumb items.
	 */
	function set_wrapper_before($wrapper_before = '') {
		$this->wrapper_before = $wrapper_before;
	}

	/**
	 * Retrieve the string after the breadcrumb items.
	 *
	 * @access public
	 *
	 * @return string $wrapper_after String after the breadcrumb items.
	 */
	function get_wrapper_after() {
		return $this->wrapper_after;
	}

	/**
	 * Modify the string after the breadcrumb items.
	 *
	 * @access public
	 *
	 * @param string $wrapper_after String after the breadcrumb items.
	 */
	function set_wrapper_after($wrapper_after = '') {
		$this->wrapper_after = $wrapper_after;
	}

	/**
	 * Retrieve the string before the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $title_before String before the title of a breadcrumb item.
	 */
	function get_title_before() {
		return $this->title_before;
	}

	/**
	 * Modify the string before the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $title_before String before the title of a breadcrumb item.
	 */
	function set_title_before($title_before = '') {
		$this->title_before = $title_before;
	}

	/**
	 * Retrieve the string after the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $title_after String after the title of a breadcrumb item.
	 */
	function get_title_after() {
		return $this->title_after;
	}

	/**
	 * Modify the string after the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $title_after String after the title of a breadcrumb item.
	 */
	function set_title_after($title_after = '') {
		$this->title_after = $title_after;
	}

	/**
	 * Retrieve the minimum number of items, necessary to display the trail.
	 *
	 * @access public
	 *
	 * @return int $min_items Minimum number of items, necessary to display the trail
	 */
	function get_min_items() {
		return $this->min_items;
	}

	/**
	 * Modify the minimum number of items, necessary to display the trail.
	 *
	 * @access public
	 *
	 * @param int $min_items Minimum number of items, necessary to display the trail.
	 */
	function set_min_items($min_items) {
		$this->min_items = $min_items;
	}

	/**
	 * Sort the currently loaded breadcrumb items by their priority.
	 *
	 * @access public
	 */
	function sort_items() {
		$items = $this->get_items();
		ksort($items);
		$this->set_items($items);
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
	function add_custom_item($title, $link = '', $priority = 1000) {
		$custom_item = Carbon_Breadcrumb_Item::factory('custom', $priority);
		$custom_item->set_title( $title );
		$custom_item->set_link( $link );
		$custom_item->setup();
		$this->add_item($custom_item);
	}

	/**
	 * Render the breadcrumb trail.
	 *
	 * @access public
	 *
	 * @param bool $return Whether to return the output.
	 * @return string|void $output The output HTML if $return is true.
	 */
	function render($return = false) {
		// if there are no items, or they are less than the minimum, nothing should be rendered
		$all_items = $this->get_items();
		if (!$all_items || count($all_items) < $this->get_min_items()) {
			return;
		}

		$items_output = array();

		// prepare all breadcrumb items for display
		foreach ($all_items as $priority => $items) {
			foreach ($items as $item) {
				$item_output = '';

				// HTML before link opening tag
				$item_output .= $this->get_link_before();

				// link can be optional
				if ($item->get_link()) {
					$item_output .= '<a href="' . $item->get_link() . '">';
				}

				// HTML before title
				$item_output .= $this->get_title_before();

				// breadcrumb item title
				$item_output .= $item->get_title();

				// HTML after title
				$item_output .= $this->get_title_after();

				// link can be optional
				if ($item->get_link()) {
					$item_output .= '</a>';
				}

				// HTML after link closing tag
				$item_output .= $this->get_link_after();

				$items_output[] = $item_output;
			}
		}

		// implode the breadcrumb items and wrap them with the configured wrappers
		$output = $this->get_wrapper_before();
		$output .= implode($this->get_glue(), $items_output);
		$output .= $this->get_wrapper_after();

		if ($return) {
			return $output;
		}

		echo $output;
	}

	/**
	 * Build, setup and display a new breadcrumb trail.
	 *
	 * @static
	 * @access public
	 */
	static function output() {
		$trail = new self(); 
		$trail->setup();
		$trail->render();
	}
	
}