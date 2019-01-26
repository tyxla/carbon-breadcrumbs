<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_wrapper_after() and Carbon_Breadcrumb_Trail_Renderer::set_wrapper_after()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_wrapper_after() and Carbon_Breadcrumb_Trail_Renderer::set_wrapper_after()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetWrapperAfterTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_wrapper_after().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_wrapper_after
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_wrapper_after
	 */
	public function testGetSetRenderer() {
		$wrapper_after = 'foobar';
		$this->renderer->set_wrapper_after( $wrapper_after );
		$this->assertSame( $wrapper_after, $this->renderer->get_wrapper_after() );
	}

}
