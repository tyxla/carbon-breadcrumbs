<?php
/**
 * Tests for Carbon_Breadcrumb_Locator_Term::get_parent_id()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Locator_Term::get_parent_id()
 *
 * @group locator
 */
class CarbonBreadcrumbLocatorTermGetParentIdTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator  = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Term', array( 'term', 'category' ) );
		$this->parent   = $this->factory->category->create();
		$this->child    = $this->factory->category->create(
			array(
				'parent' => $this->parent,
			)
		);
		$this->subchild = $this->factory->category->create(
			array(
				'parent' => $this->child,
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
	 * Tests for Carbon_Breadcrumb_Locator_Term::get_parent_id().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Term::get_parent_id
	 */
	public function testWithParentTerm() {
		$this->assertSame( 0, $this->locator->get_parent_id( $this->parent ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Term::get_parent_id().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Term::get_parent_id
	 */
	public function testWithChildTerm() {
		$this->assertSame( $this->parent, $this->locator->get_parent_id( $this->child ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Term::get_parent_id().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Term::get_parent_id
	 */
	public function testWithSubChildTerm() {
		$this->assertSame( $this->child, $this->locator->get_parent_id( $this->subchild ) );
	}

}
