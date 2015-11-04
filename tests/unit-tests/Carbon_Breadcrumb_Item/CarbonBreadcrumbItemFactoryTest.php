<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemFactoryTest extends WP_UnitTestCase {

	/**
	 * @covers Carbon_Breadcrumb_Item::factory
	 * @expectedException Carbon_Breadcrumb_Exception
	 */
	public function testFactoryUnexistingClass() {
		Carbon_Breadcrumb_Item::factory('foobar');
	}

	/**
	 * @covers Carbon_Breadcrumb_Item::factory
	 */
	public function testFactoryDefaultSetup() {
		$item = Carbon_Breadcrumb_Item::factory();

		$this->assertSame( 'custom', $item->get_type() );
		$this->assertSame( 1000, $item->get_priority() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item::factory
	 */
	public function testFactoryCustomSetup() {
		$item = Carbon_Breadcrumb_Item::factory( 'post', 123 );

		$this->assertSame( 'post', $item->get_type() );
		$this->assertSame( 123, $item->get_priority() );
	}

}