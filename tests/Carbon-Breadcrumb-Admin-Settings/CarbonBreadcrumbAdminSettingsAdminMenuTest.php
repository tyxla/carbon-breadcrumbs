<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsAdminMenuTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin_Settings' )->setMethods( null )->disableOriginalConstructor()->getMock();

		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();

		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::admin_menu
	 */
	public function testSettingsPageRegistered() {
		global $_registered_pages, $submenu;

		$page_title = Carbon_Breadcrumb_Admin_Settings::get_page_title();
		$page_name  = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$current_user = get_current_user_id();
		wp_set_current_user( $this->factory->user->create( array( 'role' => 'administrator' ) ) );

		$this->adminSettings->admin_menu();

		$this->assertArrayHasKey( 'admin_page_' . $page_name, $_registered_pages );
		$this->assertTrue( $_registered_pages[ 'admin_page_' . $page_name ] );

		$submenuItem = array(
			$page_title,
			'manage_options',
			$page_name,
			$page_title,
		);
		$this->assertArrayHasKey( 'options-general.php', $submenu );
		$this->assertContains( $submenuItem, $submenu['options-general.php'] );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::admin_menu
	 */
	public function testSettingsSectionRegistered() {
		global $wp_settings_sections;

		$page_name = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$this->adminSettings->admin_menu();

		$sectionItem = array(
			'id'       => $page_name,
			'title'    => 'General Settings',
			'callback' => '',
		);
		$this->assertArrayHasKey( $page_name, $wp_settings_sections );
		$this->assertArrayHasKey( $page_name, $wp_settings_sections[ $page_name ] );
		$this->assertSame( $sectionItem, $wp_settings_sections[ $page_name ][ $page_name ] );
	}

}
