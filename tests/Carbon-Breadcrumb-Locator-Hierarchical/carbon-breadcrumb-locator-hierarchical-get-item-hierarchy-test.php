<?php
/**
 * Tests for Carbon_Breadcrumb_Locator_Hierarchical::get_item_hierarchy()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Locator_Hierarchical::get_item_hierarchy()
 *
 * @group locator
 */
class CarbonBreadcrumbLocatorHierarchicalGetItemHierarchyTest extends WP_UnitTestCase {

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Hierarchical::get_item_hierarchy().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Hierarchical::get_item_hierarchy
	 */
	public function testWithPosts() {
		$post1 = $this->factory->post->create();
		$post2 = $this->factory->post->create( array( 'post_parent' => $post1 ) );
		$post3 = $this->factory->post->create( array( 'post_parent' => $post2 ) );

		$locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Hierarchical', array( 'post', 'post' ), '', true, true, true, array( 'get_parent_id' ) );

		$locator->expects( $this->any() )
			->method( 'get_parent_id' )
			->will( $this->returnCallback( array( $this, 'get_post_parent' ) ) );

		$items = $locator->get_item_hierarchy( $post3, 123 );

		$this->assertSame( 3, count( $items ) );

		for ( $i = 0; $i <= 2; $i++ ) {
			$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Post', $items[ $i ] );
			$this->assertSame( ${'post' . ( $i + 1 )}, $items[ $i ]->get_id() );
			$this->assertSame( 123, $items[ $i ]->get_priority() );
		}
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Hierarchical::get_item_hierarchy().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Hierarchical::get_item_hierarchy
	 */
	public function testWithCategories() {
		$category1 = $this->factory->category->create();
		$category2 = $this->factory->category->create( array( 'parent' => $category1 ) );
		$category3 = $this->factory->category->create( array( 'parent' => $category2 ) );

		$locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Hierarchical', array( 'term', 'category' ), '', true, true, true, array( 'get_parent_id' ) );

		$locator->expects( $this->any() )
			->method( 'get_parent_id' )
			->will( $this->returnCallback( array( $this, 'get_term_parent' ) ) );

		$items = $locator->get_item_hierarchy( $category3, 123 );

		$this->assertSame( 3, count( $items ) );

		for ( $i = 0; $i <= 2; $i++ ) {
			$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Term', $items[ $i ] );
			$this->assertSame( ${'category' . ( $i + 1 )}, $items[ $i ]->get_id() );
			$this->assertSame( 123, $items[ $i ]->get_priority() );
		}
	}

	/**
	 * Get the parent ID of a post.
	 *
	 * @param integer $id ID of the post.
	 * @return integer ID of the parent.
	 */
	public function get_post_parent( $id ) {
		return get_post_field( 'post_parent', $id );
	}

	/**
	 * Get the parent ID of a term.
	 *
	 * @param integer $id ID of the term.
	 * @return integer ID of the parent.
	 */
	public function get_term_parent( $id ) {
		$term = get_term_by( 'id', $id, 'category' );
		return $term->parent;
	}

}
