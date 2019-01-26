<?php
/**
 * Factory base class.
 *
 * Used as a base for breadcrumb classes that include factories.
 */
class Carbon_Breadcrumb_Factory {

	/**
	 * Verify the class name to use in factory.
	 * Make sure that the class exists.
	 *
	 * @static
	 * @access public
	 *
	 * @param string $class The class name.
	 * @param string $message The message to display in the exception if the class does not exist.
	 * @return string $class The class name.
	 *
	 * @throws Carbon_Breadcrumb_Exception if the built class name does not exist
	 */
	public static function verify_class_name( $class, $message = '' ) {
		if ( ! $message ) {
			$message = 'Unexisting class: ' . $class;
		}

		if ( ! class_exists( $class ) ) {
			throw new Carbon_Breadcrumb_Exception( $message );
		}

		return $class;
	}

}
