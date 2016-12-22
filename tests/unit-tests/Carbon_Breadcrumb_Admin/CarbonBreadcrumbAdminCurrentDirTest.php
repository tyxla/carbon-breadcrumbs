<?php
/**
 * @group admin
 */
class CarbonBreadcrumbAdminCurrentDirTest extends WP_UnitTestCase {

	public function setUp() {
		$this->admin = $this->getMock('Carbon_Breadcrumb_Admin', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->admin );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::current_dir
	 */
	public function testCurrentDir() {
		$expected = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . DIRECTORY_SEPARATOR . 'admin';
		$actual = $this->admin->current_dir();
		$this->assertSame( $expected, $actual );
	}

}
