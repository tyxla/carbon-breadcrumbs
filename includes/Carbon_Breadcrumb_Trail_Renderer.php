<?php
/**
 * The breadcrumb trail render class.
 * 
 * Responsible for the breadcrumb trail rendering settings and process.
 */
class Carbon_Breadcrumb_Trail_Renderer {

	/**
	 * String used between the breadcrumb items when displaying the breadcrumbs.
	 *
	 * @access protected
	 * @var string
	 */
	protected $glue = '';

	/**
	 * String before the opening link tag.
	 *
	 * @access protected
	 * @var string
	 */
	protected $link_before = '';

	/**
	 * String after the closing link tag.
	 *
	 * @access protected
	 * @var string
	 */
	protected $link_after = '';

	/**
	 * String before all breadcrumb items.
	 *
	 * @access protected
	 * @var string
	 */
	protected $wrapper_before = '';

	/**
	 * String after all breadcrumb items.
	 *
	 * @access protected
	 * @var string
	 */
	protected $wrapper_after = '';

	/**
	 * String before the title of a breadcrumb item.
	 *
	 * @access protected
	 * @var string
	 */
	protected $title_before = '';

	/**
	 * String before the title of a breadcrumb item.
	 *
	 * @access protected
	 * @var string
	 */
	protected $title_after = '';

	/**
	 * Minimum items necessary to display the breadcrumb trail.
	 *
	 * @access protected
	 * @var int
	 */
	protected $min_items = 2;

	/**
	 * Whether to display the last item as link.
	 *
	 * @access protected
	 * @var bool
	 */
	protected $last_item_link = true;

	/**
	 * Whether to display the home item.
	 *
	 * @access protected
	 * @var bool
	 */
	protected $display_home_item = true;

	/**
	 * The title of the home item.
	 *
	 * @access protected
	 * @var string
	 */
	protected $home_item_title = '';

	/**
	 * Constructor.
	 *
	 * Creates and configures a new breadcrumb trail with the provided settings.
	 *
	 * @access public
	 *
	 * @param array $args Configuration options to modify the breadcrumb trail output.
	 * @return Carbon_Breadcrumb_Trail
	 */
	public function __construct( $args = array() ) {

		// default configuration options
		$defaults = array(
			'glue' => ' &gt; ',
			'link_before' => '',
			'link_after' => '',
			'wrapper_before' => '',
			'wrapper_after' => '',
			'title_before' => '',
			'title_after' => '',
			'min_items' => 2,
			'last_item_link' => true,
			'display_home_item' => true,
			'home_item_title' => __('Home', 'crb'),
		);

		// allow default options to be filtered
		$defaults = apply_filters('carbon_breadcrumbs_renderer_default_options', $defaults);

		// parse configuration options
		$args = wp_parse_args( $args, $defaults );

		// set configuration options
		foreach ($args as $arg_name => $arg_value) {
			$method = 'set_' . $arg_name;
			if (array_key_exists($arg_name, $defaults) && method_exists($this, $method)) {
				call_user_func(array($this, $method), $arg_value);
			}
		}

	}

	/**
	 * Retrieve the string, used for concatenating the breadcrumb items.
	 *
	 * @access public
	 *
	 * @return string $glue String, used for concatenating the breadcrumb items.
	 */
	public function get_glue() {
		return $this->glue;
	}

	/**
	 * Modify the string, used for concatenating the breadcrumb items.
	 *
	 * @access public
	 *
	 * @param string $glue String, used for concatenating the breadcrumb items.
	 */
	public function set_glue($glue = '') {
		$this->glue = $glue;
	}

	/**
	 * Retrieve the string before the opening link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $link_before String before the opening link tag of a breadcrumb item.
	 */
	public function get_link_before() {
		return $this->link_before;
	}

	/**
	 * Modify the string before the opening link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $link_before String before the opening link tag of a breadcrumb item.
	 */
	public function set_link_before($link_before = '') {
		$this->link_before = $link_before;
	}

	/**
	 * Retrieve the string after the closing link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $link_after String after the closing link tag of a breadcrumb item.
	 */
	public function get_link_after() {
		return $this->link_after;
	}

	/**
	 * Modify the string after the closing link tag of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $link_after String after the closing link tag of a breadcrumb item.
	 */
	public function set_link_after($link_after = '') {
		$this->link_after = $link_after;
	}

	/**
	 * Retrieve the string before the breadcrumb items.
	 *
	 * @access public
	 *
	 * @return string $wrapper_before String before the breadcrumb items.
	 */
	public function get_wrapper_before() {
		return $this->wrapper_before;
	}

	/**
	 * Modify the string before the breadcrumb items.
	 *
	 * @access public
	 *
	 * @param string $wrapper_before String before the breadcrumb items.
	 */
	public function set_wrapper_before($wrapper_before = '') {
		$this->wrapper_before = $wrapper_before;
	}

	/**
	 * Retrieve the string after the breadcrumb items.
	 *
	 * @access public
	 *
	 * @return string $wrapper_after String after the breadcrumb items.
	 */
	public function get_wrapper_after() {
		return $this->wrapper_after;
	}

	/**
	 * Modify the string after the breadcrumb items.
	 *
	 * @access public
	 *
	 * @param string $wrapper_after String after the breadcrumb items.
	 */
	public function set_wrapper_after($wrapper_after = '') {
		$this->wrapper_after = $wrapper_after;
	}

