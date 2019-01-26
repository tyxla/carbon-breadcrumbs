<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemDbObjectSetupTest extends WP_UnitTestCase {
	public $default_mock_title = 'foobar';
	public $default_mock_link  = 'http://example.com/';

	public function mockSetupTitle() {
		$this->item->mock_title = $this->default_mock_title;
	}

	public function mockSetupLink() {
		$this->item->mock_link = $this->default_mock_link;
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_DB_Object' );

		$this->item->expects( $this->any() )
			->method( 'setup_title' )
			->will( $this->returnCallback( array( $this, 'mockSetupTitle' ) ) );

		$this->item->expects( $this->any() )
			->method( 'setup_link' )
			->will( $this->returnCallback( array( $this, 'mockSetupLink' ) ) );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_DB_Object::setup().
	 *
	 * @covers Carbon_Breadcrumb_Item_DB_Object::setup
	 */
	public function testBeforeAfterSetup() {
		$this->item->setup();

		$this->assertSame( $this->default_mock_title, $this->item->mock_title );
		$this->assertSame( $this->default_mock_link, $this->item->mock_link );
	}

}
