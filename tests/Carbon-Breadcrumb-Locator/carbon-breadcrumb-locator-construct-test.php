<?php
/**
 * Tests for Carbon_Breadcrumb_Locator::__construct()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Locator::__construct()
 *
 * @group locator
 */
class CarbonBreadcrumbLocatorConstructTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator', array(), '', false );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Locator::__construct
	 */
	public function testConstructor() {
		$this->locator->__construct( 'foo', 'bar' );

		$this->assertSame( 'foo', $this->locator->get_type() );
		$this->assertSame( 'bar', $this->locator->get_subtype() );
	}

}
