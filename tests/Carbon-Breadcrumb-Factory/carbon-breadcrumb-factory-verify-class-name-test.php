<?php
/**
 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::__construct()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin_Settings_Field::__construct()
 *
 * @group factory
 */
class CarbonBreadcrumbFactoryVerifyClassNameTest extends WP_UnitTestCase {
	/**
	 * Tests for Carbon_Breadcrumb_Factory::verify_class_name().
	 *
	 * @covers Carbon_Breadcrumb_Factory::verify_class_name
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage Unexisting class: foobar
	 */
	public function testWithUnexistingClass() {
		Carbon_Breadcrumb_Factory::verify_class_name( 'foobar' );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Factory::verify_class_name().
	 *
	 * @covers Carbon_Breadcrumb_Factory::verify_class_name
	 */
	public function testWithExistingClass() {
		$class_name = Carbon_Breadcrumb_Factory::verify_class_name( 'Carbon_Breadcrumb_Item' );
		$this->assertSame( 'Carbon_Breadcrumb_Item', $class_name );
	}
}
