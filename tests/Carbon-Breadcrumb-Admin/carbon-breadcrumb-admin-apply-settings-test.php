<?php
/**
 * Tests for Carbon_Breadcrumb_Admin::apply_settings()
 *
 * @group admin
 */
class CarbonBreadcrumbAdminApplySettingsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->admin = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		parent::tearDown();

		unset( $this->admin );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::apply_settings().
	 *
	 * @covers Carbon_Breadcrumb_Admin::apply_settings
	 */
	public function testDefaultApplySettings() {
		$actual   = $this->admin->apply_settings();
		$expected = array(
			'glue'              => false,
			'link_before'       => false,
			'link_after'        => false,
			'wrapper_before'    => false,
			'wrapper_after'     => false,
			'title_before'      => false,
			'title_after'       => false,
			'min_items'         => false,
			'last_item_link'    => false,
			'display_home_item' => false,
			'home_item_title'   => false,
		);
		$this->assertSame( $expected, $actual );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::apply_settings().
	 *
	 * @covers Carbon_Breadcrumb_Admin::apply_settings
	 */
	public function testStringSetting() {
		$expected = '|===>';
		update_option( 'carbon_breadcrumbs_glue', $expected );

		$settings = $this->admin->apply_settings();
		$this->assertSame( $settings['glue'], $expected );

		delete_option( 'carbon_breadcrumbs_glue' );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::apply_settings().
	 *
	 * @covers Carbon_Breadcrumb_Admin::apply_settings
	 */
	public function testNumberSetting() {
		$expected = 5;
		update_option( 'carbon_breadcrumbs_min_items', $expected );

		$settings = $this->admin->apply_settings();
		$this->assertSame( $settings['min_items'], $expected );

		delete_option( 'carbon_breadcrumbs_min_items' );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::apply_settings().
	 *
	 * @covers Carbon_Breadcrumb_Admin::apply_settings
	 */
	public function testBooleanSetting() {
		$expected = true;
		update_option( 'carbon_breadcrumbs_last_item_link', $expected );

		$settings = $this->admin->apply_settings();
		$this->assertSame( $settings['last_item_link'], $expected );

		delete_option( 'carbon_breadcrumbs_last_item_link' );
	}

}
