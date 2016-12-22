<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetWrapperAfterTest extends WP_UnitTestCase {

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_wrapper_after
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_wrapper_after
	 */
	public function testGetSetRenderer() {
		$wrapper_after = 'foobar';
		$this->renderer->set_wrapper_after( $wrapper_after );
		$this->assertSame( $wrapper_after, $this->renderer->get_wrapper_after() );
	}

}