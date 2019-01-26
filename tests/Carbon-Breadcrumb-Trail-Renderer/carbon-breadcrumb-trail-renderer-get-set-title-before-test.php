<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetTitleBeforeTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_title_before().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_title_before
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_title_before
	 */
	public function testGetSetRenderer() {
		$title_before = 'foobar';
		$this->renderer->set_title_before( $title_before );
		$this->assertSame( $title_before, $this->renderer->get_title_before() );
	}

}
