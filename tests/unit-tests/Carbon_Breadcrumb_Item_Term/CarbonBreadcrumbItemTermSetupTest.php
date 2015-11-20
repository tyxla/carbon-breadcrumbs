<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemTermSetupTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item_Term');
	}

	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Term::setup
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage The term breadcrumb items must have term ID specified.
	 */
	public function testSetupWithoutId() {
		$this->item->setup();
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Term::setup
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage The term breadcrumb items must have taxonomy specified.
	 */
	public function testSetupWithoutSubtype() {
		$this->item->set_id(123);
		$this->item->setup();
	}

}