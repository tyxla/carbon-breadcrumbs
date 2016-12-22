<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldGetSetIdTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminField = $this->getMockForAbstractClass('Carbon_Breadcrumb_Admin_Settings_Field', array(123, 'test') );
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->adminField );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_id
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::set_id
	 */
	public function testGetSetId() {
		$expected = 123;
		$this->adminField->set_id( $expected );
		$this->assertSame( $expected, $this->adminField->get_id() );
	}

}