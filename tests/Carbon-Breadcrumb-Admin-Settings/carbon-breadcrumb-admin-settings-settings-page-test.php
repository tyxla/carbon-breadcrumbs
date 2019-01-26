<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsSettingsPageTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Admin_Settings::settings_page().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings::settings_page
	 */
	public function testSettingsPageContents() {
		ob_start();
		$this->admin_settings->settings_page();
		$content = ob_get_clean();

		$this->assertContains( esc_html( Carbon_Breadcrumb_Admin_Settings::get_page_title() ), $content );
		$this->assertContains( '<form', $content );
		$this->assertContains( '</form>', $content );
		$this->assertContains( 'action="options.php"', $content );

		ob_start();
		submit_button();
		$button = ob_get_clean();

		$this->assertContains( $button, $content );
	}

}
