<?php
/**
 * @group admin
 */
class CarbonBreadcrumbAdminApplySettingsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->admin = $this->getMock('Carbon_Breadcrumb_Admin', null, array(), '', false);

		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();

		unset( $this->admin );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::apply_settings
	 */
	public function testDefaultApplySettings() {
		$actual = $this->admin->apply_settings();
		$expected = array(
			'glue' => false,
			'link_before' => false,
			'link_after' => false,
			'wrapper_before' => false,
			'wrapper_after' => false,
			'title_before' => false,
			'title_after' => false,
			'min_items' => false,
			'last_item_link' => false,
			'display_home_item' => false,
			'home_item_title' => false,
		);
		$this->assertSame( $expected, $actual );
	}

	/**
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
