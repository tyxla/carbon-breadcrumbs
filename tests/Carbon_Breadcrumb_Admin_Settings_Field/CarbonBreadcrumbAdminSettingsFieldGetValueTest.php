<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldGetValueTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->adminField = $this->getMockForAbstractClass('Carbon_Breadcrumb_Admin_Settings_Field', array('testfield', 'Test Field'), '', true, true, true, array('get_id') );
	}

	public function tearDown() {
		unset( $this->adminField );
		
		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_value
	 */
	public function testWithNoValueAndNoDefaultValue() {
		$this->adminField->expects($this->any())
			->method('get_id')
			->will($this->returnValue('carbon_breadcrumbs_link_before'));

		$this->assertSame( '', $this->adminField->get_value() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_value
	 */
	public function testWithNoValueAndDefaultValue() {
		$this->adminField->expects($this->any())
			->method('get_id')
			->will($this->returnValue('carbon_breadcrumbs_min_items'));

		$this->assertSame( 2, $this->adminField->get_value() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_value
	 */
	public function testWithValue() {
		$this->adminField->expects($this->any())
			->method('get_id')
			->will($this->returnValue('carbon_breadcrumbs_min_items'));

		update_option('carbon_breadcrumbs_min_items', 5);

		$this->assertSame( 5, $this->adminField->get_value() );

		delete_option( 'carbon_breadcrumbs_min_items' );
	}

}