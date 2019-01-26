<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulateCategoryItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->setup->set_trail( $this->trail );
		$this->parent_cat = $this->factory->category->create();
		$this->child_cat  = $this->factory->category->create(
			array(
				'parent' => $this->parent_cat,
			)
		);
		$this->post       = $this->factory->post->create(
			array(
				'post_category' => array( $this->parent_cat, $this->child_cat ),
			)
		);
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
		unset( $this->post );
		unset( $this->parent_cat );
		unset( $this->child_cat );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_category_items
	 */
	public function testOnCategoryPage() {
		$this->go_to( '/?cat=' . $this->parent_cat );
		$this->setup->populate_category_items();
		$this->assertSame( array(), $this->trail->get_items() );

		$this->go_to( '/?cat=' . $this->child_cat );
		$this->setup->populate_category_items();
		$this->assertSame( array(), $this->trail->get_items() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_category_items
	 */
	public function testOnSinglePost() {
		$this->go_to( '/?p=' . $this->post );
		$this->setup->populate_category_items();

		$actual_items = array_values( $this->trail->get_items() );
		$actual_items = $actual_items[0];

		$this->assertSame( 2, count( $actual_items ) );

		$this->assertSame( $this->parent_cat, $actual_items[0]->get_id() );
		$this->assertSame( 'term', $actual_items[0]->get_type() );
		$this->assertSame( 'category', $actual_items[0]->get_subtype() );
		$this->assertSame( 'Carbon_Breadcrumb_Item_Term', get_class( $actual_items[0] ) );
		$this->assertSame( 700, $actual_items[0]->get_priority() );

		$this->assertSame( $this->child_cat, $actual_items[1]->get_id() );
		$this->assertSame( 'term', $actual_items[1]->get_type() );
		$this->assertSame( 'category', $actual_items[1]->get_subtype() );
		$this->assertSame( 'Carbon_Breadcrumb_Item_Term', get_class( $actual_items[1] ) );
		$this->assertSame( 700, $actual_items[1]->get_priority() );
	}

}
