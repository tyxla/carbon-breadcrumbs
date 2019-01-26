<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererRenderTitleTest extends WP_UnitTestCase {

	public function custom_item_title_filter($title = '') {
		return 'Foo Bar Example Here';
	}

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->title = 'Demo Title';
		$this->item->set_title($this->title);

		$this->trail_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( array( 'get_title_before', 'get_title_after' ) )->disableOriginalConstructor()->getMock();
		$this->title_before = '<span class="before">';
		$this->title_after = '</span>';
		$this->trail_renderer
			->expects($this->any())
			->method('get_title_before')
			->will($this->returnValue($this->title_before));
		$this->trail_renderer
			->expects($this->any())
			->method('get_title_after')
			->will($this->returnValue($this->title_after));

		$this->item_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->item_renderer->set_item($this->item);
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );
	}

	public function tearDown() {
		unset( $this->item );
		unset( $this->title );
		unset( $this->trail_renderer );
		unset( $this->title_before );
		unset( $this->title_after );
		unset( $this->item_renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_title
	 */
	public function testWithoutFilter() {
		$expected = $this->title_before . $this->title . $this->title_after;
		$this->assertSame( $expected, $this->item_renderer->render_title() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_title
	 */
	public function testWithFilter() {
		add_filter( 'carbon_breadcrumbs_item_title', array( $this, 'custom_item_title_filter' ) );

		$expected = $this->title_before . $this->custom_item_title_filter() . $this->title_after;
		$this->assertSame( $expected, $this->item_renderer->render_title() );

		remove_filter( 'carbon_breadcrumbs_item_attributes', array( $this, 'custom_item_title_filter' ) );
	}

}