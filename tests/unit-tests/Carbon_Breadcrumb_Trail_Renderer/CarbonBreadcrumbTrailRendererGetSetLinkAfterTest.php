<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetLinkAfterTest extends WP_UnitTestCase {

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null);
	}

	public function tearDown() {
		unset( $this->renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_link_after
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_link_after
	 */
	public function testGetSetRenderer() {
		$link_after = 'foobar';
		$this->renderer->set_link_after( $link_after );
		$this->assertSame( $link_after, $this->renderer->get_link_after() );
	}

}