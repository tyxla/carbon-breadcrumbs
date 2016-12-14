<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsGetPageNameTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMock('Carbon_Breadcrumb_Admin_Settings', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::get_page_name
	 */
	public function testGetPageName() {
		$this->assertSame( 'carbon_breadcrumbs_settings', $this->adminSettings->get_page_name() );
	}

}
