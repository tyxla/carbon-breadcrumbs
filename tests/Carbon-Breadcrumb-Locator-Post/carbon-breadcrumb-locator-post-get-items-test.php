<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorPostGetItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockBuilder( 'Carbon_Breadcrumb_Locator_Post' )->setMethods( null )->setConstructorArgs( array( 'post', 'post' ) )->getMock();
		$this->post1   = $this->factory->post->create();
		$this->post2   = $this->factory->post->create();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->post1 );
		unset( $this->post2 );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::get_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::get_items
	 */
	public function testWithCurrentPost() {
		$this->go_to( '?p=' . $this->post1 );

		$expected = $this->locator->get_item_hierarchy( $this->post1, 1000 );
		$actual   = $this->locator->get_items();

		foreach ( $expected as $key => $expected_item ) {
			$this->assertInstanceOf( get_class( $expected_item ), $actual[ $key ] );
			$this->assertSame( $expected_item->get_id(), $actual[ $key ]->get_id() );
			$this->assertSame( $expected_item->get_type(), $actual[ $key ]->get_type() );
			$this->assertSame( $expected_item->get_subtype(), $actual[ $key ]->get_subtype() );
		}
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::get_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::get_items
	 */
	public function testWithSpecificPost() {
		$this->go_to( '?p=' . $this->post2 );

		$expected = $this->locator->get_item_hierarchy( $this->post1, 1000 );
		$actual   = $this->locator->get_items( 1000, $this->post1 );

		foreach ( $expected as $key => $expected_item ) {
			$this->assertInstanceOf( get_class( $expected_item ), $actual[ $key ] );
			$this->assertSame( $expected_item->get_id(), $actual[ $key ]->get_id() );
			$this->assertSame( $expected_item->get_type(), $actual[ $key ]->get_type() );
			$this->assertSame( $expected_item->get_subtype(), $actual[ $key ]->get_subtype() );
		}
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::get_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::get_items
	 */
	public function testWithHomePage() {
		$this->go_to( '/' );

		update_option( 'page_on_front', $this->post1 );

		$expected = array();
		$actual   = $this->locator->get_items( 1000, $this->post1 );

		$this->assertSame( $expected, $actual );
	}

}
