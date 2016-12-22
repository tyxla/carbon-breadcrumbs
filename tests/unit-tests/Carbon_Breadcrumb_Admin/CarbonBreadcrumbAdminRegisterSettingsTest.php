<?php
/**
 * @group admin
 */
class CarbonBreadcrumbAdminRegisterSettingsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->admin = $this->getMock('Carbon_Breadcrumb_Admin', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->admin );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::admin_menu
	 * @covers Carbon_Breadcrumb_Admin::register_settings
	 */
	public function testRegisterSettingsInstance() {
		$this->admin->admin_menu();
		
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Admin_Settings', $this->admin->settings );
	}

}
