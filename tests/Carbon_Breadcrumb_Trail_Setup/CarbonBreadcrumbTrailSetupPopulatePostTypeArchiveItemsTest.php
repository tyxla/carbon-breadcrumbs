<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulatePostTypeArchiveItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->post  = $this->factory->post->create();

		$this->setup->set_trail( $this->trail );

		register_post_type(
			'cpt_foo',
			array(
				'has_archive' => true,
				'public'      => true,
				'labels'      => array(
					'name' => 'Foo Bar',
				),
			)
		);

		register_post_type(
			'cpt_bar',
			array(
				'has_archive' => false,
				'public'      => true,
			)
		);

		$this->cpt_foo_post = $this->factory->post->create(
			array(
				'post_type' => 'cpt_foo',
				'post_name' => 'foo-bar',
			)
		);
		$this->cpt_bar_post = $this->factory->post->create(
			array(
				'post_type' => 'cpt_bar',
				'post_name' => 'bar-foo',
			)
		);
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
		unset( $this->post );
		unset( $this->cpt_foo_post );
		unset( $this->cpt_bar_post );

		_unregister_post_type( 'cpt_foo' );
		_unregister_post_type( 'cpt_bar' );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_post_type_archive_items
	 */
	public function testOnPostTypeArchive() {
		$this->go_to( '/?post_type=cpt_foo' );

		$this->setup->populate_post_type_archive_items();

		$actual_items = $this->trail->get_flat_items();
		$actual_item  = $actual_items[0];

		$this->assertSame( 1, count( $actual_items ) );
		$this->assertSame( 'Foo Bar', $actual_item->get_title() );
		$this->assertSame( get_post_type_archive_link( 'cpt_foo' ), $actual_item->get_link() );
		$this->assertSame( 700, $actual_item->get_priority() );
		$this->assertSame( 'Carbon_Breadcrumb_Item_Custom', get_class( $actual_item ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_post_type_archive_items
	 */
	public function testOnSinglePostTypeWithArchive() {
		$this->go_to( '/?cpt_foo=foo-bar' );

		$this->setup->populate_post_type_archive_items();

		$actual_items = $this->trail->get_flat_items();

		$actual_item = $actual_items[0];

		$this->assertSame( 1, count( $actual_items ) );
		$this->assertSame( 'Foo Bar', $actual_item->get_title() );
		$this->assertSame( get_post_type_archive_link( 'cpt_foo' ), $actual_item->get_link() );
		$this->assertSame( 700, $actual_item->get_priority() );
		$this->assertSame( 'Carbon_Breadcrumb_Item_Custom', get_class( $actual_item ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_post_type_archive_items
	 */
	public function testOnSinglePostTypeWithoutArchive() {
		$this->go_to( '/?cpt_bar=bar-foo' );

		$this->setup->populate_post_type_archive_items();

		$actual_items = $this->trail->get_flat_items();

		$this->assertSame( 0, count( $actual_items ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_post_type_archive_items
	 */
	public function testOnNonPostTypeArchiveContext() {
		$this->go_to( '/?s=t' );

		$this->setup->populate_post_type_archive_items();

		$actual_items = $this->trail->get_flat_items();

		$this->assertSame( 0, count( $actual_items ) );
	}

}
