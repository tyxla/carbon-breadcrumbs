<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulateDbObjectItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->setup->set_trail( $this->trail );
		$this->setup_exposed = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup_Exposed' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
		unset( $this->setup_exposed );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_db_object_items
	 */
	public function testWithPostItems() {
		$this->post = $this->factory->post->create();
		$this->go_to( '/?p=' . $this->post );

		$this->setup->populate_db_object_items();

		$expected_items = $this->setup_exposed->exposed_generate_locator_items( 'post' );
		$actual_items   = array_values( $this->trail->get_items() );
		foreach ( $expected_items as $key => $item ) {
			$actual_item = $actual_items[0][ $key ];

			$this->assertSame( $item->get_id(), $actual_item->get_id() );
			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( get_class( $item ), get_class( $actual_item ) );
		}

		unset( $this->post );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_db_object_items
	 */
	public function testWithPageItems() {
		$this->page = $this->factory->post->create(
			array(
				'post_type' => 'page',
			)
		);
		$this->go_to( '/?page_id=' . $this->page );

		$this->setup->populate_db_object_items();

		$expected_items = $this->setup_exposed->exposed_generate_locator_items( 'post' );
		$actual_items   = array_values( $this->trail->get_items() );
		foreach ( $expected_items as $key => $item ) {
			$actual_item = $actual_items[0][ $key ];

			$this->assertSame( $item->get_id(), $actual_item->get_id() );
			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( get_class( $item ), get_class( $actual_item ) );
		}

		unset( $this->page );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_db_object_items
	 */
	public function testWithTermItems() {
		$this->category = $this->factory->category->create();
		$this->go_to( '/?cat=' . $this->category );

		$this->setup->populate_db_object_items();

		$expected_items = $this->setup_exposed->exposed_generate_locator_items( 'term' );
		$actual_items   = array_values( $this->trail->get_items() );
		foreach ( $expected_items as $key => $item ) {
			$actual_item = $actual_items[0][ $key ];

			$this->assertSame( $item->get_id(), $actual_item->get_id() );
			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( get_class( $item ), get_class( $actual_item ) );
		}

		unset( $this->category );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_db_object_items
	 */
	public function testWithUserItems() {
		$this->user = $this->factory->user->create();
		$this->go_to( '/?author=' . $this->user );

		$this->setup->populate_db_object_items();

		$expected_items = $this->setup_exposed->exposed_generate_locator_items( 'user' );
		$actual_items   = array_values( $this->trail->get_items() );
		foreach ( $expected_items as $key => $item ) {
			$actual_item = $actual_items[0][ $key ];

			$this->assertSame( $item->get_id(), $actual_item->get_id() );
			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( get_class( $item ), get_class( $actual_item ) );
		}

		unset( $this->user );
	}

}

/**
 * Helper for exposing the protected Carbon_Breadcrumb_Trail_Setup::generate_locator_items()
 */
class Carbon_Breadcrumb_Trail_Setup_Exposed extends Carbon_Breadcrumb_Trail_Setup {
	public function exposed_generate_locator_items( $locator_name ) {
		return $this->generate_locator_items( $locator_name );
	}
}
