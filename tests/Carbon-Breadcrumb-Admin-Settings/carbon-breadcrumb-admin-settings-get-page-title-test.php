<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsGetPageTitleTest extends WP_UnitTestCase {
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
	 * @covers Carbon_Breadcrumb_Admin_Settings::get_page_title
	 */
	public function testGetPageTitle() {
		$this->assertSame( 'Carbon Breadcrumbs', $this->admin_settings->get_page_title() );
	}

}
