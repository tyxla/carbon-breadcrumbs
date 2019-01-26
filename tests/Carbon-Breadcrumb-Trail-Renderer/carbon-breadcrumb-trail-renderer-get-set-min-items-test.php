<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_min_items() and Carbon_Breadcrumb_Trail_Renderer::set_min_items()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_min_items() and Carbon_Breadcrumb_Trail_Renderer::set_min_items()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetMinItemsTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_min_items().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_min_items
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_min_items
	 */
	public function testGetSetRenderer() {
		$min_items = 5;
		$this->renderer->set_min_items( $min_items );
		$this->assertSame( $min_items, $this->renderer->get_min_items() );
	}

}
