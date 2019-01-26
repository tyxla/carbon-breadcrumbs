<?php
/**
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
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_min_items
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_min_items
	 */
	public function testGetSetRenderer() {
		$min_items = 5;
		$this->renderer->set_min_items( $min_items );
		$this->assertSame( $min_items, $this->renderer->get_min_items() );
	}

}
