<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemUserSetupTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item_User');
	}

	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_User::setup
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage The author breadcrumb items must have author ID specified.
	 */
	public function testSetupWithoutId() {
		$this->item->setup();
	}

}