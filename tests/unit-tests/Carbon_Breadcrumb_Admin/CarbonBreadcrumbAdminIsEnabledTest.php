<?php
/**
 * @group admin
 */
class CarbonBreadcrumbAdminIsEnabledTest extends WP_UnitTestCase {

	public function setUp() {
		$this->admin = $this->getMock('Carbon_Breadcrumb_Admin', array('current_dir'), array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->admin );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 */
	public function testWithNoEnabledConditions() {
		$this->admin->expects($this->any())
			->method('current_dir')
			->will($this->returnValue(ABSPATH));

		$this->assertFalse( $this->admin->is_enabled() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 */
	public function testWhenInstalledAsPlugin() {
		$plugins_path = untrailingslashit( ABSPATH ) . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins';
		$this->admin->expects($this->any())
			->method('current_dir')
			->will($this->returnValue($plugins_path));

		$this->assertTrue( $this->admin->is_enabled() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 */
	public function testWithAdminConstantDefined() {
		$this->admin->expects($this->any())
			->method('current_dir')
			->will($this->returnValue(ABSPATH));

		define('CARBON_BREADCRUMB_ENABLE_ADMIN', true);

		$this->assertTrue( $this->admin->is_enabled() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin::is_enabled
	 */
	public function testWithEnablingFilter() {
		$this->admin->expects($this->any())
			->method('current_dir')
			->will($this->returnValue(ABSPATH));

		add_filter( 'carbon_breadcrumb_enable_admin', array( $this, '__return_true' ) );

		$this->assertTrue( $this->admin->is_enabled() );
		
		remove_filter( 'carbon_breadcrumb_enable_admin', array( $this, '__return_true' ) );
	}

	public function __return_true() {
		return true;
	}

}
