<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailRemoveItemByPriorityTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->trail );
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_priority
	 */
	public function testWithDefaultPriority() {
		$original = array( 
			5 => array( $this->item ), 
			0 => array( $this->item ), 
			1000 => array( $this->item ),
		);
		$this->trail->set_items( $original );

		$this->trail->remove_item_by_priority();

		$expected = array( 
			5 => array( $this->item ), 
			1000 => array( $this->item ) 
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::remove_item_by_priority
	 */
	public function testWithCustomPriority() {
		$original = array( 
			5 => array( $this->item ), 
			0 => array( $this->item ), 
			1000 => array( $this->item ),
		);
		$this->trail->set_items( $original );

		$this->trail->remove_item_by_priority( 5 );

		$expected = array( 
			0 => array( $this->item ), 
			1000 => array( $this->item ) 
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

}