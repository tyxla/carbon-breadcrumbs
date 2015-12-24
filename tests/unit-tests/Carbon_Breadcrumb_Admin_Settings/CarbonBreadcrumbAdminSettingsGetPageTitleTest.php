<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsGetPageTitleTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMock('Carbon_Breadcrumb_Admin_Settings', null, array(), '', false);
	}

	public function tearDown() {
		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::get_page_title
	 */
	public function testGetPageTitle() {
		$this->assertSame( 'Carbon Breadcrumbs', $this->adminSettings->get_page_title() );
	}

}
