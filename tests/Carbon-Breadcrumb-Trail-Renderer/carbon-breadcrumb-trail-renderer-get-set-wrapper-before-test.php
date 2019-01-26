<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_wrapper_before() and Carbon_Breadcrumb_Trail_Renderer::set_wrapper_before()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_wrapper_before() and Carbon_Breadcrumb_Trail_Renderer::set_wrapper_before()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetWrapperBeforeTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->renderer );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_wrapper_before().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_wrapper_before
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_wrapper_before
	 */
	public function testGetSetRenderer() {
		$wrapper_before = 'foobar';
		$this->renderer->set_wrapper_before( $wrapper_before );
		$this->assertSame( $wrapper_before, $this->renderer->get_wrapper_before() );
	}

}
