<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererRenderItemsTest extends WP_UnitTestCase {
	public function carbon_breadcrumbs_item($item, $trail, $renderer, $counter) {
		$item->testvalue = 123;
		return $item;
	}

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', array('get_priority'), array(), '', false);
		$this->renderer->expects($this->any())
			->method('get_priority')
			->will($this->returnValue(1000));

		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);

		$this->item1 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item2 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');

		$this->item1->set_title( 'Foo' );
		$this->item2->set_title( 'Bar' );

		$this->item1->set_link( '#0' );
		$this->item2->set_link( '#1' );

		$this->trail->add_item(array(
			$this->item1,
			$this->renderer,
			$this->item2,
		));
	}

	public function tearDown() {
		unset( $this->renderer );
		unset( $this->trail );
		unset( $this->item1 );
		unset( $this->item2 );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::render_items
	 */
	public function testDefaultOutput() {
		$renderer1 = new Carbon_Breadcrumb_Item_Renderer($this->item1, $this->trail, $this->renderer, 1);
		$renderer2 = new Carbon_Breadcrumb_Item_Renderer($this->item2, $this->trail, $this->renderer, 2);

		$expected = array(
			$renderer1->render(),
			$renderer2->render(),
		);
		$actual = $this->renderer->render_items($this->trail);
		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::render_items
	 */
	public function testItemFilter() {
		add_filter( 'carbon_breadcrumbs_item', array($this, 'carbon_breadcrumbs_item'), 10, 4 );

		$this->renderer->render_items($this->trail);

		$this->assertSame( 123, $this->item1->testvalue );
		$this->assertSame( 123, $this->item2->testvalue );

		remove_filter( 'carbon_breadcrumbs_item', array($this, 'carbon_breadcrumbs_item'), 10, 4 );
	}

}