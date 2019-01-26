<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulateSearchItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->post  = $this->factory->post->create(
			array(
				'post_title' => 'foo bar',
			)
		);

		$this->setup->set_trail( $this->trail );
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_search_items
	 */
	public function testOnNonSearch() {
		$this->go_to( '/?p=' . $this->post );

		$this->setup->populate_search_items();

		$actual_items = array_values( $this->trail->get_items() );
		$this->assertSame( array(), $actual_items );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_search_items
	 */
	public function testSearchItem() {
		$this->go_to( '/?s=foo' );

		$this->setup->populate_search_items();

		$actual_items = array_values( $this->trail->get_items() );
		$actual_item  = $actual_items[0][0];

		$expected_title = sprintf( __( 'Search results for: "%1$s"', 'carbon_breadcrumbs' ), get_search_query() );
		$this->assertSame( $expected_title, $actual_item->get_title() );
		$this->assertSame( '', $actual_item->get_link() );
		$this->assertSame( 700, $actual_item->get_priority() );
		$this->assertSame( 'Carbon_Breadcrumb_Item_Custom', get_class( $actual_item ) );
	}

}
