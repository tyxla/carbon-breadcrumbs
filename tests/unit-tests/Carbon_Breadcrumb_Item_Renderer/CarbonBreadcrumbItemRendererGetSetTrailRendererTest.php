<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetSetTrailRendererTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail_renderer = $this->getMockForAbstractClass('Carbon_Breadcrumb_Trail_Renderer');
		$this->item_renderer = $this->getMock('Carbon_Breadcrumb_Item_Renderer', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->trail_renderer );
		unset( $this->item_renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_trail_renderer
	 * @covers Carbon_Breadcrumb_Item_Renderer::set_trail_renderer
	 */
	public function testGetSetTrailRenderer() {
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );
		$this->assertSame( $this->trail_renderer, $this->item_renderer->get_trail_renderer() );
	}

}