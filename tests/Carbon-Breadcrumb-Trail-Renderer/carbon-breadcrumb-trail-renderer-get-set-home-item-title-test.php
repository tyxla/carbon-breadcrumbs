<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetHomeItemTitleTest extends WP_UnitTestCase {

	public function setUp() {
		$this->renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->getMock();
	}

	public function tearDown() {
		unset( $this->renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_home_item_title
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_home_item_title
	 */
	public function testGetSetRenderer() {
		$home_item_title = 'Foo Bar';
		$this->renderer->set_home_item_title( $home_item_title );
		$this->assertSame( $home_item_title, $this->renderer->get_home_item_title() );
	}

}
