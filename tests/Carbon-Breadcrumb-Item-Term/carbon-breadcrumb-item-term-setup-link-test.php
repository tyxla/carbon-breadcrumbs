<?php
/**
 * Tests for Carbon_Breadcrumb_Item_Term::setup_link()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item_Term::setup_link()
 *
 * @group item
 */
class CarbonBreadcrumbItemTermSetupLinkTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->item     = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_Term', array(), '', false );
		$this->category = $this->factory->category->create();

		$this->item->set_id( $this->category );
		$this->item->term_object = get_term_by( 'id', $this->category, 'category' );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
		unset( $this->category );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Term::setup_link().
	 *
	 * @covers Carbon_Breadcrumb_Item_Term::setup_link
	 */
	public function testItemLink() {
		$this->assertSame( null, $this->item->get_link() );

		$this->item->setup_link();

		$this->assertSame( get_term_link( $this->category, 'category' ), $this->item->get_link() );
	}

}
