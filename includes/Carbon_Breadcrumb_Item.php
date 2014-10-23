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
	 * Locator, used to find items of this breadcrumb item type.
	 *
	 * @access private
	 * @var Carbon_Breadcrumb_Locator
	 */
	private $locator;

	/**
	 * Build a new breadcrumb item of the selected type.
	 *
	 * @static
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Locator $locator Locator, used to find and generate the items.
	 * @param string $type Type of the breadcrumb item.
	 * @param int $priority Priority of this breadcrumb item.
	 * @return Carbon_Breadcrumb_Item $item The new breadcrumb item.
	 */
	static function factory(Carbon_Breadcrumb_Locator $locator = null, $type = 'custom', $priority = 1000) {
		if (!$locator) {
			$locator = Carbon_Breadcrumb_Locator::factory($type);
		}

		$type = str_replace(" ", '', ucwords(str_replace("_", ' ', $type)));
		$class = 'Carbon_Breadcrumb_Item_' . $type;

		if ( !class_exists($class) ) {
			throw new Carbon_Breadcrumb_Exception('Unexisting breadcrumb item type: "' . $type . '".');
		}

		$item = new $class($locator, $priority);

		return $item;
	}

	/**
	 * Constructor.
	 *
	 * Creates and configures a new breadcrumb item with the provided settings.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Locator $locator Locator, used to find and generate the items.
	 * @param int $priority Priority of this breadcrumb item.
	 * @return Carbon_Breadcrumb_Item
	 */
	function __construct(Carbon_Breadcrumb_Locator $locator = null, $priority = 1000) {
		if (!$locator) {
			$locator = Carbon_Breadcrumb_Locator::factory('custom');
		}
		$this->set_locator($locator);
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
	 * Retrieve the breadcrumb item locator.
	 *
	 * @access public
	 *
	 * @return Carbon_Breadcrumb_Locator $locator The locator of this breadcrumb item.
	 */
	function get_locator() {
		return $this->locator;
	}

	/**
	 * Modify the locator of this breadcrumb item.
	 *
	 * @access public
	 *
	 * @param Carbon_Breadcrumb_Locator $locator The new locator.
	 */
	function set_locator(Carbon_Breadcrumb_Locator $locator) {
		$this->locator = $locator;
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