<?php
/**
 * @group admin
 */
class CarbonBreadcrumbAdminInitTest extends WP_UnitTestCase {

	public function setUp() {
		$this->admin = $this->getMock('Carbon_Breadcrumb_Admin', null, array(), '', false);
	}

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
