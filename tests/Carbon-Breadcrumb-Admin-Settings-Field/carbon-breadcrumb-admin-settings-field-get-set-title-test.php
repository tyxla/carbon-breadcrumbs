<?php
/**
 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::get_title() and Carbon_Breadcrumb_Admin_Settings_Field::set_title()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin_Settings_Field::get_title() and Carbon_Breadcrumb_Admin_Settings_Field::set_title()
 *
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldGetSetTitleTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin_field = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Admin_Settings_Field', array( 123, 'test' ) );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin_field );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::get_title().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_title
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::set_title
	 */
	public function testGetSetTitle() {
		$expected = 'test';
		$this->admin_field->set_title( $expected );
		$this->assertSame( $expected, $this->admin_field->get_title() );
	}

}
