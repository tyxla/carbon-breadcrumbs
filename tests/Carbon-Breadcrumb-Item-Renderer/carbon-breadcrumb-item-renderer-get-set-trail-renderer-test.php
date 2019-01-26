<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetSetTrailRendererTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail_renderer = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Trail_Renderer' );
		$this->item_renderer  = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail_renderer );
		unset( $this->item_renderer );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Renderer::get_trail_renderer().
	 *
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_trail_renderer
	 * @covers Carbon_Breadcrumb_Item_Renderer::set_trail_renderer
	 */
	public function testGetSetTrailRenderer() {
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );
		$this->assertSame( $this->trail_renderer, $this->item_renderer->get_trail_renderer() );
	}

}
