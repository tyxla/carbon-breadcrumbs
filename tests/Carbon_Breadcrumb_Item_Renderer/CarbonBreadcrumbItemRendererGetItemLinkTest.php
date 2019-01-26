<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetItemLinkTest extends WP_UnitTestCase {

	public function custom_link_filter( $old_link = '' ) {
		return 'http://another.example.net/bar/foo/';
	}

	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );

		$this->item_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->item_renderer->set_item( $this->item );

		$this->link = 'http://example.com/foo/bar/';
		$this->item->set_link( $this->link );
	}

	public function tearDown() {
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
