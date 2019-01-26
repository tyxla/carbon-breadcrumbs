<?php
/**
 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::__construct()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin_Settings_Field::__construct()
 *
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldConstructTest extends WP_UnitTestCase {
	/**
	 * Field ID.
	 *
	 * @var string
	 **/
	protected $id = 'foo_bar';

	/**
	 * Field title.
	 *
	 * @var string
	 **/
	protected $title = 'Foo Bar';

	/**
	 * Field section.
	 *
	 * @var string
	 **/
	protected $section = 'Test';

	/**
	 * Field args.
	 *
	 * @var array
	 **/
	protected $args = array( 'foo' => 'bar' );

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin_field = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Admin_Settings_Field', array(), '', false );

		$this->admin_field->__construct( $this->id, $this->title, $this->section, $this->args );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin_field );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSetId() {
		$this->assertSame( $this->id, $this->admin_field->get_id() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSetTitle() {
		$this->assertSame( $this->title, $this->admin_field->get_title() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSettingsFieldRegistration() {
		global $wp_settings_fields;
		$page = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$this->assertArrayHasKey( $page, $wp_settings_fields );
		$this->assertArrayHasKey( $this->section, $wp_settings_fields[ $page ] );
		$this->assertArrayHasKey( $this->id, $wp_settings_fields[ $page ][ $this->section ] );

		$expected = array(
			'id'       => $this->id,
			'title'    => $this->title,
			'callback' => array( $this->admin_field, 'render' ),
			'args'     => $this->args,
		);
		$this->assertEquals( $expected, $wp_settings_fields[ $page ][ $this->section ][ $this->id ] );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin_Settings_Field::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::__construct
	 */
	public function testSettingRegistration() {
		global $new_whitelist_options;
		$page = Carbon_Breadcrumb_Admin_Settings::get_page_name();

		$this->assertArrayHasKey( $page, $new_whitelist_options );
		$this->assertContains( $this->id, $new_whitelist_options[ $page ] );
	}

}
