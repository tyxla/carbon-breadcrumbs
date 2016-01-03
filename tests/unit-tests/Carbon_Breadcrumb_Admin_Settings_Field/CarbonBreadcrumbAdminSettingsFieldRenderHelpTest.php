<?php
/**
 * @group admin_settings_field
 */
class CarbonBreadcrumbAdminSettingsFieldRenderHelpTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->adminField = $this->getMockForAbstractClass('Carbon_Breadcrumb_Admin_Settings_Field', array('testfield', 'Test Field'), '', true, true, true, array('get_id') );
	}

	public function tearDown() {
		unset( $this->adminField );
		
		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::render_help
	 */
	public function testWithNoHelp() {
		$this->adminField->expects($this->any())
			->method('get_id')
			->will($this->returnValue('foo_bar'));

		ob_start();
		$this->adminField->render_help();
		$actual = ob_get_clean();

		$this->assertNull( null, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field::render_help
	 */
	public function testWithHelp() {
		$this->adminField->expects($this->any())
			->method('get_id')
			->will($this->returnValue('carbon_breadcrumbs_glue'));

		ob_start();
		$this->adminField->render_help();
		$actual = ob_get_clean();

		$expected = '<p class="description">This is displayed between the breadcrumb items.</p>';
		$this->assertSame( $expected, trim( $actual ) );
	}

}