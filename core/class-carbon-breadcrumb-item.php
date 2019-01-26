<?php
/**
 * Abstract breadcrumb item
 *
 * @package carbon-breadcrumbs
 */

/**
 * Abstract breadcrumb item class.
 *
 * Used as a base for all breadcrumb item types.
 */
abstract class Carbon_Breadcrumb_Item extends Carbon_Breadcrumb_Factory {

	/**
	 * Breadcrumb item title.
	 *
	 * @access protected
	 * @var string
	 */
	protected $title;

	/**
	 * Breadcrumb item link URL.
	 *
	 * @access protected
	 * @var string
	 */
	protected $link;

	/**
	 * Breadcrumb item link additional attributes.
	 *
	 * @access protected
	 * @var array
	 */
	protected $attributes = array(
		'target' => '_self',
	);

	/**
	 * Breadcrumb item priority.
	 *
	 * @access protected
	 * @var int
	 */
	protected $priority = 1000;

	/**
	 * Breadcrumb item type.
	 *
	 * @access protected
	 * @var string
	 */
	protected $type = '';

	/**
	 * Breadcrumb item subtype.
	 *
	 * @access protected
	 * @var string
	 */
	protected $subtype = '';

	/**
	 * Build a new breadcrumb item of the selected type.
	 *
	 * @static
	 * @access public
	 *
	 * @param string $type Type of the breadcrumb item.
	 * @param int    $priority Priority of this breadcrumb item.
	 * @return Carbon_Breadcrumb_Item $item The new breadcrumb item.
	 */
	public static function factory( $type = 'custom', $priority = 1000 ) {
		$class = self::verify_class_name( __CLASS__ . '_' . $type, 'Unexisting breadcrumb item type: "' . $type . '".' );

		$item = new $class( $priority );
		$item->set_type( $type );

		return $item;
	}

	/**
	 * Constructor.
	 *
	 * Creates and configures a new breadcrumb item with the provided settings.
	 *
	 * @access public
	 *
	 * @param int $priority Priority of this breadcrumb item.
	 */
	public function __construct( $priority = 1000 ) {
		$this->set_priority( $priority );
	}

	/**
	 * Retrieve the breadcrumb item title.
	 *
	 * @access public
	 *
	 * @return string $title The title of this breadcrumb item.
	 */
	public function get_title() {
		return $this->title;
	}

	/**
	 * Modify the title of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $title The new title.
	 */
	public function set_title( $title ) {
		$this->title = $title;
	}

	/**
	 * Retrieve the breadcrumb item link URL.
	 *
	 * @access public
	 *
	 * @return string $link The link URL of this breadcrumb item.
	 */
	public function get_link() {
		return $this->link;
	}

	/**
	 * Modify the link URL of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $link The new link URL.
	 */
	public function set_link( $link = '' ) {
		$this->link = $link;
	}

	/**
	 * Retrieve the breadcrumb item link attributes.
	 *
	 * @access public
	 *
	 * @return array $attributes The link attributes of this breadcrumb item.
	 */
	public function get_attributes() {
		return $this->attributes;
	}

	/**
	 * Modify the link attributes of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param array $attributes The new link attributes.
	 */
	public function set_attributes( $attributes = array() ) {
		$this->attributes = $attributes;
	}

	/**
	 * Retrieve the breadcrumb item priority.
	 *
	 * @access public
	 *
	 * @return int $priority The priority of this breadcrumb item.
	 */
	public function get_priority() {
		return $this->priority;
	}

	/**
	 * Modify the priority of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param int $priority The new priority.
	 */
	public function set_priority( $priority ) {
		$this->priority = $priority;
	}

	/**
	 * Retrieve the type of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $type The type of this breadcrumb item.
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Modify the type of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $type The new breadcrumb item type.
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}

	/**
	 * Retrieve the subtype of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $subtype The subtype of this breadcrumb item.
	 */
	public function get_subtype() {
		return $this->subtype;
	}

	/**
	 * Modify the subtype of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $subtype The new breadcrumb item subtype.
	 */
	public function set_subtype( $subtype ) {
		$this->subtype = $subtype;
	}

	/**
	 * Setup this breadcrumb item.
	 *
	 * This method can be used to automatically set this item's title, link
	 * and other settings in the child class.
	 *
	 * @abstract
	 * @access public
	 */
	abstract public function setup();

}
