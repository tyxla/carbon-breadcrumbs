<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorTermGetItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->locator   = $this->getMockBuilder( 'Carbon_Breadcrumb_Locator_Term' )->setMethods( null )->setConstructorArgs( array( 'term', 'category' ) )->getMock();
		$this->category1 = $this->factory->category->create();
		$this->category2 = $this->factory->category->create();
	}

	public function tearDown() {
		unset( $this->locator );
		unset( $this->category1 );
		unset( $this->category2 );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::get_items
	 */
	public function testWithCurrentTerm() {
		$this->go_to( '?cat=' . $this->category1 );

		$expected = $this->locator->get_item_hierarchy( $this->category1, 1000 );
		$actual   = $this->locator->get_items();

		foreach ( $expected as $key => $expectedItem ) {
			$this->assertInstanceOf( get_class( $expectedItem ), $actual[ $key ] );
			$this->assertSame( $expectedItem->get_id(), $actual[ $key ]->get_id() );
			$this->assertSame( $expectedItem->get_type(), $actual[ $key ]->get_type() );
			$this->assertSame( $expectedItem->get_subtype(), $actual[ $key ]->get_subtype() );
		}
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::get_items
	 */
	public function testWithSpecificTerm() {
		$this->go_to( '?cat=' . $this->category2 );

		$expected = $this->locator->get_item_hierarchy( $this->category1, 1000 );
		$actual   = $this->locator->get_items( 1000, $this->category1 );

		foreach ( $expected as $key => $expectedItem ) {
			$this->assertInstanceOf( get_class( $expectedItem ), $actual[ $key ] );
			$this->assertSame( $expectedItem->get_id(), $actual[ $key ]->get_id() );
			$this->assertSame( $expectedItem->get_type(), $actual[ $key ]->get_type() );
			$this->assertSame( $expectedItem->get_subtype(), $actual[ $key ]->get_subtype() );
		}
	}

}
