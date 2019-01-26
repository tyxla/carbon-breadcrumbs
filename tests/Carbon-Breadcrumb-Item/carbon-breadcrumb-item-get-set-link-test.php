<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemGetSetLinkTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item::get_link().
	 *
	 * @covers Carbon_Breadcrumb_Item::get_link
	 * @covers Carbon_Breadcrumb_Item::set_link
	 */
	public function testGetSetItems() {
		$expected = 'http://example.com';
		$this->item->set_link( $expected );
		$this->assertSame( $expected, $this->item->get_link() );
	}

}
