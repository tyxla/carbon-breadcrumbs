<?php
/**
 * Tests for Carbon_Breadcrumb_Admin::current_dir()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin::current_dir()
 *
 * @group admin
 */
class CarbonBreadcrumbAdminCurrentDirTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Admin::current_dir().
	 *
	 * @covers Carbon_Breadcrumb_Admin::current_dir
	 */
	public function testCurrentDir() {
		$expected = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . 'admin';
		$actual   = $this->admin->current_dir();
		$this->assertSame( $expected, $actual );
	}

}
