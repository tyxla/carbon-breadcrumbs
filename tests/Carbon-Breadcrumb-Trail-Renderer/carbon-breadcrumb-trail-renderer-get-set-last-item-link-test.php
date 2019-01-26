<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_last_item_link() and Carbon_Breadcrumb_Trail_Renderer::set_last_item_link()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::get_last_item_link() and Carbon_Breadcrumb_Trail_Renderer::set_last_item_link()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetLastItemLinkTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::get_last_item_link().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_last_item_link
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_last_item_link
	 */
	public function testNonBool() {
		$this->trail_renderer->set_last_item_link( 0 );
		$this->assertSame( false, $this->trail_renderer->get_last_item_link() );

		$this->trail_renderer->set_last_item_link( '' );
		$this->assertSame( false, $this->trail_renderer->get_last_item_link() );

		$this->trail_renderer->set_last_item_link( 1 );
		$this->assertSame( true, $this->trail_renderer->get_last_item_link() );

		$this->trail_renderer->set_last_item_link( 'foo' );
		$this->assertSame( true, $this->trail_renderer->get_last_item_link() );
	}

}
