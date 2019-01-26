<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldGetValueTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->admin_field = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Admin_Settings_Field', array( 'testfield', 'Test Field' ), '', true, true, true, array( 'get_id' ) );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin_field );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_value
	 */
	public function testWithNoValueAndNoDefaultValue() {
		$this->admin_field->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( 'carbon_breadcrumbs_link_before' ) );

		$this->assertSame( '', $this->admin_field->get_value() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_value
	 */
	public function testWithNoValueAndDefaultValue() {
		$this->admin_field->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( 'carbon_breadcrumbs_min_items' ) );

		$this->assertSame( 2, $this->admin_field->get_value() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::get_value
	 */
	public function testWithValue() {
		$this->admin_field->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( 'carbon_breadcrumbs_min_items' ) );

		update_option( 'carbon_breadcrumbs_min_items', 5 );

		$this->assertSame( 5, $this->admin_field->get_value() );

		delete_option( 'carbon_breadcrumbs_min_items' );
	}

}
