<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulatePageForPostsItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null);
		$this->setup = $this->getMock('Carbon_Breadcrumb_Trail_Setup', array('is_post_context'), array(), '', false);

		$this->setup->set_trail( $this->trail );
		$this->trail->set_renderer( $this->renderer );

		$this->page = $this->factory->post->create(array('post_type' => 'page'));
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
		unset( $this->page );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_page_for_posts_items
	 */
	public function testWithPostsPageInPostContext() {
		update_option('page_for_posts', $this->page);

		$this->setup->expects($this->any())
			->method('is_post_context')
			->will($this->returnValue(true));

		$this->setup->populate_page_for_posts_items();

		$items = $this->trail->get_flat_items();

		$this->assertSame( 1, count($items) );
		$this->assertSame( 500, $items[0]->get_priority() );
		$this->assertSame( get_permalink($this->page), $items[0]->get_link() );
		$this->assertSame( get_post_field('post_title', $this->page), $items[0]->get_title() );

		update_option('page_for_posts', 0);
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_page_for_posts_items
	 */
	public function testWithNoPostContext() {
		update_option('page_for_posts', $this->page);

		$this->setup->expects($this->any())
			->method('is_post_context')
			->will($this->returnValue(false));

		$this->setup->populate_page_for_posts_items();

		$items = $this->trail->get_flat_items();

		$this->assertSame( 0, count($items) );

		update_option('page_for_posts', 0);
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_page_for_posts_items
	 */
	public function testWithNoPageForPosts() {
		update_option('page_for_posts', 0);
		
		$this->setup->expects($this->any())
			->method('is_post_context')
			->will($this->returnValue(true));

		$this->setup->populate_page_for_posts_items();

		$items = $this->trail->get_flat_items();

		$this->assertSame( 0, count($items) );
	}

}
