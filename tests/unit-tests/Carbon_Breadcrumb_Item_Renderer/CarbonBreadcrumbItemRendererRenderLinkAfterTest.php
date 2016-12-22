<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererRenderLinkAfterTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item_renderer = $this->getMock('Carbon_Breadcrumb_Item_Renderer', array('is_link_enabled'), array(), '', false);
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->trail_renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null, array(), '', false);

		$this->item_renderer->set_item( $this->item );
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );

		$this->link = 'http://example.com/foo/bar/';
		$this->link_after = '</span>';
		$this->trail_renderer->set_link_after($this->link_after);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item_renderer );
		unset( $this->item );
		unset( $this->trail_renderer );
		unset( $this->link );
		unset( $this->link_after );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_link_after
	 */
	public function testWithNoLink() {
		$this->item->set_link('');

		$this->item_renderer
			->expects($this->any())
			->method('is_link_enabled')
			->will($this->returnValue(true));

		$this->assertSame( $this->link_after, $this->item_renderer->render_link_after() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_link_after
	 */
	public function testWithLinkDisabled() {
		$this->item->set_link($this->link);

		$this->item_renderer
			->expects($this->any())
			->method('is_link_enabled')
			->will($this->returnValue(false));

		$this->assertSame( $this->link_after, $this->item_renderer->render_link_after() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::render_link_after
	 */
	public function testWithLinkEnabled() {
		$this->item->set_link($this->link);
		
		$this->item_renderer
			->expects($this->any())
			->method('is_link_enabled')
			->will($this->returnValue(true));

		$expected = '</a>' . $this->link_after;
		$this->assertSame( $expected, $this->item_renderer->render_link_after() );
	}

}