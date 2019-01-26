<?php
/**
 * Tests for Carbon_Breadcrumb_Locator::set_subtype() and Carbon_Breadcrumb_Locator::get_subtype()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Locator::set_subtype() and Carbon_Breadcrumb_Locator::get_subtype()
 *
 * @group locator
 */
class CarbonBreadcrumbLocatorGetSetSubtypeTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator', array( 'test1', 'test2' ) );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator::get_subtype().
	 *
	 * @covers Carbon_Breadcrumb_Locator::get_subtype
	 * @covers Carbon_Breadcrumb_Locator::set_subtype
	 */
	public function testGetSetSubtype() {
		$expected = 'foo_bar';
		$this->locator->set_subtype( $expected );
		$this->assertSame( $expected, $this->locator->get_subtype() );
	}

}
