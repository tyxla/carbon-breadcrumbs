<?php
/**
 * Tests for Carbon_Breadcrumb_Item_Post::setup()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item_Post::setup()
 *
 * @group item
 */
class CarbonBreadcrumbItemPostSetupTest extends WP_UnitTestCase {
	/**
	 * Default mock title.
	 *
	 * @var string
	 **/
	public $default_mock_title = 'foobar';

	/**
	 * Default mock link.
	 *
	 * @var string
	 **/
	public $default_mock_link = 'http://example.com/';

	/**
	 * Setup mock title.
	 */
	public function mockSetupTitle() {
		$this->item->mock_title = $this->default_mock_title;
	}

	/**
	 * Setup mock link.
	 */
	public function mockSetupLink() {
		$this->item->mock_link = $this->default_mock_link;
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Post' )->setMethods( array( 'setup_title', 'setup_link', 'get_id' ) )->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Post::setup().
	 *
	 * @covers Carbon_Breadcrumb_Item_Post::setup
	 * @expectedException Carbon_Breadcrumb_Exception
	 * @expectedExceptionMessage The post breadcrumb items must have post ID specified.
	 */
	public function testSetupWithoutId() {
		$this->item->setup();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Post::setup().
	 *
	 * @covers Carbon_Breadcrumb_Item_Post::setup
	 */
	public function testSetupWithId() {
		$this->item->expects( $this->any() )
			->method( 'get_id' )
			->will( $this->returnValue( 123 ) );

		$this->item->expects( $this->any() )
			->method( 'setup_title' )
			->will( $this->returnCallback( array( $this, 'mockSetupTitle' ) ) );

		$this->item->expects( $this->any() )
			->method( 'setup_link' )
			->will( $this->returnCallback( array( $this, 'mockSetupLink' ) ) );

		$this->item->setup();

		$this->assertSame( $this->default_mock_title, $this->item->mock_title );
		$this->assertSame( $this->default_mock_link, $this->item->mock_link );
	}

}
