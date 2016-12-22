<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemGetSetLinkTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item::get_link
	 * @covers Carbon_Breadcrumb_Item::set_link
	 */
	public function testGetSetItems() {
		$expected = 'http://example.com';
		$this->item->set_link( $expected );
		$this->assertSame( $expected, $this->item->get_link() );
	}

}