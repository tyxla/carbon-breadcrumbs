<?php
/**
 * Tests for Carbon_Breadcrumb_Admin_Settings::__construct()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin_Settings::__construct()
 *
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsConstructTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Admin_Settings::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings::__construct
	 */
	public function testHookedMethods() {
		$this->admin_settings->__construct();

		$this->assertSame( 30, has_action( 'admin_menu', array( $this->admin_settings, 'admin_menu' ) ) );
		$this->assertSame( 10, has_action( 'admin_init', array( $this->admin_settings, 'register_settings' ) ) );
	}

}
