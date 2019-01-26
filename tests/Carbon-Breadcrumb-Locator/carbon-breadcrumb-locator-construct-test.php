<?php
/**
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
	 * @covers Carbon_Breadcrumb_Locator::__construct
	 */
	public function testConstructor() {
		$this->locator->__construct( 'foo', 'bar' );

		$this->assertSame( 'foo', $this->locator->get_type() );
		$this->assertSame( 'bar', $this->locator->get_subtype() );
	}

}
