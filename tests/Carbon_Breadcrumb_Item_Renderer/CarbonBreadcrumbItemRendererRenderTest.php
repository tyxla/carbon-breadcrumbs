<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererRenderTest extends WP_UnitTestCase {

	public function carbon_breadcrumbs_item_output($item_output) {
		return $item_output . 'foobar';
	}

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item->set_title( 'Foo' );
		$this->item->set_link( '#' );

		$this->trail = $this->getMockForAbstractClass('Carbon_Breadcrumb_Trail');
		$this->trail_renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null, array(), '', false);

		$args = array(
			$this->item,
			$this->trail,
			$this->trail_renderer,
			0
		);
		$this->item_renderer = $this->getMock('Carbon_Breadcrumb_Item_Renderer', null, $args);

		$this->trail->add_item($this->item);
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item );
		unset( $this->item_renderer );
		unset( $this->trail_renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render
	 */
	public function testDefaultOutput() {
		$expected = $this->item_renderer->render_link_before();
		$expected .= $this->item_renderer->render_title();
		$expected .= $this->item_renderer->render_link_after();

		$this->assertSame( $expected, $this->item_renderer->render() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render
	 */
	public function testFilteredOutput() {
		add_filter( 'carbon_breadcrumbs_item_output', array( $this, 'carbon_breadcrumbs_item_output' ) );

		$expected = $this->item_renderer->render_link_before();
		$expected .= $this->item_renderer->render_title();
		$expected .= $this->item_renderer->render_link_after();
		$expected = $this->carbon_breadcrumbs_item_output($expected);

		$this->assertSame( $expected, $this->item_renderer->render() );

		remove_filter( 'carbon_breadcrumbs_item_output', array( $this, 'carbon_breadcrumbs_item_output' ) );
	}

}