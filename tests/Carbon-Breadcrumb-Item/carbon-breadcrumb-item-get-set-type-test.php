<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemGetSetTypeTest extends WP_UnitTestCase {
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
	 * @covers Carbon_Breadcrumb_Item::get_type
	 * @covers Carbon_Breadcrumb_Item::set_type
	 */
	public function testGetSetType() {
		$expected = 'fooBar';
		$this->item->set_type( $expected );
		$this->assertSame( $expected, $this->item->get_type() );
	}

}
