<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsConstructTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMock('Carbon_Breadcrumb_Admin_Settings', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::__construct
	 */
	public function testHookedMethods() {
		$this->adminSettings->__construct();
		
		$this->assertSame( 30, has_action( 'admin_menu', array($this->adminSettings, 'admin_menu') ) );
		$this->assertSame( 10, has_action( 'admin_init', array($this->adminSettings, 'register_settings') ) );
	}

}
