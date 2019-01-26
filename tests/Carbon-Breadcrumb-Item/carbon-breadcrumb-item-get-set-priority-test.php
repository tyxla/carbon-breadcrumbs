<?php
/**
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
	 * @covers Carbon_Breadcrumb_Item::get_priority
	 * @covers Carbon_Breadcrumb_Item::set_priority
	 */
	public function testGetSetPriority() {
		$expected = 987;
		$this->item->set_priority( $expected );
		$this->assertSame( $expected, $this->item->get_priority() );
	}

}
