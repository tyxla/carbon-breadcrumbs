<?php
/**
 * @group admin_settings_field_checkbox
 */
class CarbonBreadcrumbAdminSettingsFieldCheckboxRenderTest extends WP_UnitTestCase {
	protected $id = 'foobar';

	public function setUp() {
		$this->field = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin_Settings_Field_Checkbox' )->setMethods( array( 'get_id', 'get_value' ) )->disableOriginalConstructor()->getMock();

		$this->field->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( $this->id ) );
	}

	public function tearDown() {
		unset( $this->field );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field_Checkbox::render
	 */
	public function testNotChecked() {
		$value = false;
		$this->field->expects( $this->any() )
			->method( 'get_value' )
			->will( $this->returnValue( $value ) );

		ob_start();
		$this->field->render();
		$actual   = trim( ob_get_clean() );
		$expected = '<input name="' . $this->id . '" id="' . $this->id . '" type="checkbox" value="1" class="code"  />';
		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field_Checkbox::render
	 */
	public function testChecked() {
		$value = '1';
		$this->field->expects( $this->any() )
			->method( 'get_value' )
			->will( $this->returnValue( $value ) );
		$checked = 'checked="checked"';

		ob_start();
		$this->field->render();
		$actual   = trim( ob_get_clean() );
		$expected = '<input name="' . $this->id . '" id="' . $this->id . '" type="checkbox" value="1" class="code" ' . esc_html( checked( 1, 1, false ) ) . ' />';
		$this->assertSame( $expected, $actual );
	}


}
