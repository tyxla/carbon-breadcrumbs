<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailRemoveItemByMethodTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->item1 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item2 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item3 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );

		$this->item1->set_title( 'foo' );
		$this->item2->set_title( 'bar' );
		$this->item3->set_title( 'foobar' );

		$this->trail->add_item(
			array(
				$this->item1,
				$this->item2,
				$this->item3,
			)
		);
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item1 );
		unset( $this->item2 );
		unset( $this->item3 );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_method
	 */
	public function testRemoveItemByTitleEmpty() {
		$this->trail->remove_item_by_method( 'get_title', '' );

		$expected = array(
			$this->item1->get_priority() => array(
				0 => $this->item1,
				1 => $this->item2,
				2 => $this->item3,
			),
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_method
	 */
	public function testRemoveItemByTitleSpecific() {
		$this->trail->remove_item_by_method( 'get_title', 'foo' );

		$expected = array(
			$this->item1->get_priority() => array(
				1 => $this->item2,
				2 => $this->item3,
			),
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

}
