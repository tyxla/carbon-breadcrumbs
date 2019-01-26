<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetSetItemsTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Trail::get_items().
	 *
	 * @covers Carbon_Breadcrumb_Trail::get_items
	 * @covers Carbon_Breadcrumb_Trail::set_items
	 */
	public function testGetSetItems() {
		$expected = array( $this->item );
		$this->trail->set_items( $expected );
		$this->assertSame( $expected, $this->trail->get_items() );
	}

}
