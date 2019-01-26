<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailConstruct extends WP_UnitTestCase {

	public function customRenderer() {
		return 'Carbon_Breadcrumb_Trail_Renderer_Custom';
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail::__construct
	 */
	public function testDefaultRenderer() {
		$this->trail->__construct();

		$this->assertInstanceOf( 'Carbon_Breadcrumb_Trail_Renderer', $this->trail->get_renderer() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail::__construct
	 */
	public function testCustomRenderer() {
		$this->trail->__construct(
			array(
				'renderer' => 'Carbon_Breadcrumb_Trail_Renderer_Custom',
			)
		);

		$this->assertInstanceOf( 'Carbon_Breadcrumb_Trail_Renderer_Custom', $this->trail->get_renderer() );
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Trail_Renderer', $this->trail->get_renderer() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail::__construct
	 */
	public function testCustomRendererFilter() {
		add_filter( 'carbon_breadcrumbs_renderer_class', array( $this, 'customRenderer' ) );

		$this->trail->__construct(
			array(
				'renderer' => 'Carbon_Breadcrumb_Trail_Renderer',
			)
		);

		$this->assertInstanceOf( 'Carbon_Breadcrumb_Trail_Renderer_Custom', $this->trail->get_renderer() );

		remove_filter( 'carbon_breadcrumbs_renderer_class', array( $this, 'customRenderer' ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail::__construct
	 */
	public function testRendererSettings() {
		$glue = ' => ';
		$this->trail->__construct(
			array(
				'glue' => $glue,
			)
		);

		$this->assertSame( $glue, $this->trail->get_renderer()->get_glue() );
	}

}

class Carbon_Breadcrumb_Trail_Renderer_Custom extends Carbon_Breadcrumb_Trail_Renderer {

}
