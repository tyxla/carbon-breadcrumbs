<?php
/**
 * Breadcrumb item renderer.
 *
 * @package carbon-breadcrumbs
 */

/**
 * Breadcrumb item renderer class.
 *
 * Used to render a particular item of the breadcrumb trail.
 */
class Carbon_Breadcrumb_Item_Renderer {

	/**
	 * The item to render.
	 *
	 * @access protected
	 * @var Carbon_Breadcrumb_Item
	 */
	protected $item;

	/**
	 * The trail object this item belongs to.
	 *
	 * @access protected
	 * @var Carbon_Breadcrumb_Trail
	 */
	protected $trail;

	/**
	 * The trail renderer.
	 *
	 * @access protected
	 * @var Carbon_Breadcrumb_Trail_Renderer
	 */
	protected $trail_renderer;

	/**
	 * Index of this item among the rest of the items, zero-based.
	 *
	 * @access protected
	 * @var int
	 */
	protected $index = 0;

	/**
	 * Constructor.
	 *
	 * Creates and configures a new breadcrumb item renderer.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Item           $item The item to render.
	 * @param Carbon_Breadcrumb_Trail          $trail The trail this item belongs to.
	 * @param Carbon_Breadcrumb_Trail_Renderer $trail_renderer The trail renderer.
	 * @param int                              $index Index of this item.
	 */
	public function __construct( Carbon_Breadcrumb_Item $item, Carbon_Breadcrumb_Trail $trail, Carbon_Breadcrumb_Trail_Renderer $trail_renderer, $index = 0 ) {
		$this->set_item( $item );
		$this->set_trail( $trail );
		$this->set_trail_renderer( $trail_renderer );
		$this->set_index( $index );
	}

	/**
	 * Render the item.
	 *
	 * @access public
	 *
	 * @return string $item_output The HTML of this item.
	 */
	public function render() {
		$item_output    = '';
		$item           = $this->get_item();
		$index          = $this->get_index();
		$trail          = $this->get_trail();
		$trail_renderer = $this->get_trail_renderer();

		// Link before and opening <a>.
		$item_output .= $this->render_link_before();

		// Title along with its wrappers.
		$item_output .= $this->render_title();

		// Closing </a> and link after.
		$item_output .= $this->render_link_after();

		// Allow item output to be filtered.
		return apply_filters( 'carbon_breadcrumbs_item_output', $item_output, $item, $trail, $trail_renderer, $index );
	}

	/**
	 * Retrieve the item link URL.
	 *
	 * @access public
	 *
	 * @return string $item_link The link URL of this item.
	 */
	public function get_item_link() {
		$item      = $this->get_item();
		$item_link = apply_filters( 'carbon_breadcrumbs_item_link', $item->get_link(), $item );
		return $item_link;
	}

	/**
	 * Render the item link opening tag and its "before" wrapper.
	 *
	 * @access public
	 *
	 * @return string $output The output HTML.
	 */
	public function render_link_before() {
		$trail_renderer = $this->get_trail_renderer();
		$item_link      = $this->get_item_link();

		// HTML before link opening tag.
		$output = $trail_renderer->get_link_before();

		// Link can be optional or disabled.
		if ( $item_link && $this->is_link_enabled() ) {
			$output .= '<a href="' . $item_link . '"' . $this->get_item_attributes_html() . '>';
		}

		return $output;
	}

	/**
	 * Render the item link closing tag and its "after" wrapper.
	 *
	 * @access public
	 *
	 * @return string $output The output HTML.
	 */
	public function render_link_after() {
		$trail_renderer = $this->get_trail_renderer();
		$item_link      = $this->get_item_link();
		$output         = '';

		// Link can be optional or disabled.
		if ( $item_link && $this->is_link_enabled() ) {
			$output .= '</a>';
		}

		// HTML after link closing tag.
		$output .= $trail_renderer->get_link_after();

		return $output;
	}

	/**
	 * Render the item title, along with its before & after wrappers.
	 *
	 * @access public
	 *
	 * @return string $output The output HTML.
	 */
	public function render_title() {
		$item           = $this->get_item();
		$trail_renderer = $this->get_trail_renderer();

		// HTML before title.
		$output = $trail_renderer->get_title_before();

		// Breadcrumb item title.
		$output .= apply_filters( 'carbon_breadcrumbs_item_title', $item->get_title(), $item );

		// HTML after title.
		$output .= $trail_renderer->get_title_after();

		return $output;
	}

	/**
	 * Retrieve the attributes of the item link.
	 *
	 * @access public
	 *
	 * @return string $attributes_html The HTML of the item attributes.
	 */
	public function get_item_attributes_html() {
		$item = $this->get_item();

		// Get the item attributes.
		$item_attributes = apply_filters( 'carbon_breadcrumbs_item_attributes', $item->get_attributes(), $item );

		// Prepare the item attributes.
		$attributes_html = '';
		foreach ( $item_attributes as $attr => $attr_value ) {
			$attributes_html .= ' ' . $attr . '="' . esc_attr( $attr_value ) . '"';
		}

		return $attributes_html;
	}

	/**
	 * Whether the link of this item is enabled.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function is_link_enabled() {
		$trail          = $this->get_trail();
		$trail_renderer = $this->get_trail_renderer();
		$total_items    = $trail->get_total_items();
		$index          = $this->get_index();

		return $trail_renderer->get_last_item_link() || $index < $total_items;
	}

	/**
	 * Retrieve the item to render.
	 *
	 * @access public
	 *
	 * @return Carbon_Breadcrumb_Item $item Item to render.
	 */
	public function get_item() {
		return $this->item;
	}

	/**
	 * Modify the item to render.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Item $item Item to render.
	 */
	public function set_item( $item ) {
		$this->item = $item;
	}

	/**
	 * Retrieve the trail this item belongs to.
	 *
	 * @access public
	 *
	 * @return Carbon_Breadcrumb_Trail $trail Trail this item belongs to.
	 */
	public function get_trail() {
		return $this->trail;
	}

	/**
	 * Modify the trail this item belongs to.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Trail $trail Trail this item belongs to.
	 */
	public function set_trail( $trail ) {
		$this->trail = $trail;
	}

	/**
	 * Retrieve the trail renderer.
	 *
	 * @access public
	 *
	 * @return Carbon_Breadcrumb_Trail_Renderer $trail_renderer Trail renderer.
	 */
	public function get_trail_renderer() {
		return $this->trail_renderer;
	}

	/**
	 * Modify the trail renderer.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Trail_Renderer $trail_renderer Trail renderer.
	 */
	public function set_trail_renderer( $trail_renderer ) {
		$this->trail_renderer = $trail_renderer;
	}

	/**
	 * Retrieve the index of this item.
	 *
	 * @access public
	 *
	 * @return int $index Index of this item.
	 */
	public function get_index() {
		return $this->index;
	}

	/**
	 * Modify the index of this item.
	 *
	 * @access public
	 *
	 * @param int $index Index of this item.
	 */
	public function set_index( $index = 0 ) {
		$this->index = $index;
	}

}
