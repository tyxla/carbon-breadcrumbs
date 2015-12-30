<?php
/**
 * @group admin
 */
class CarbonBreadcrumbAdminIncludeFilesTest extends WP_UnitTestCase {

	public function setUp() {
		$this->admin = $this->getMock('Carbon_Breadcrumb_Admin', null, array(), '', false);
	}

	public function tearDown() {
		unset( $this->admin );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::include_files
	 */
	public function testIncludeFiles() {
		$this->admin->include_files();
		
		$this->assertTrue( class_exists( 'Carbon_Breadcrumb_Admin_Settings' ) );
		$this->assertTrue( class_exists( 'Carbon_Breadcrumb_Admin_Settings_Field' ) );
		$this->assertTrue( class_exists( 'Carbon_Breadcrumb_Admin_Settings_Field_Checkbox' ) );
		$this->assertTrue( class_exists( 'Carbon_Breadcrumb_Admin_Settings_Field_Text' ) );
	}

}
