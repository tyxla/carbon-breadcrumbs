<?php
/**
 * @group admin
 */
class CarbonBreadcrumbAdminCurrentDirTest extends WP_UnitTestCase {

	public function setUp() {
		$this->admin = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	public function tearDown() {
		unset( $this->admin );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::current_dir
	 */
	public function testCurrentDir() {
		$expected = dirname( dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR . 'admin';
		$actual   = $this->admin->current_dir();
		$this->assertSame( $expected, $actual );
	}

}
