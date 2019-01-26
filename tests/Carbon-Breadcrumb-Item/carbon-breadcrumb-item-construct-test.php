<?php
/**
 * Tests for Carbon_Breadcrumb_Item::__construct()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item::__construct()
 *
 * @group item
 */
class CarbonBreadcrumbItemConstructTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item', array(), '', false );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Item::__construct
	 */
	public function testConstructor() {
		$this->item->__construct( 123 );
		$this->assertSame( 123, $this->item->get_priority() );
	}

}
