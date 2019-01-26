<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_link_before() and Carbon_Breadcrumb_Trail_Renderer::set_link_before()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_link_before() and Carbon_Breadcrumb_Trail_Renderer::set_link_before()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetLinkBeforeTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_link_before().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_link_before
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_link_before
	 */
	public function testGetSetRenderer() {
		$link_before = 'foobar';
		$this->renderer->set_link_before( $link_before );
		$this->assertSame( $link_before, $this->renderer->get_link_before() );
	}

}
