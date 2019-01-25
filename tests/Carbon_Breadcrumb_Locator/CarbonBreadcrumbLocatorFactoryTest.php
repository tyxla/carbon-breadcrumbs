<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorFactoryTest extends WP_UnitTestCase {

	/**
	 * @covers Carbon_Breadcrumb_Locator::factory
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage Unexisting breadcrumb locator type: "foobar".
	 */
	public function testFactoryUnexistingClass() {
		Carbon_Breadcrumb_Locator::factory('foobar');
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator::factory
	 */
	public function testFactoryDefaultSetup() {
		$locator = Carbon_Breadcrumb_Locator::factory( 'post' );

		$this->assertInstanceOf( 'Carbon_Breadcrumb_Locator_Post', $locator );
		$this->assertSame( 'post', $locator->get_type() );
		$this->assertSame( '', $locator->get_subtype() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator::factory
	 */
	public function testFactoryCustomSetup() {
		$locator = Carbon_Breadcrumb_Locator::factory( 'post', 'page' );

		$this->assertInstanceOf( 'Carbon_Breadcrumb_Locator_Post', $locator );
		$this->assertSame( 'post', $locator->get_type() );
		$this->assertSame( 'page', $locator->get_subtype() );
	}

}