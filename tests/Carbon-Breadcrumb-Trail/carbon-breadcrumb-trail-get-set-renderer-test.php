<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetSetRendererTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->getMock();
		$this->trail    = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->renderer );
		unset( $this->trail );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::get_renderer().
	 *
	 * @covers Carbon_Breadcrumb_Trail::get_renderer
	 * @covers Carbon_Breadcrumb_Trail::set_renderer
	 */
	public function testGetSetRenderer() {
		$this->trail->set_renderer( $this->renderer );
		$this->assertSame( $this->renderer, $this->trail->get_renderer() );
	}

}
