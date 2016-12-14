<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemConstructTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item', array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item::__construct
	 */
	public function testConstructor() {
		$this->item->__construct(123);
		$this->assertSame( 123, $this->item->get_priority() );
	}

}