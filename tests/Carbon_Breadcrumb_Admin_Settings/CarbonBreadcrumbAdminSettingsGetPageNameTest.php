<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsGetPageNameTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin_Settings' )->setMethods(null)->disableOriginalConstructor()->getMock();
	}

	public function tearDown() {
		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::get_page_name
	 */
	public function testGetPageName() {
		$this->assertSame( 'carbon_breadcrumbs_settings', $this->adminSettings->get_page_name() );
	}

}
