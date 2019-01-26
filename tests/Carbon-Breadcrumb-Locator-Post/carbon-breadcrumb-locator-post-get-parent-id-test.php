<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorPostGetParentIdTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator  = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Post', array( 'post', 'post' ) );
		$this->parent   = $this->factory->post->create();
		$this->child    = $this->factory->post->create(
			array(
				'post_parent' => $this->parent,
			)
		);
		$this->subchild = $this->factory->post->create(
			array(
				'post_parent' => $this->child,
			)
		);
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->parent );
		unset( $this->child );
		unset( $this->subchild );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::get_parent_id().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::get_parent_id
	 */
	public function testWithParentPost() {
		$this->assertSame( 0, $this->locator->get_parent_id( $this->parent ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::get_parent_id().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::get_parent_id
	 */
	public function testWithChildPost() {
		$this->assertSame( $this->parent, $this->locator->get_parent_id( $this->child ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Post::get_parent_id().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Post::get_parent_id
	 */
	public function testWithSubChildPost() {
		$this->assertSame( $this->child, $this->locator->get_parent_id( $this->subchild ) );
	}

}
