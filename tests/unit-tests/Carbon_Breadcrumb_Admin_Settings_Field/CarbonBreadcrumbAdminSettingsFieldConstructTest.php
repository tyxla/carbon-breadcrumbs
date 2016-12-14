<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldConstructTest extends WP_UnitTestCase {
	protected $id = 'foo_bar';
	protected $title = 'Foo Bar';
	protected $section = 'Test';
	protected $args = array('foo' => 'bar');

	public function setUp() {
		$this->adminField = $this->getMockForAbstractClass('Carbon_Breadcrumb_Admin_Settings_Field', array(), '', false );

		$this->adminField->__construct($this->id, $this->title, $this->section, $this->args);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->adminField );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSetId() {
		$this->assertSame( $this->id, $this->adminField->get_id() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSetTitle() {
		$this->assertSame( $this->title, $this->adminField->get_title() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSettingsFieldRegistration() {
		global $wp_settings_fields;
		$page = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$this->assertArrayHasKey( $page, $wp_settings_fields );
		$this->assertArrayHasKey( $this->section, $wp_settings_fields[ $page ] );
		$this->assertArrayHasKey( $this->id, $wp_settings_fields[ $page ][ $this->section ] );

		$expected = array(
			'id' => $this->id,
			'title' => $this->title,
			'callback' => array( $this->adminField, 'render' ),
			'args' => $this->args
		);
		$this->assertSame( $expected, $wp_settings_fields[ $page ][ $this->section ][ $this->id ] );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSettingRegistration() {
		global $new_whitelist_options;
		$page = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$this->assertArrayHasKey( $page, $new_whitelist_options );
		$this->assertSame( array($this->id), $new_whitelist_options[ $page ] );
	}

}