<?php
/**
 * Tests for Carbon_Breadcrumb_Item::factory()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item::factory()
 *
 * @group item
 */
class CarbonBreadcrumbItemFactoryTest extends WP_UnitTestCase {
	/**
	 * Tests for Carbon_Breadcrumb_Item::factory().
	 *
	 * @covers Carbon_Breadcrumb_Item::factory
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage Unexisting breadcrumb item type: "foobar".
	 */
	public function testFactoryUnexistingClass() {
		Carbon_Breadcrumb_Item::factory( 'foobar' );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item::factory().
	 *
	 * @covers Carbon_Breadcrumb_Item::factory
	 */
	public function testFactoryDefaultSetup() {
		$item = Carbon_Breadcrumb_Item::factory();

		$this->assertSame( 'custom', $item->get_type() );
		$this->assertSame( 1000, $item->get_priority() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item::factory().
	 *
	 * @covers Carbon_Breadcrumb_Item::factory
	 */
	public function testFactoryCustomSetup() {
		$item = Carbon_Breadcrumb_Item::factory( 'post', 123 );

		$this->assertSame( 'post', $item->get_type() );
		$this->assertSame( 123, $item->get_priority() );
	}
}
