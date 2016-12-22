<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorGetSetSubtypeTest extends WP_UnitTestCase {

	public function setUp() {
		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator', array( 'test1', 'test2' ) );
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->locator );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator::get_subtype
	 * @covers Carbon_Breadcrumb_Locator::set_subtype
	 */
	public function testGetSetSubtype() {
		$expected = 'foo_bar';
		$this->locator->set_subtype( $expected );
		$this->assertSame( $expected, $this->locator->get_subtype() );
	}

}