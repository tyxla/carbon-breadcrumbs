<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_home_item_title() and Carbon_Breadcrumb_Trail_Renderer::set_home_item_title()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_home_item_title() and Carbon_Breadcrumb_Trail_Renderer::set_home_item_title()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetHomeItemTitleTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_home_item_title().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_home_item_title
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_home_item_title
	 */
	public function testGetSetRenderer() {
		$home_item_title = 'Foo Bar';
		$this->renderer->set_home_item_title( $home_item_title );
		$this->assertSame( $home_item_title, $this->renderer->get_home_item_title() );
	}

}
