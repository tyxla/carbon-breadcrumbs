<?php
/**
 * Tests for Carbon_Breadcrumb_Item_Term::setup()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item_Term::setup()
 *
 * @group item
 */
class CarbonBreadcrumbItemTermSetupTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_Term' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Term::setup().
	 *
	 * @covers Carbon_Breadcrumb_Item_Term::setup
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage The term breadcrumb items must have term ID specified.
	 */
	public function testSetupWithoutId() {
		$this->item->setup();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Term::setup().
	 *
	 * @covers Carbon_Breadcrumb_Item_Term::setup
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage The term breadcrumb items must have taxonomy specified.
	 */
	public function testSetupWithoutSubtype() {
		$this->item->set_id( 123 );
		$this->item->setup();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Term::setup().
	 *
	 * @covers Carbon_Breadcrumb_Item_Term::setup
	 */
	public function testSetupWithTerm() {
		$term = $this->factory->category->create();
		$this->item->set_id( $term );
		$this->item->set_subtype( 'category' );

		$this->item->setup();

		$term_object = get_term_by( 'id', $term, 'category' );

		$this->assertSame( $term_object->term_id, $this->item->term_object->term_id );
		$this->assertSame( $term_object->term_taxonomy_id, $this->item->term_object->term_taxonomy_id );
		$this->assertSame( $term_object->taxonomy, $this->item->term_object->taxonomy );
	}

}
