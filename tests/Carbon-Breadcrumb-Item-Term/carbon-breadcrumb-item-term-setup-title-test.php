<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemTermSetupTitleTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->item     = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_Term', array(), '', false );
		$this->category = $this->factory->category->create();

		$this->item->set_id( $this->category );
		$this->item->term_object = get_term_by( 'id', $this->category, 'category' );
	}

	public function tearDown() {
		unset( $this->item );
		unset( $this->category );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Item_Term::setup_title
	 */
	public function testItemTitle() {
		$this->assertSame( null, $this->item->get_title() );

		$this->item->setup_title();

		$title = apply_filters( 'the_title', $this->item->term_object->name );
		$this->assertSame( $title, $this->item->get_title() );
	}

}
