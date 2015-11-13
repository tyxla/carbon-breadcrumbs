<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetTotalItemsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->item1 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item2 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item3 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item1 );
		unset( $this->item2 );
		unset( $this->item3 );
	}

	/**
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