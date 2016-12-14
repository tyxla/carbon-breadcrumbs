<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemGetSetSubtypeTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item::get_subtype
	 * @covers Carbon_Breadcrumb_Item::set_subtype
	 */
	public function testGetSetSubtype() {
		$expected = 'foo_bar';
		$this->item->set_subtype( $expected );
		$this->assertSame( $expected, $this->item->get_subtype() );
	}

}