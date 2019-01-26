<?php
/**
 * Tests for Carbon_Breadcrumb_Item_Custom::setup()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item_Custom::setup()
 *
 * @group item
 */
class CarbonBreadcrumbItemCustomSetupTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_Custom', array(), '', false );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Custom::setup().
	 *
	 * @covers Carbon_Breadcrumb_Item_Custom::setup
	 */
	public function testConstructor() {
		$item_clone_a = clone $this->item;
		$item_clone_b = clone $this->item;
		$item_clone_a->setup();

		$expected = serialize( $item_clone_a );
		$actual   = serialize( $item_clone_b );
		$this->assertSame( $expected, $actual );
	}

}
