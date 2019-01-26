<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldRenderHelpTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->admin_field = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Admin_Settings_Field', array( 'testfield', 'Test Field' ), '', true, true, true, array( 'get_id' ) );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin_field );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::render_help
	 */
	public function testWithNoHelp() {
		$this->admin_field->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( 'foo_bar' ) );

		ob_start();
		$this->admin_field->render_help();
		$actual = ob_get_clean();

		$this->assertNull( null, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::render_help
	 */
	public function testWithHelp() {
		$this->admin_field->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( 'carbon_breadcrumbs_glue' ) );

		ob_start();
		$this->admin_field->render_help();
		$actual = ob_get_clean();

		$expected = '<p class="description">This is displayed between the breadcrumb items.</p>';
		$this->assertSame( $expected, trim( $actual ) );
	}

}
