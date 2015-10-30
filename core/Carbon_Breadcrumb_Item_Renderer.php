<?php 

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
	 * @param Carbon_Breadcrumb_Item $item The item to render.
	 * @param Carbon_Breadcrumb_Trail $trail The trail this item belongs to.
	 * @param Carbon_Breadcrumb_Trail_Renderer $trail_renderer The trail renderer.
	 * @param int $index Index of this item.
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
		$item_output = '';
		$item = $this->get_item();
		$index = $this->get_index();
		$trail = $this->get_trail();
		$trail_renderer = $this->get_trail_renderer();
		$total_items = $trail->get_total_items();

		// get the item link
		$item_link = apply_filters( 'carbon_breadcrumbs_item_link', $item->get_link(), $item );

		// get the item attributes
		$item_attributes = apply_filters( 'carbon_breadcrumbs_item_attributes', $item->get_attributes(), $item );

		// prepare the item attributes
		$attributes_html = '';
		foreach ( $item_attributes as $attr => $attr_value ) {
			$attributes_html .= ' ' . $attr . '="' . esc_attr( $attr_value ) . '"';
		}

		// HTML before link opening tag
		$item_output .= $trail_renderer->get_link_before();

		// link can be optional
		if ( $item_link ) {
			// last item link can be disabled
			if ( $trail_renderer->get_last_item_link() || $index < $total_items ) {
				$item_output .= '<a href="' . $item_link . '"' . $attributes_html . '>';
			}
		}

		// HTML before title
		$item_output .= $trail_renderer->get_title_before();

		// breadcrumb item title
		$item_output .= apply_filters( 'carbon_breadcrumbs_item_title', $item->get_title(), $item );

		// HTML after title
		$item_output .= $trail_renderer->get_title_after();

		// link can be optional
		if ( $item_link ) {
			// last item link can be disabled
			if ( $trail_renderer->get_last_item_link() || $index < $total_items ) {
				$item_output .= '</a>';
			}
		}

		// HTML after link closing tag
		$item_output .= $trail_renderer->get_link_after();

		// allow item output to be filtered
		return apply_filters( 'carbon_breadcrumbs_item_output', $item_output, $item );
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
	public function set_index( $index = '' ) {
		$this->index = $index;
	}

}