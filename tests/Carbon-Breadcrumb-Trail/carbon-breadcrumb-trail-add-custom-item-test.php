<?php
/**
 * Tests for Carbon_Breadcrumb_Trail::add_custom_item()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail::add_custom_item()
 *
 * @group trail
 */
class CarbonBreadcrumbTrailAddCustomItemTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail::add_custom_item().
	 *
	 * @covers Carbon_Breadcrumb_Trail::add_custom_item
	 */
	public function testCustomItemAddition() {
		$title    = 'Foo Bar';
		$link     = 'http://example.com/foobar';
		$priority = 123;
		$this->trail->add_custom_item( $title, $link, $priority );

		$items = $this->trail->get_items();
		$this->assertArrayHasKey( $priority, $items );
		$this->assertArrayHasKey( 0, $items[ $priority ] );

		$item = $items[ $priority ][0];
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Item', $item );
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Custom', $item );
		$this->assertSame( $title, $item->get_title() );
		$this->assertSame( $link, $item->get_link() );
		$this->assertSame( $priority, $item->get_priority() );
	}

}
