<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_title_after() and Carbon_Breadcrumb_Trail_Renderer::set_title_after()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_title_after() and Carbon_Breadcrumb_Trail_Renderer::set_title_after()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetTitleAfterTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_title_after().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_title_after
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_title_after
	 */
	public function testGetSetRenderer() {
		$title_after = 'foobar';
		$this->renderer->set_title_after( $title_after );
		$this->assertSame( $title_after, $this->renderer->get_title_after() );
	}

}
