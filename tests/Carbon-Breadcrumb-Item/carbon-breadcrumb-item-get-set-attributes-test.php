<?php
/**
 * Tests for Carbon_Breadcrumb_Item::get_attributes() and Carbon_Breadcrumb_Item::set_attributes()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item::get_attributes() and Carbon_Breadcrumb_Item::set_attributes()
 *
 * @group item
 */
class CarbonBreadcrumbItemGetSetAttributesTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item::get_attributes().
	 *
	 * @covers Carbon_Breadcrumb_Item::get_attributes
	 * @covers Carbon_Breadcrumb_Item::set_attributes
	 */
	public function testGetSetAttributes() {
		$expected = array(
			'target' => '_blank',
			'class'  => 'foo-bar',
		);
		$this->item->set_attributes( $expected );
		$this->assertSame( $expected, $this->item->get_attributes() );
	}

}
