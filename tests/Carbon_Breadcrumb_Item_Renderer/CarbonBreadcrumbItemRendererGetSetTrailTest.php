<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetSetTrailTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMockForAbstractClass('Carbon_Breadcrumb_Trail');
		$this->item_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item_renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_trail
	 * @covers Carbon_Breadcrumb_Item_Renderer::set_trail
	 */
	public function testGetSetTrail() {
		$this->item_renderer->set_trail( $this->trail );
		$this->assertSame( $this->trail, $this->item_renderer->get_trail() );
	}

}