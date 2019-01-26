<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetDisplayHomeItemTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail_renderer = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Trail_Renderer' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail_renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_display_home_item
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_display_home_item
	 */
	public function testNonBool() {
		$this->trail_renderer->set_display_home_item( 0 );
		$this->assertSame( false, $this->trail_renderer->get_display_home_item() );

		$this->trail_renderer->set_display_home_item( '' );
		$this->assertSame( false, $this->trail_renderer->get_display_home_item() );

		$this->trail_renderer->set_display_home_item( 1 );
		$this->assertSame( true, $this->trail_renderer->get_display_home_item() );

		$this->trail_renderer->set_display_home_item( 'foo' );
		$this->assertSame( true, $this->trail_renderer->get_display_home_item() );
	}

}
