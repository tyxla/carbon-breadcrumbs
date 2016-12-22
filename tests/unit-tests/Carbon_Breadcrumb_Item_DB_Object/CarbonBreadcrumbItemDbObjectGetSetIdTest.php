<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemDbObjectGetSetIdTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item_DB_Object');
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_DB_Object::get_id
	 * @covers Carbon_Breadcrumb_Item_DB_Object::set_id
	 */
	public function testGetSetPriority() {
		$expected = 123;
		$this->item->set_id( $expected );
		$this->assertSame( $expected, $this->item->get_id() );
	}

}