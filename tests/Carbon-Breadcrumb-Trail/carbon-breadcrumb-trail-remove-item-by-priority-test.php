<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailRemoveItemByPriorityTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->item  = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_priority
	 */
	public function testWithDefaultPriority() {
		$original = array(
			5    => array( $this->item ),
			0    => array( $this->item ),
			1000 => array( $this->item ),
		);
		$this->trail->set_items( $original );

		$this->trail->remove_item_by_priority();

		$expected = array(
			5    => array( $this->item ),
			1000 => array( $this->item ),
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_priority
	 */
	public function testWithCustomPriority() {
		$original = array(
			5    => array( $this->item ),
			0    => array( $this->item ),
			1000 => array( $this->item ),
		);
		$this->trail->set_items( $original );

		$this->trail->remove_item_by_priority( 5 );

		$expected = array(
			0    => array( $this->item ),
			1000 => array( $this->item ),
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

}
