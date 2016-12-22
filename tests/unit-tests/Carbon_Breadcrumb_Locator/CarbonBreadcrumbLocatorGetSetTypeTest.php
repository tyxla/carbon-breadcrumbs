<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorGetSetTypeTest extends WP_UnitTestCase {

	public function setUp() {
		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator', array( 'test1', 'test2' ) );
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->locator );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator::get_type
	 * @covers Carbon_Breadcrumb_Locator::set_type
	 */
	public function testGetSetType() {
		$expected = 'fooBar';
		$this->locator->set_type( $expected );
		$this->assertSame( $expected, $this->locator->get_type() );
	}

}