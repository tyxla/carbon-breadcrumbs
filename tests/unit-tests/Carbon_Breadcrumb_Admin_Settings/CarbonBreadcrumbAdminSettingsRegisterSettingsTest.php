<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsRegisterSettingsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMock('Carbon_Breadcrumb_Admin_Settings', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::register_settings
	 */
	public function testRegisteredFields() {
		$this->adminSettings->register_settings();

		$fieldData = Carbon_Breadcrumb_Admin_Settings::get_field_data();

		$this->assertSame( count($fieldData), count( $this->adminSettings->fields ) );

		$key = 0;
		foreach ($fieldData as $id => $field) {
			$this->assertSame( $field['title'], $this->adminSettings->fields[$key]->get_title() );
			$this->assertSame( 'carbon_breadcrumbs_' . $id, $this->adminSettings->fields[$key]->get_id() );
			$this->assertInstanceOf( 'Carbon_Breadcrumb_Admin_Settings_Field_' . $field['type'], $this->adminSettings->fields[$key] );
			$key++;
		}
	}

}
