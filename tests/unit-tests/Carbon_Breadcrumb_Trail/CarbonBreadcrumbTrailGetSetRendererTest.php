<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetSetRendererTest extends WP_UnitTestCase {

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null);
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
	}

	public function tearDown() {
		unset( $this->renderer );
		unset( $this->trail );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::get_renderer
	 * @covers Carbon_Breadcrumb_Trail::set_renderer
	 */
	public function testGetSetRenderer() {
		$this->trail->set_renderer( $this->renderer );
		$this->assertSame( $this->renderer, $this->trail->get_renderer() );
	}

}