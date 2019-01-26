<?php
/**
 * Tests for Carbon_Breadcrumb_Locator_User::generate_items()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Locator_User::generate_items()
 *
 * @group locator
 */
class CarbonBreadcrumbLocatorUserGenerateItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_User', array( 'user', '' ) );
		$this->author  = $this->factory->user->create(
			array(
				'role' => 'administrator',
			)
		);
		$this->post    = $this->factory->post->create(
			array(
				'post_author' => $this->author,
			)
		);
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->author );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_User::generate_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_User::generate_items
	 */
	public function testOnNonAuthorPage() {
		$this->go_to( '/?p=' . $this->post );
		$this->assertSame( array(), $this->locator->generate_items() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_User::generate_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_User::generate_items
	 */
	public function testOnAuthorPage() {
		$this->go_to( '/?author=' . $this->author );

		$expected_items = $this->locator->get_items();
		$actual_items   = $this->locator->generate_items();
		foreach ( $expected_items as $key => $item ) {
			$actual_item = $actual_items[ $key ];

			$this->assertSame( $item->get_id(), $actual_item->get_id() );
			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( $item->get_priority(), $actual_item->get_priority() );
			$this->assertSame( get_class( $item ), get_class( $actual_item ) );
		}
	}

}
