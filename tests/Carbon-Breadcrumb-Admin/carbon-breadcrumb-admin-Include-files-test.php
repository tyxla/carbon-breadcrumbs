<?php
/**
 * Tests for Carbon_Breadcrumb_Admin::include_files()
 *
 * @group admin
 */
class CarbonBreadcrumbAdminIncludeFilesTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::include_files().
	 *
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
