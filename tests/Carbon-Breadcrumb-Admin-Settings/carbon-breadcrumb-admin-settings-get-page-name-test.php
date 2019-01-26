<?php
/**
 * Tests for Carbon_Breadcrumb_Admin_Settings::get_page_name()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin_Settings::get_page_name()
 *
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsGetPageNameTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Admin_Settings::get_page_name().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings::get_page_name
	 */
	public function testGetPageName() {
		$this->assertSame( 'carbon_breadcrumbs_settings', $this->admin_settings->get_page_name() );
	}

}
