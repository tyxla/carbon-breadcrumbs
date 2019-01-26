<?php
/**
 * Tests for Carbon_Breadcrumb_Admin::register_settings() and Carbon_Breadcrumb_Admin::admin_menu()
 *
 * @group admin
 */
class CarbonBreadcrumbAdminRegisterSettingsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::admin_menu().
	 *
	 * @covers Carbon_Breadcrumb_Admin::admin_menu
	 * @covers Carbon_Breadcrumb_Admin::register_settings
	 */
	public function testRegisterSettingsInstance() {
		$this->admin->admin_menu();

		$this->assertInstanceOf( 'Carbon_Breadcrumb_Admin_Settings', $this->admin->settings );
	}

}
