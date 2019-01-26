<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsConstructTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin_Settings' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	public function tearDown() {
		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::__construct
	 */
	public function testHookedMethods() {
		$this->adminSettings->__construct();

		$this->assertSame( 30, has_action( 'admin_menu', array( $this->adminSettings, 'admin_menu' ) ) );
		$this->assertSame( 10, has_action( 'admin_init', array( $this->adminSettings, 'register_settings' ) ) );
	}

}
