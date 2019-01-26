<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetSetItemsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::get_items
	 * @covers Carbon_Breadcrumb_Trail::set_items
	 */
	public function testGetSetItems() {
		$expected = array( $this->item );
		$this->trail->set_items( $expected );
		$this->assertSame( $expected, $this->trail->get_items() );
	}

}