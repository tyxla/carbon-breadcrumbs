<?php
/**
 * Tests for Carbon_Breadcrumb_Admin_Settings::admin_menu()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin_Settings::admin_menu()
 *
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsAdminMenuTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin_settings = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin_Settings' )->setMethods( null )->disableOriginalConstructor()->getMock();

		parent::setUp();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		parent::tearDown();

		unset( $this->admin_settings );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin_Settings::admin_menu().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings::admin_menu
	 */
	public function testSettingsPageRegistered() {
		global $_registered_pages, $submenu;

		$page_title = Carbon_Breadcrumb_Admin_Settings::get_page_title();
		$page_name  = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$current_user = get_current_user_id();
		wp_set_current_user( $this->factory->user->create( array( 'role' => 'administrator' ) ) );

		$this->admin_settings->admin_menu();

		$this->assertArrayHasKey( 'admin_page_' . $page_name, $_registered_pages );
		$this->assertTrue( $_registered_pages[ 'admin_page_' . $page_name ] );

		$submenu_item = array(
			$page_title,
			'manage_options',
			$page_name,
			$page_title,
		);
		$this->assertArrayHasKey( 'options-general.php', $submenu );
		$this->assertContains( $submenu_item, $submenu['options-general.php'] );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin_Settings::admin_menu().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings::admin_menu
	 */
	public function testSettingsSectionRegistered() {
		global $wp_settings_sections;

		$page_name = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$this->admin_settings->admin_menu();

		$section_item = array(
			'id'       => $page_name,
			'title'    => 'General Settings',
			'callback' => '',
		);
		$this->assertArrayHasKey( $page_name, $wp_settings_sections );
		$this->assertArrayHasKey( $page_name, $wp_settings_sections[ $page_name ] );
		$this->assertSame( $section_item, $wp_settings_sections[ $page_name ][ $page_name ] );
	}

}
