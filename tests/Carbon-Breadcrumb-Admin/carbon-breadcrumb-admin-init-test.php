<?php
/**
 * Tests for Carbon_Breadcrumb_Admin::init()
 *
 * @group admin
 */
class CarbonBreadcrumbAdminInitTest extends WP_UnitTestCase {
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
	 * @covers Carbon_Breadcrumb_Admin::init
	 */
	public function testIfApplySettingsIsHooked() {
		$this->admin->init();

		$this->assertSame( 20, has_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this->admin, 'apply_settings' ) ) );
	}

}
