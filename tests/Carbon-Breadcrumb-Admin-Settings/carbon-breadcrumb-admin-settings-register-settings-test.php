<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsRegisterSettingsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin_settings = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin_Settings' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin_settings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::register_settings
	 */
	public function testRegisteredFields() {
		$this->admin_settings->register_settings();

		$field_data = Carbon_Breadcrumb_Admin_Settings::get_field_data();

		$this->assertSame( count( $field_data ), count( $this->admin_settings->fields ) );

		$key = 0;
		foreach ( $field_data as $id => $field ) {
			$this->assertSame( $field['title'], $this->admin_settings->fields[ $key ]->get_title() );
			$this->assertSame( 'carbon_breadcrumbs_' . $id, $this->admin_settings->fields[ $key ]->get_id() );
			$this->assertInstanceOf( 'Carbon_Breadcrumb_Admin_Settings_Field_' . $field['type'], $this->admin_settings->fields[ $key ] );
			$key++;
		}
	}

}
