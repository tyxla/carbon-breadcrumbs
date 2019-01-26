<?php
/**
 * Tests for Carbon_Breadcrumb_Item::get_title() and Carbon_Breadcrumb_Item::set_title()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item::get_title() and Carbon_Breadcrumb_Item::set_title()
 *
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
	 * Tests for Carbon_Breadcrumb_Item::get_title().
	 *
	 * @covers Carbon_Breadcrumb_Item::get_title
	 * @covers Carbon_Breadcrumb_Item::set_title
	 */
	public function testGetSetItems() {
		$expected = 'Foo Bar';
		$this->item->set_title( $expected );
		$this->assertSame( $expected, $this->item->get_title() );
	}

}
