<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_glue() and Carbon_Breadcrumb_Trail_Renderer::set_glue()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_glue() and Carbon_Breadcrumb_Trail_Renderer::set_glue()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetGlueTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_glue().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_glue
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_glue
	 */
	public function testGetSetRenderer() {
		$glue = 'foobar';
		$this->renderer->set_glue( $glue );
		$this->assertSame( $glue, $this->renderer->get_glue() );
	}

}
