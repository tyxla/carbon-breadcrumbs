<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetTotalItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->item1 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item2 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item3 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
		unset( $this->item1 );
		unset( $this->item2 );
		unset( $this->item3 );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::get_total_items().
	 *
	 * @covers Carbon_Breadcrumb_Trail::get_total_items
	 */
	public function testTotalItems() {
		$this->item1->set_priority( 750 );
		$this->item2->set_priority( 500 );
		$this->item3->set_priority( 750 );

		$this->trail->add_item( array( $this->item1, $this->item2, $this->item3 ) );

		$this->assertSame( 3, $this->trail->get_total_items() );
	}

}
