<?php
/**
 * Tests for Carbon_Breadcrumb_Item_Renderer::get_item() and Carbon_Breadcrumb_Item_Renderer::set_item()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item_Renderer::get_item() and Carbon_Breadcrumb_Item_Renderer::set_item()
 *
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetSetItemTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item          = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
		unset( $this->item_renderer );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Renderer::get_item().
	 *
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_item
	 * @covers Carbon_Breadcrumb_Item_Renderer::set_item
	 */
	public function testGetSetItem() {
		$this->item_renderer->set_item( $this->item );
		$this->assertSame( $this->item, $this->item_renderer->get_item() );
	}

}
