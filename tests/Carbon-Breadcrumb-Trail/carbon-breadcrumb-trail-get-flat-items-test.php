<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetFlatItemsTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail::get_flat_items().
	 *
	 * @covers Carbon_Breadcrumb_Trail::get_flat_items
	 */
	public function testGetFlatItems() {
		$original = array(
			5    => array( $this->item ),
			1000 => array( $this->item ),
		);
		$this->trail->set_items( $original );
		$expected = array( $this->item, $this->item );
		$this->assertSame( $expected, $this->trail->get_flat_items() );
	}

}
