<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldGetSetTitleTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminField = $this->getMockForAbstractClass('Carbon_Breadcrumb_Admin_Settings_Field', array(123, 'test') );
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->adminField );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_title
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::set_title
	 */
	public function testGetSetTitle() {
		$expected = 'test';
		$this->adminField->set_title( $expected );
		$this->assertSame( $expected, $this->adminField->get_title() );
	}

}