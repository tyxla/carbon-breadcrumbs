<?php
/**
 * Tests for Carbon_Breadcrumb_Admin::__construct()
 *
 * @group admin
 */
class CarbonBreadcrumbAdminConstructTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin' )->setMethods( array( 'is_enabled' ) )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::__construct
	 */
	public function testIncludeFiles() {
		$this->admin->__construct();
		$this->assertTrue( class_exists( 'Carbon_Breadcrumb_Admin_Settings' ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::__construct
	 */
	public function testWithEnabledAdmin() {
		$this->admin->expects( $this->once() )
			->method( 'is_enabled' )
			->will( $this->returnValue( true ) );

		$this->admin->__construct();

		$this->assertSame( 10, has_action( 'init', array( $this->admin, 'init' ) ) );
		$this->assertSame( 20, has_action( 'admin_menu', array( $this->admin, 'admin_menu' ) ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::__construct
	 */
	public function testWithDisabledAdmin() {
		$this->admin->expects( $this->once() )
			->method( 'is_enabled' )
			->will( $this->returnValue( false ) );

		$this->admin->__construct();

		$this->assertFalse( has_action( 'init', array( $this->admin, 'init' ) ) );
		$this->assertFalse( has_action( 'admin_menu', array( $this->admin, 'admin_menu' ) ) );
	}

}
