<?php
/**
 * Abstract breadcrumb item class.
 * 
 * Used as a base for all breadcrumb item types.
 */
abstract class Carbon_Breadcrumb_Item {

	/**
	 * Breadcrumb item title.
	 *
	 * @access private
	 * @var string
	 */
	private $title;

	/**
	 * Breadcrumb item link URL.
	 *
	 * @access private
	 * @var string
	 */
	private $link;

	/**
	 * Breadcrumb item priority.
	 *
	 * @access private
	 * @var int
	 */
	private $priority = 1000;

	/**
	 * Breadcrumb item type.
	 *
	 * @access private
	 * @var string
	 */
	private $type = '';

	/**
	 * Breadcrumb item subtype.
	 *
	 * @access private
	 * @var string
	 */
	private $subtype = '';

	/**
	 * Build a new breadcrumb item of the selected type.
	 *
	 * @static
	 * @access public
	 *
	 * @param string $type Type of the breadcrumb item.
	 * @param int $priority Priority of this breadcrumb item.
	 * @return Carbon_Breadcrumb_Item $item The new breadcrumb item.
	 */
	static function factory($type = 'custom', $priority = 1000) {
		$class_type = str_replace(" ", '', ucwords(str_replace("_", ' ', $type)));
		$class = 'Carbon_Breadcrumb_Item_' . $class_type;

		if ( !class_exists($class) ) {
			throw new Carbon_Breadcrumb_Exception('Unexisting breadcrumb item type: "' . $type . '".');
		}

		$item = new $class($priority);
		$item->set_type($type);

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
	 * @return Carbon_Breadcrumb_Item
	 */
	function __construct($priority = 1000) {
		$this->set_priority($priority);
	}

	/**
	 * Retrieve the breadcrumb item title.
	 *
	 * @access public
	 *
	 * @return string $title The title of this breadcrumb item.
	 */
	function get_title() {
		return $this->title;
	}

	/**
	 * Modify the title of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $title The new title.
	 */
	function set_title($title) {
		$this->title = $title;
	}

	/**
	 * Retrieve the breadcrumb item link URL.
	 *
	 * @access public
	 *
	 * @return string $link The link URL of this breadcrumb item.
	 */
	function get_link() {
		return $this->link;
	}

	/**
	 * Modify the link URL of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $link The new link URL.
	 */
	function set_link($link = '') {
		$this->link = $link;
	}

	/**
	 * Retrieve the breadcrumb item priority.
	 *
	 * @access public
	 *
	 * @return int $priority The priority of this breadcrumb item.
	 */
	function get_priority() {
		return $this->priority;
	}

	/**
	 * Modify the priority of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param int $priority The new priority.
	 */
	function set_priority($priority) {
		$this->priority = $priority;
	}

	/**
	 * Retrieve the type of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $type The type of this breadcrumb item.
	 */
	function get_type() {
		return $this->type;
	}

	/**
	 * Modify the type of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $id The new breadcrumb item type.
	 */
	function set_type($type) {
		$this->type = $type;
	}

	/**
	 * Retrieve the subtype of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @return string $subtype The subtype of this breadcrumb item.
	 */
	function get_subtype() {
		return $this->subtype;
	}

	/**
	 * Modify the subtype of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param string $id The new breadcrumb item subtype.
	 */
	function set_subtype($subtype) {
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
	abstract function setup();

}