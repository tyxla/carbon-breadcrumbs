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
	 * @param string $message The message to display in the exception if the class does not exist.
	 * @return string $classname The build class name.
	 *
	 * @throws Carbon_Breadcrumb_Exception if the built class name does not exist
	 */
	public static function build_class_name( $class, $append, $message = '' ) {
		$append = str_replace( ' ', '', ucwords( str_replace( '_', ' ', $append ) ) );
		$classname = $class . '_' . $append;

		if ( ! $message ) {
			$message = 'Unexisting class: ' . $classname;
		}

		if ( ! class_exists( $classname ) ) {
			throw new Carbon_Breadcrumb_Exception( $message );
		}

		return $classname;
	}

}