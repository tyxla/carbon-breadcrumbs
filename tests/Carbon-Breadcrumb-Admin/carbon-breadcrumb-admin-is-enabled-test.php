<?php
/**
 * Tests for Carbon_Breadcrumb_Admin::is_enabled()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Admin::is_enabled()
 *
 * @group admin
 */
class CarbonBreadcrumbAdminIsEnabledTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->admin = $this->getMockBuilder( 'Carbon_Breadcrumb_Admin' )->setMethods( array( 'current_dir' ) )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->admin );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::is_enabled().
	 *
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 */
	public function testWhenInstalledAsPlugin() {
		$plugins_path = untrailingslashit( ABSPATH ) . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins';
		$this->admin->expects( $this->any() )
			->method( 'current_dir' )
			->will( $this->returnValue( $plugins_path ) );

		$this->assertTrue( $this->admin->is_enabled() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::is_enabled().
	 *
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 * @runInSeparateProcess
	 */
	public function testWithAdminConstantDefined() {
		$this->admin->expects( $this->any() )
			->method( 'current_dir' )
			->will( $this->returnValue( ABSPATH ) );

		define( 'CARBON_BREADCRUMB_ENABLE_ADMIN', true );

		$this->assertTrue( $this->admin->is_enabled() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::is_enabled().
	 *
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 */
	public function testWithEnablingFilter() {
		$this->admin->expects( $this->any() )
			->method( 'current_dir' )
			->will( $this->returnValue( ABSPATH ) );

		add_filter( 'carbon_breadcrumb_enable_admin', array( $this, '__return_true' ) );

		$this->assertTrue( $this->admin->is_enabled() );

		remove_filter( 'carbon_breadcrumb_enable_admin', array( $this, '__return_true' ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Admin::is_enabled().
	 *
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 */
	public function testWithNoEnabledConditions() {
		$this->admin->expects( $this->any() )
			->method( 'current_dir' )
			->will( $this->returnValue( ABSPATH ) );

		$this->assertFalse( $this->admin->is_enabled() );
	}

	/**
	 * A stub function that always returns true.
	 *
	 * @return boolean
	 */
	public function __return_true() {
		return true;
	}

}
