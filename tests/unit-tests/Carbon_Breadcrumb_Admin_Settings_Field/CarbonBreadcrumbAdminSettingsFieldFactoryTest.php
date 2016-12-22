<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldFactoryTest extends WP_UnitTestCase {
	protected $type = 'Text';
	protected $id = 'foo_bar';
	protected $title = 'Foo Bar';
	protected $section = 'Test';
	protected $args = array('foo' => 'bar');

	public function setUp() {
		$this->adminField = Carbon_Breadcrumb_Admin_Settings_Field::factory( $this->type, $this->id, $this->title, $this->section, $this->args );
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->adminField );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::factory
	 */
	public function testType() {
		$this->assertSame( 'Carbon_Breadcrumb_Admin_Settings_Field_Text', get_class( $this->adminField ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::factory
	 */
	public function testId() {
		$this->assertSame( $this->id, $this->adminField->get_id() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::factory
	 */
	public function testTitle() {
		$this->assertSame( $this->title, $this->adminField->get_title() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::factory
	 */
	public function testSection() {
		global $wp_settings_fields;
		$page = Carbon_Breadcrumb_Admin_Settings::get_page_name();
		
		$this->assertArrayHasKey( $this->section, $wp_settings_fields[ $page ] );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::factory
	 */
	public function testArgs() {
		global $wp_settings_fields;
		$page = Carbon_Breadcrumb_Admin_Settings::get_page_name();
		
		$this->assertArrayHasKey( $this->id, $wp_settings_fields[ $page ][ $this->section ] );
	}
}