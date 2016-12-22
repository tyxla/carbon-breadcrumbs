<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererRenderLinkBeforeTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item_renderer = $this->getMock('Carbon_Breadcrumb_Item_Renderer', array('is_link_enabled'), array(), '', false);
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->trail_renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null, array(), '', false);

		$this->item_renderer->set_item( $this->item );
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );

		$this->link = 'http://example.com/foo/bar/';
		$this->link_before = '<span class="foo">';
		$this->trail_renderer->set_link_before($this->link_before);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item_renderer );
		unset( $this->item );
		unset( $this->trail_renderer );
		unset( $this->link );
		unset( $this->link_before );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_link_before
	 */
	public function testWithNoLink() {
		$this->item->set_link('');

		$this->item_renderer
			->expects($this->any())
			->method('is_link_enabled')
			->will($this->returnValue(true));

		$this->assertSame( $this->link_before, $this->item_renderer->render_link_before() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_link_before
	 */
	public function testWithLinkDisabled() {
		$this->item->set_link($this->link);

		$this->item_renderer
			->expects($this->any())
			->method('is_link_enabled')
			->will($this->returnValue(false));

		$this->assertSame( $this->link_before, $this->item_renderer->render_link_before() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_link_before
	 */
	public function testWithLinkEnabled() {
		$this->item->set_link($this->link);
		
		$this->item_renderer
			->expects($this->any())
			->method('is_link_enabled')
			->will($this->returnValue(true));

		$expected = $this->link_before . '<a href="' . $this->link . '"' . $this->item_renderer->get_item_attributes_html() . '>';
		$this->assertSame( $expected, $this->item_renderer->render_link_before() );
	}

}