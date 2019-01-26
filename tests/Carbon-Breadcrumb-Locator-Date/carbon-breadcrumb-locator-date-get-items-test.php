<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorDateGetItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Date', array( 'test1', 'test2' ), '', true, true, true, array( 'get_archive_item_details' ) );
		$this->post    = $this->factory->post->create();
		$this->go_to( '/?p=' . $this->post );
		$this->archive_item_details = array(
			0 => array(
				'condition'    => true,
				'title_format' => 'Y/m/d',
				'title_regex'  => '~\d{4}/\d{2}/\d{2}~',
				'link'         => '#foo',
			),
			2 => array(
				'condition'    => false,
				'title_format' => 'Ymd',
				'title_regex'  => '~\d{4}\d{2}\d{2}~',
				'link'         => '#foobar',
			),
			1 => array(
				'condition'    => true,
				'title_format' => 'Y.m.d',
				'title_regex'  => '~\d{4}\.\d{2}\.\d{2}~',
				'link'         => '#bar',
			),
		);

		$this->locator->expects( $this->any() )
			->method( 'get_archive_item_details' )
			->will( $this->returnValue( $this->archive_item_details ) );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->post );
		unset( $this->archive_item_details );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Date::get_items().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Date::get_items
	 */
	public function testGetItems() {
		$this->locator->expects( $this->any() )
			->method( 'get_archive_item_details' )
			->will( $this->returnValue( false ) );

		$items = $this->locator->get_items( 123 );

		$this->assertSame( 2, count( $items ) );

		for ( $i = 0; $i < 2; $i++ ) {
			$this->assertInstanceOf( 'Carbon_Breadcrumb_Item_Custom', $items[ $i ] );
			$this->assertSame( $this->archive_item_details[ $i ]['link'], $items[ $i ]->get_link() );
			$this->assertRegExp( $this->archive_item_details[ $i ]['title_regex'], $items[ $i ]->get_title() );
			$this->assertSame( 123, $items[ $i ]->get_priority() );
		}
	}

}
