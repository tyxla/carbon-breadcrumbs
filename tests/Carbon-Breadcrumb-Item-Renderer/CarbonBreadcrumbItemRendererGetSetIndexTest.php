<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetSetIndexTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	public function tearDown() {
		unset( $this->item_renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_index
	 * @covers Carbon_Breadcrumb_Item_Renderer::set_index
	 */
	public function testGetSetIndexDefault() {
		$this->item_renderer->set_index();
		$this->assertSame( 0, $this->item_renderer->get_index() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_index
	 * @covers Carbon_Breadcrumb_Item_Renderer::set_index
	 */
	public function testGetSetIndexSpecific() {
		$this->item_renderer->set_index( 5 );
		$this->assertSame( 5, $this->item_renderer->get_index() );
	}

}
