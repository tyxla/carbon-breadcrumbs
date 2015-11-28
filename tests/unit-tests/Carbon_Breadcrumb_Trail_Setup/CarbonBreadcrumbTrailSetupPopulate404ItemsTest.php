<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulate404ItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->setup = $this->getMock('Carbon_Breadcrumb_Trail_Setup', null, array(), '', false);
		$this->setup->set_trail( $this->trail );
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_404_items
	 */
	public function test404Item() {
		$this->go_to( '/?p=123456' );

		$this->setup->populate_404_items();

		$actual_items = array_values($this->trail->get_items());
		$actual_item = $actual_items[0][0];

		$expected_title = __( 'Error 404 - Not Found', 'carbon_breadcrumbs' );
		$this->assertSame( $expected_title, $actual_item->get_title() );
		$this->assertSame( '', $actual_item->get_link() );
		$this->assertSame( 700, $actual_item->get_priority() );
		$this->assertSame( 'Carbon_Breadcrumb_Item_Custom', get_class( $actual_item ) );
	}

}
