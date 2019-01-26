<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorPostGenerateItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator    = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Post', array( 'post', 'post' ) );
		$this->post       = $this->factory->post->create();
		$this->page       = $this->factory->post->create(
			array(
				'post_type' => 'page',
			)
		);
		$this->attachment = $this->factory->post->create(
			array(
				'post_type' => 'attachment',
			)
		);
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->post );
		unset( $this->page );
		unset( $this->attachment );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::generate_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::generate_items
	 */
	public function testWithDefaultPostTypes() {
		$post_types = array(
			'post',
			'page',
			'attachment',
		);

		foreach ( $post_types as $pt ) {
			$this->go_to( '/?p=' . $this->$pt );
			$items = $this->locator->generate_items_for_subtypes( $post_types );

			$expected = $items;
			$actual   = $this->locator->generate_items();

			$this->assertSame( count( $expected ), count( $actual ) );
			foreach ( $items as $key => $item ) {
				$this->assertArrayHasKey( $key, $actual );
				$this->assertSame( $item->get_id(), $actual[ $key ]->get_id() );
			}
		}
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::generate_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::generate_items
	 */
	public function testWithCustomPostTypes() {
		register_post_type(
			'example_cpt',
			array(
				'public' => true,
			)
		);
		$this->example_cpt = $this->factory->post->create(
			array(
				'post_type' => 'example_cpt',
			)
		);
		$post_types        = array(
			'example_cpt',
		);

		foreach ( $post_types as $pt ) {
			$this->go_to( '/?p=' . $this->$pt );
			$items = $this->locator->generate_items_for_subtypes( $post_types );

			$expected = $items;
			$actual   = $this->locator->generate_items();

			$this->assertSame( count( $expected ), count( $actual ) );
			foreach ( $items as $key => $item ) {
				$this->assertArrayHasKey( $key, $actual );
				$this->assertSame( $item->get_id(), $actual[ $key ]->get_id() );
			}
		}

		unset( $this->example_cpt );
	}

}
