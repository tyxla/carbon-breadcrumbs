<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemGetSetTitleTest extends WP_UnitTestCase {
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
	 * @covers Carbon_Breadcrumb_Item::get_title
	 * @covers Carbon_Breadcrumb_Item::set_title
	 */
	public function testGetSetItems() {
		$expected = 'Foo Bar';
		$this->item->set_title( $expected );
		$this->assertSame( $expected, $this->item->get_title() );
	}

}
