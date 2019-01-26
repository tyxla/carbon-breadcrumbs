<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetTitleAfterTest extends WP_UnitTestCase {

	public function setUp() {
		$this->renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->getMock();
	}

	public function tearDown() {
		unset( $this->renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_title_after
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_title_after
	 */
	public function testGetSetRenderer() {
		$title_after = 'foobar';
		$this->renderer->set_title_after( $title_after );
		$this->assertSame( $title_after, $this->renderer->get_title_after() );
	}

}