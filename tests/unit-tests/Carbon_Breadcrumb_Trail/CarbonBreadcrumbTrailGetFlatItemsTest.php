<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetFlatItemsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::get_flat_items
	 */
	public function testGetFlatItems() {
		$original = array( 5 => array( $this->item ), 1000 => array( $this->item ) );
		$this->trail->set_items( $original );
		$expected = array( $this->item, $this->item );
		$this->assertSame( $expected, $this->trail->get_flat_items() );
	}

}