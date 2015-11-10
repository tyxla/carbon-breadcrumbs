<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemPostSetupTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item_Post');
	}

	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Post::setup
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage The post breadcrumb items must have post ID specified.
	 */
	public function testSetupWithoutId() {
		$this->item->setup();
	}

}