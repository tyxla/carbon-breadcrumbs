<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorTermIsIncludedTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->locator  = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Term', array( 'term', 'category' ) );
		$this->category = $this->factory->category->create();
		$this->tag      = $this->factory->tag->create();
	}

	public function tearDown() {
		unset( $this->locator );
		unset( $this->category );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnYearArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnMonthArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnDayArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) . '&day=' . date( 'd' ) );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnCategoryArchive() {
		$this->go_to( '/?cat=' . $this->category );
		$this->assertTrue( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnTagArchive() {
		$this->go_to( '/?tag_id=' . $this->tag );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnAuthorArchive() {
		$this->go_to( '/?author=1' );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnSingleTerm() {
		$this->go_to( '/?p=1' );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::is_included
	 */
	public function testOnSearchResults() {
		$this->go_to( '/?s=' );
		$this->assertFalse( $this->locator->is_included() );
	}

}
