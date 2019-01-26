<?php
/**
 * Tests for Carbon_Breadcrumb_Item::get_priority() and Carbon_Breadcrumb_Item::set_priority()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item::get_priority() and Carbon_Breadcrumb_Item::set_priority()
 *
 * @group item
 */
class CarbonBreadcrumbItemGetSetPriorityTest extends WP_UnitTestCase {
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
	 * Tests for Carbon_Breadcrumb_Item::get_priority().
	 *
	 * @covers Carbon_Breadcrumb_Item::get_priority
	 * @covers Carbon_Breadcrumb_Item::set_priority
	 */
	public function testGetSetPriority() {
		$expected = 987;
		$this->item->set_priority( $expected );
		$this->assertSame( $expected, $this->item->get_priority() );
	}

}