	/**
	 * Retrieve the string before the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $title_before String before the title of a breadcrumb item.
	 */
	public function get_title_before() {
		return $this->title_before;
	}

	/**
	 * Modify the string before the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $title_before String before the title of a breadcrumb item.
	 */
	public function set_title_before($title_before = '') {
		$this->title_before = $title_before;
	}

	/**
	 * Retrieve the string after the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $title_after String after the title of a breadcrumb item.
	 */
	public function get_title_after() {
		return $this->title_after;
	}

	/**
	 * Modify the string after the title of a breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $title_after String after the title of a breadcrumb item.
	 */
	public function set_title_after($title_after = '') {
		$this->title_after = $title_after;
	}

	/**
	 * Retrieve the minimum number of items, necessary to display the trail.
	 *
	 * @access public
	 *
	 * @return int $min_items Minimum number of items, necessary to display the trail
	 */
	public function get_min_items() {
		return $this->min_items;
	}

	/**
	 * Modify the minimum number of items, necessary to display the trail.
	 *
	 * @access public
	 *
	 * @param int $min_items Minimum number of items, necessary to display the trail.
	 */
	public function set_min_items($min_items) {
		$this->min_items = $min_items;
	}

	/**
	 * Whether the last item will be displayed as a link.
	 *
	 * @access public
	 *
	 * @return bool $last_item_link Whether the last item will be displayed as a link.
	 */
	public function get_last_item_link() {
		return (bool)$this->last_item_link;
	}

	/**
	 * Change whether the last item will be displayed as a link.
	 *
	 * @access public
	 *
	 * @param bool $last_item_link Whether the last item will be displayed as a link.
	 */
	public function set_last_item_link($last_item_link) {
		$this->last_item_link = (bool)$last_item_link;
	}

	/**
	 * Whether the home item will be displayed.
	 *
	 * @access public
	 *
	 * @return bool $display_home_item Whether the home item will be displayed.
	 */
	public function get_display_home_item() {
		return (bool)$this->display_home_item;
	}

	/**
	 * Change whether the home item will be displayed.
	 *
	 * @access public
	 *
	 * @param bool $display_home_item Whether the home item will be displayed.
	 */
	public function set_display_home_item($display_home_item) {
		$this->display_home_item = (bool)$display_home_item;
	}

	/**
	 * Retrieve the title of the home item.
	 *
	 * @access public
	 *
	 * @return string $home_item_title The title of the home item.
	 */
	public function get_home_item_title() {
		return $this->home_item_title;
	}

	/**
	 * Modify the title of the home item.
	 *
	 * @access public
	 *
	 * @param string $home_item_title The title of the home item.
	 */
	public function set_home_item_title($home_item_title = '') {
		$this->home_item_title = $home_item_title;
	}

	/**
	 * Render the given breadcrumb trail.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Trail $trail The trail object.
	 * @param bool $return Whether to return the output.
	 * @return string|void $output The output HTML if $return is true.
	 */
	public function render(Carbon_Breadcrumb_Trail $trail, $return = false) {
		$total_items = $trail->get_total_items();

		// if the items are less than the minimum, nothing should be rendered
		if ( $total_items < $this->get_min_items() ) {
			return;
		}

		$items_output = array();
		$counter = 0;

		// last chance to modify render settings before rendering
		do_action('carbon_breadcrumbs_before_render', $this);

		// whether to auto-sort the items
		$auto_sort = apply_filters('carbon_breadcrumbs_auto_sort_items', true);
		if ($auto_sort) {
			$trail->sort_items();
		}

		// prepare all breadcrumb items for display
		$all_items = $trail->get_items();
		foreach ($all_items as $priority => $items) {
			foreach ($items as $item) {
				$counter++;

				// allow each item to be filtered right before rendering
				$item = apply_filters('carbon_breadcrumbs_item', $item);

				$item_output = '';

				// get the item link
				$item_link = apply_filters('carbon_breadcrumbs_item_link', $item->get_link(), $item);

				// get the item attributes
				$item_attributes = apply_filters('carbon_breadcrumbs_item_attributes', $item->get_attributes(), $item);

				// prepare the item attributes
				$attributes_html = '';
				foreach ($item_attributes as $attr => $attr_value) {
					$attributes_html .= ' ' . $attr . '="' . esc_attr($attr_value) . '"';
				}

				// HTML before link opening tag
				$item_output .= $this->get_link_before();

				// link can be optional
				if ($item_link) {
					// last item link can be disabled
					if ($this->get_last_item_link() || $counter < $total_items) {
						$item_output .= '<a href="' . $item_link . '"' . $attributes_html . '>';
					}
				}

				// HTML before title
				$item_output .= $this->get_title_before();

				// breadcrumb item title
				$item_output .= apply_filters('carbon_breadcrumbs_item_title', $item->get_title(), $item);

				// HTML after title
				$item_output .= $this->get_title_after();

				// link can be optional
				if ($item_link) {
					// last item link can be disabled
					if ($this->get_last_item_link() || $counter < $total_items) {
						$item_output .= '</a>';
					}
				}

				// HTML after link closing tag
				$item_output .= $this->get_link_after();

				// allow item output to be filtered
				$item_output = apply_filters('carbon_breadcrumbs_item_output', $item_output, $item);

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
	
}