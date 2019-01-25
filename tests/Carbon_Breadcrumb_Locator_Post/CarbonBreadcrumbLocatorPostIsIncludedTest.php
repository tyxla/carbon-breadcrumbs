<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorPostIsIncludedTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Post', array( 'post', 'post' ) );
		$this->post = $this->factory->post->create();
	}

	public function tearDown() {
		unset( $this->locator );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Post::is_included
	 */
	public function testOnYearArchive() {
		$this->go_to('/?year=' . date( 'Y' ) );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Post::is_included
	 */
	public function testOnMonthArchive() {
		$this->go_to('/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Post::is_included
	 */
	public function testOnDayArchive() {
		$this->go_to('/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) . '&day=' . date( 'd' ) );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Post::is_included
	 */
	public function testOnCategoryArchive() {
		$this->go_to('/?cat=1' );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Post::is_included
	 */
	public function testOnAuthorArchive() {
		$this->go_to('/?author=1' );
		$this->assertFalse( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Post::is_included
	 */
	public function testOnSinglePost() {
		$this->go_to('/?p=' . $this->post );
		$this->assertTrue( $this->locator->is_included() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Post::is_included
	 */
	public function testOnSearchResults() {
		$this->go_to('/?s=');
		$this->assertFalse( $this->locator->is_included() );
	}

}