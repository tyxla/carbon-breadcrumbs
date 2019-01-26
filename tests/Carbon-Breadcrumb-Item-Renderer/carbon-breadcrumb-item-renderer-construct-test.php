<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererConstructTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item           = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item_renderer  = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->trail          = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Trail' );
		$this->trail_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
		unset( $this->item );
		unset( $this->item_renderer );
		unset( $this->trail_renderer );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Renderer::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Item_Renderer::__construct
	 */
	public function testProperVariableSetting() {
		$this->item_renderer->__construct( $this->item, $this->trail, $this->trail_renderer, 5 );

		$this->assertSame( $this->item, $this->item_renderer->get_item() );
		$this->assertSame( $this->trail, $this->item_renderer->get_trail() );
		$this->assertSame( $this->trail_renderer, $this->item_renderer->get_trail_renderer() );
		$this->assertSame( 5, $this->item_renderer->get_index() );
	}

}
