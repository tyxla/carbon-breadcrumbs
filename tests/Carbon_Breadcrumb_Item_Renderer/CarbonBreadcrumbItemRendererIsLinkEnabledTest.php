<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererIsLinkEnabledTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item1 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item2 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );

		$this->trail          = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Trail' );
		$this->trail_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();

		$this->item_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	public function tearDown() {
		unset( $this->item1 );
		unset( $this->item2 );

		unset( $this->trail );
		unset( $this->trail_renderer );

		unset( $this->item_renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::is_link_enabled
	 */
	public function testWithOnlyLastItemLinkEnabled() {
		$this->trail_renderer->set_last_item_link( true );

		$this->trail->add_item(
			array(
				$this->item1,
			)
		);

		$this->item_renderer->set_item( $this->item1 );
		$this->item_renderer->set_trail( $this->trail );
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );
		$this->item_renderer->set_index( 1 );

		$this->assertTrue( $this->item_renderer->is_link_enabled() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::is_link_enabled
	 */
	public function testWithOnlyNotTheLastItem() {
		$this->trail_renderer->set_last_item_link( false );

		$this->trail->add_item(
			array(
				$this->item1,
				$this->item2,
			)
		);

		$this->item_renderer->set_item( $this->item1 );
		$this->item_renderer->set_trail( $this->trail );
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );
		$this->item_renderer->set_index( 1 );

		$this->assertTrue( $this->item_renderer->is_link_enabled() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Renderer::is_link_enabled
	 */
	public function testWithEverythingDisabled() {
		$this->trail_renderer->set_last_item_link( false );

		$this->trail->add_item(
			array(
				$this->item1,
				$this->item2,
			)
		);

		$this->item_renderer->set_item( $this->item1 );
		$this->item_renderer->set_trail( $this->trail );
		$this->item_renderer->set_trail_renderer( $this->trail_renderer );
		$this->item_renderer->set_index( 2 );

		$this->assertFalse( $this->item_renderer->is_link_enabled() );
	}

}
