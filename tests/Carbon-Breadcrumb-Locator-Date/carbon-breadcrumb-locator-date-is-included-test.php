<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorDateIsIncludedTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Date', array( 'test1', 'test2' ) );
		$this->post    = $this->factory->post->create();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::is_included
	 */
	public function testOnYearArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) );
		$this->assertTrue( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::is_included
	 */
	public function testOnMonthArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) );
		$this->assertTrue( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::is_included
	 */
	public function testOnDayArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) . '&day=' . date( 'd' ) );
		$this->assertTrue( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::is_included
	 */
	public function testOnCategoryArchive() {
		$this->go_to( '/?cat=1' );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::is_included
	 */
	public function testOnAuthorArchive() {
		$this->go_to( '/?author=1' );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::is_included
	 */
	public function testOnSinglePost() {
		$this->go_to( '/?p=' . $this->post );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::is_included
	 */
	public function testOnSearchResults() {
		$this->go_to( '/?s=' );
		$this->assertFalse( $this->locator->is_included() );
	}

}
