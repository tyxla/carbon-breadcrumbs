<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldGetSetIdTest extends WP_UnitTestCase {
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
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_id
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::set_id
	 */
	public function testGetSetId() {
		$expected = 123;
		$this->admin_field->set_id( $expected );
		$this->assertSame( $expected, $this->admin_field->get_id() );
	}

}
