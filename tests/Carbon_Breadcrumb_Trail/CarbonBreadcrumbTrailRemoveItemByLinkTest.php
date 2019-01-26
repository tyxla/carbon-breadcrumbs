<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailRemoveItemByLinkTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->item1 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item2 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item3 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');

		$this->item1->set_link( '' );
		$this->item2->set_link( '#1' );
		$this->item3->set_link( '#12' );

		$this->trail->add_item(array(
			$this->item1,
			$this->item2,
			$this->item3,
		));
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item1 );
		unset( $this->item2 );
		unset( $this->item3 );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_link
	 */
	public function testRemoveItemByLinkEmpty() {
		$this->trail->remove_item_by_link();

		$expected = array(
			$this->item1->get_priority() => array(
				1 => $this->item2,
				2 => $this->item3,
			)
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_link
	 */
	public function testRemoveItemByLinkSpecific() {
		$this->trail->remove_item_by_link('#1');

		$expected = array(
			$this->item1->get_priority() => array(
				0 => $this->item1,
				2 => $this->item3,
			)
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

}