<?php
/**
 * Tests for Carbon_Breadcrumb_Item::get_subtype() and Carbon_Breadcrumb_Item::set_subtype()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item::get_subtype() and Carbon_Breadcrumb_Item::set_subtype()
 *
 * @group item
 */
class CarbonBreadcrumbItemGetSetSubtypeTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Item::get_subtype().
	 *
	 * @covers Carbon_Breadcrumb_Item::get_subtype
	 * @covers Carbon_Breadcrumb_Item::set_subtype
	 */
	public function testGetSetSubtype() {
		$expected = 'foo_bar';
		$this->item->set_subtype( $expected );
		$this->assertSame( $expected, $this->item->get_subtype() );
	}

}
