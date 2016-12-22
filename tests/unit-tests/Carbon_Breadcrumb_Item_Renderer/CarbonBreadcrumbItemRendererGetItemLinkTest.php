<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetItemLinkTest extends WP_UnitTestCase {

	public function custom_link_filter($old_link = '') {
		return 'http://another.example.net/bar/foo/';
	}

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');

		$this->item_renderer = $this->getMock('Carbon_Breadcrumb_Item_Renderer', null, array(), '', false);
		$this->item_renderer->set_item($this->item);

		$this->link = 'http://example.com/foo/bar/';
		$this->item->set_link( $this->link );
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item );
		unset( $this->item_renderer );
		unset( $this->link );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_item_link
	 */
	public function testLink() {
		$this->assertSame( $this->link, $this->item_renderer->get_item_link() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_item_link
	 */
	public function testLinkFilter() {
		add_filter( 'carbon_breadcrumbs_item_link', array( $this, 'custom_link_filter' ) );
		$this->assertSame( $this->custom_link_filter(), $this->item_renderer->get_item_link() );
		remove_filter( 'carbon_breadcrumbs_item_link', array( $this, 'custom_link_filter' ) );
	}

}