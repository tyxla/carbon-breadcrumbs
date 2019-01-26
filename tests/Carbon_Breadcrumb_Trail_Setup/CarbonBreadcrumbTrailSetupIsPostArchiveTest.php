<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupIsPostArchiveTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->post = $this->factory->post->create();
	}

	public function tearDown() {
		unset( $this->setup );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOnYearArchive() {
		$this->go_to('/?year=' . date( 'Y' ) );
		$this->assertTrue( $this->setup->is_post_archive() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOnMonthArchive() {
		$this->go_to('/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) );
		$this->assertTrue( $this->setup->is_post_archive() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOnDayArchive() {
		$this->go_to('/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) . '&day=' . date( 'd' ) );
		$this->assertTrue( $this->setup->is_post_archive() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOnCategoryArchive() {
		$this->go_to('/?cat=1' );
		$this->assertTrue( $this->setup->is_post_archive() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOnAuthorArchive() {
		$this->go_to('/?author=1' );
		$this->assertTrue( $this->setup->is_post_archive() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOnSinglePost() {
		$this->go_to('/?p=' . $this->post );
		$this->assertFalse( $this->setup->is_post_archive() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOnSearchResults() {
		$this->go_to('/?s=');
		$this->assertFalse( $this->setup->is_post_archive() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::is_post_archive
	 */
	public function testOn404() {
		$this->go_to('/?p=123456');
		$this->assertFalse( $this->setup->is_post_archive() );
	}

}
