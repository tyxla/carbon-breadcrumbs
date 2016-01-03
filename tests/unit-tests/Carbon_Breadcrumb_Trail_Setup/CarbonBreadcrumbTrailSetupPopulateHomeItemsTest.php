<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulateHomeItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', array('get_display_home_item'));
		$this->setup = $this->getMock('Carbon_Breadcrumb_Trail_Setup', null, array(), '', false);

		$this->setup->set_trail( $this->trail );
		$this->trail->set_renderer( $this->renderer );

		$this->post = $this->factory->post->create();
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_home_items
	 */
	public function testWithHomeEnabled() {
		$this->renderer->expects($this->any())
			->method('get_display_home_item')
			->will($this->returnValue(true));

		$this->setup->populate_home_items();

		$items = $this->trail->get_flat_items();

		$this->assertSame( 1, count($items) );
		$this->assertSame( 10, $items[0]->get_priority() );
		$this->assertSame( home_url('/'), $items[0]->get_link() );
		$this->assertSame( $this->renderer->get_home_item_title(), $items[0]->get_title() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_home_items
	 */
	public function testWithHomeDisabled() {
		$this->renderer->expects($this->any())
			->method('get_display_home_item')
			->will($this->returnValue(false));

		$this->setup->populate_home_items();

		$items = $this->trail->get_flat_items();

		$this->assertSame( 0, count($items) );
	}

}
