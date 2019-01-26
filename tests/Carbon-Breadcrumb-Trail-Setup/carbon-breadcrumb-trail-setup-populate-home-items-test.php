<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Setup::populate_home_items()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Setup::populate_home_items()
 *
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulateHomeItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->trail    = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( array( 'get_display_home_item' ) )->getMock();
		$this->setup    = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();

		$this->setup->set_trail( $this->trail );
		$this->trail->set_renderer( $this->renderer );

		$this->post = $this->factory->post->create();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
		unset( $this->renderer );
		unset( $this->setup );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Setup::populate_home_items().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_home_items
	 */
	public function testWithHomeEnabled() {
		$this->renderer->expects( $this->any() )
			->method( 'get_display_home_item' )
			->will( $this->returnValue( true ) );

		$this->setup->populate_home_items();

		$items = $this->trail->get_flat_items();

		$this->assertSame( 1, count( $items ) );
		$this->assertSame( 10, $items[0]->get_priority() );
		$this->assertSame( home_url( '/' ), $items[0]->get_link() );
		$this->assertSame( $this->renderer->get_home_item_title(), $items[0]->get_title() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Setup::populate_home_items().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_home_items
	 */
	public function testWithHomeDisabled() {
		$this->renderer->expects( $this->any() )
			->method( 'get_display_home_item' )
			->will( $this->returnValue( false ) );

		$this->setup->populate_home_items();

		$items = $this->trail->get_flat_items();

		$this->assertSame( 0, count( $items ) );
	}

}
