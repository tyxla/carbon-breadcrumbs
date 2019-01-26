<?php
/**
 * Tests for Carbon_Breadcrumb_Item_DB_Object::get_id() and Carbon_Breadcrumb_Item_DB_Object::set_id()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item_DB_Object::get_id() and Carbon_Breadcrumb_Item_DB_Object::set_id()
 *
 * @group item
 */
class CarbonBreadcrumbItemDbObjectGetSetIdTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_DB_Object' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_DB_Object::get_id().
	 *
	 * @covers Carbon_Breadcrumb_Item_DB_Object::get_id
	 * @covers Carbon_Breadcrumb_Item_DB_Object::set_id
	 */
	public function testGetSetPriority() {
		$expected = 123;
		$this->item->set_id( $expected );
		$this->assertSame( $expected, $this->item->get_id() );
	}

}
