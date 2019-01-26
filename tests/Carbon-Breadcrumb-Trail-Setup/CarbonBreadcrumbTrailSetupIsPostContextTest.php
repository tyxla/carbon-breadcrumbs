<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupIsPostContextTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->post  = $this->factory->post->create();
		$this->page  = $this->factory->post->create(
			array(
				'post_type' => 'page',
			)
		);
	}

	public function tearDown() {
		unset( $this->setup );
		unset( $this->post );
		unset( $this->page );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnYearArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) );
		$this->assertTrue( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnMonthArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) );
		$this->assertTrue( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnDayArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) . '&day=' . date( 'd' ) );
		$this->assertTrue( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnCategoryArchive() {
		$this->go_to( '/?cat=1' );
		$this->assertTrue( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnAuthorArchive() {
		$this->go_to( '/?author=1' );
		$this->assertTrue( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnSinglePost() {
		$this->go_to( '/?p=' . $this->post );
		$this->assertTrue( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnPage() {
		$this->go_to( '/?page_id=' . $this->page );
		$this->assertFalse( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOnSearchResults() {
		$this->go_to( '/?s=' );
		$this->assertFalse( $this->setup->is_post_context() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_context
	 */
	public function testOn404() {
		$this->go_to( '/?p=123456' );
		$this->assertFalse( $this->setup->is_post_context() );
	}

}
