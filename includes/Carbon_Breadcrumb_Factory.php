<?php
/**
 * Factory base class.
 *
 * Used as a base for breadcrumb classes that include factories.
 */
class Carbon_Breadcrumb_Factory {

	/**
	 * Build the class name to use in factory.
	 *
	 * @static
	 * @access public
	 *
	 * @param string $class The main class name.
	 * @param string $append The fragment to append to the class name.
	 */
	public static function build_class_name( $class, $append ) {
		$append = str_replace( ' ', '', ucwords( str_replace( '_', ' ', $append ) ) );
		return $class . '_' . $append;
	}

}