<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetWrapperBeforeTest extends WP_UnitTestCase {

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null);
	}

	public function tearDown() {
		unset( $this->renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_wrapper_before
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_wrapper_before
	 */
	public function testGetSetRenderer() {
		$wrapper_before = 'foobar';
		$this->renderer->set_wrapper_before( $wrapper_before );
		$this->assertSame( $wrapper_before, $this->renderer->get_wrapper_before() );
	}

}