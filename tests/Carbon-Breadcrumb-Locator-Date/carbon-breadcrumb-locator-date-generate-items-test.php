<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorDateGenerateItemsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Date', array( 'test1', 'test2' ), '', true, true, true, array( 'is_included', 'get_items' ) );
		$this->post    = $this->factory->post->create();

		$this->item1 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item2 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );

		$this->locator->expects( $this->any() )
			->method( 'get_items' )
			->will(
				$this->returnValue(
					array(
						$this->item1,
						$this->item2,
					)
				)
			);
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->post );

		unset( $this->item1 );
		unset( $this->item2 );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::generate_items
	 */
	public function testWithIsIncludedFalse() {
		$this->locator->expects( $this->once() )
			->method( 'is_included' )
			->will( $this->returnValue( false ) );

		$this->assertSame( array(), $this->locator->generate_items() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Date::generate_items
	 */
	public function testWithIsIncludedTrue() {
		$this->locator->expects( $this->once() )
			->method( 'is_included' )
			->will( $this->returnValue( true ) );

		$expected = array(
			$this->item1,
			$this->item2,
		);
		$this->assertSame( $expected, $this->locator->generate_items() );
	}

}
