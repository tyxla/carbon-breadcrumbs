<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailGetSetItemsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
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