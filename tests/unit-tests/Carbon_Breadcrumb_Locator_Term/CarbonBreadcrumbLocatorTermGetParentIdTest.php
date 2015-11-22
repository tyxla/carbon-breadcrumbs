<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorTermGetParentIdTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Term', array( 'term', 'category' ) );
		$this->parent = $this->factory->category->create();
		$this->child = $this->factory->category->create(array(
			'parent' => $this->parent
		));
		$this->subchild = $this->factory->category->create(array(
			'parent' => $this->child
		));
	}

	public function tearDown() {
		unset( $this->locator );
		unset( $this->parent );
		unset( $this->child );
		unset( $this->subchild );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::get_parent_id
	 */
	public function testWithParentTerm() {
		$this->assertSame( 0, $this->locator->get_parent_id( $this->parent ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::get_parent_id
	 */
	public function testWithChildTerm() {
		$this->assertSame( $this->parent, $this->locator->get_parent_id( $this->child ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::get_parent_id
	 */
	public function testWithSubChildTerm() {
		$this->assertSame( $this->child, $this->locator->get_parent_id( $this->subchild ) );
	}

}