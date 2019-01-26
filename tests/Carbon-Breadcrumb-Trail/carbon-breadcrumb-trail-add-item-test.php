<?php
/**
 * Tests for Carbon_Breadcrumb_Trail::add_item()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail::add_item()
 *
 * @group trail
 */
class CarbonBreadcrumbTrailAddItemTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->item1 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item2 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item3 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );

		$this->item1->set_priority( 750 );
		$this->item2->set_priority( 500 );
		$this->item3->set_priority( 750 );
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
	 * Tests for Carbon_Breadcrumb_Trail::add_item().
	 *
	 * @covers Carbon_Breadcrumb_Trail::add_item
	 */
	public function testAddArrayOfItems() {
		$this->trail->set_items(
			array(
				750 => array( $this->item1 ),
			)
		);
		$this->trail->add_item( array( $this->item2, $this->item3 ) );

		$expected = array(
			750 => array( $this->item1, $this->item3 ),
			500 => array( $this->item2 ),
		);
		$actual   = $this->trail->get_items();
		$this->assertSame( $expected, $actual );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::add_item().
	 *
	 * @covers Carbon_Breadcrumb_Trail::add_item
	 */
	public function testAddSingleItem() {
		$this->trail->set_items(
			array(
				750 => array( $this->item1 ),
			)
		);
		$this->trail->add_item( $this->item2 );

		$expected = array(
			750 => array( $this->item1 ),
			500 => array( $this->item2 ),
		);
		$actual   = $this->trail->get_items();
		$this->assertSame( $expected, $actual );
	}

}
