<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorGenerateItemsForSubtypesTest extends WP_UnitTestCase {

	public function setUp() {
		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator', array( 'test1', 'test2' ), '', false, true, true, array('get_type') );

		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();

		unset( $this->locator );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator::generate_items_for_subtypes
	 */
	public function testWithPosts() {
		$this->locator->expects($this->any())
			->method('get_type')
			->will($this->returnValue('post'));

		$subtypes = array('post', 'page');
		$post1 = $this->factory->post->create();
		$post2 = $this->factory->post->create();
		$page = $this->factory->post->create( array( 'post_type' => 'page' ) );
		$this->go_to('?p=' . $post1);

		$items = $this->locator->generate_items_for_subtypes($subtypes);

		$this->assertSame( 1, count($items) );
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Post', $items[0] );
		$this->assertSame( $post1, $items[0]->get_id() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator::generate_items_for_subtypes
	 */
	public function testWithPageHierarchy() {
		$this->locator->expects($this->any())
			->method('get_type')
			->will($this->returnValue('post'));

		$subtypes = array('post', 'page');
		$post1 = $this->factory->post->create();
		$page1 = $this->factory->post->create( array( 'post_type' => 'page' ) );
		$page2 = $this->factory->post->create( array( 'post_type' => 'page', 'post_parent' => $page1 ) );
		$page3 = $this->factory->post->create( array( 'post_type' => 'page' ) );
		$this->go_to('?page_id=' . $page2);

		$items = $this->locator->generate_items_for_subtypes($subtypes);
		
		$this->assertSame( 2, count($items) );
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Post', $items[0] );
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Post', $items[1] );
		$this->assertSame( $page1, $items[0]->get_id() );
		$this->assertSame( $page2, $items[1]->get_id() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator::generate_items_for_subtypes
	 */
	public function testWithCategoryHierarchy() {
		$this->locator->expects($this->any())
			->method('get_type')
			->will($this->returnValue('term'));

		$subtypes = array('category');
		$category1 = $this->factory->category->create( array() );
		$category2 = $this->factory->category->create( array( 'parent' => $category1 ) );
		$category3 = $this->factory->category->create( array() );
		$this->go_to('?cat=' . $category2);

		$items = $this->locator->generate_items_for_subtypes($subtypes);
		
		$this->assertSame( 2, count($items) );
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Term', $items[0] );
		$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Term', $items[1] );
		$this->assertSame( $category1, $items[0]->get_id() );
		$this->assertSame( $category2, $items[1]->get_id() );
	}

}