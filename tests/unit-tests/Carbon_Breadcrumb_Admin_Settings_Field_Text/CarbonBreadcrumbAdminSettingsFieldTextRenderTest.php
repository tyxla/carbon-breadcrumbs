<?php
/**
 * @group admin_settings_field_text
 */
class CarbonBreadcrumbAdminSettingsFieldTextRenderTest extends WP_UnitTestCase {
	public function setUp() {
		$this->field = $this->getMock('Carbon_Breadcrumb_Admin_Settings_Field_Text', array('get_id', 'get_value'), array(), '', false );
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->field );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings_Field_Text::render
	 */
	public function testRenderMarkup() {
		$id = 'foobar';
		$this->field->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( $id ) );

		$value = 'testValue';
		$this->field->expects( $this->any() )
			->method( 'get_value' )
			->will( $this->returnValue( $value ) );

		ob_start();
		$this->field->render();
		$actual = trim( ob_get_clean() );
		$expected = '<input name="' . $id . '" id="' . $id . '" type="text" value="' . $value . '" class="regular-text" />';
		$this->assertSame( $expected, $actual );
	}

}