<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorUserGetItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockBuilder( 'Carbon_Breadcrumb_Locator_User' )->setMethods( null )->setConstructorArgs( array( 'user', 'user' ) )->getMock();
		$this->user1   = $this->factory->user->create();
		$this->user2   = $this->factory->user->create();
	}

	public function tearDown() {
		unset( $this->locator );
		unset( $this->user1 );
		unset( $this->user2 );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_User::get_items
	 */
	public function testWithCurrentUser() {
		$this->go_to( '?author=' . $this->user1 );

		$expected = Carbon_Breadcrumb_Item::factory( 'user', 1000 );
		$expected->set_id( $this->user1 );
		$expected->setup();

		$actual = $this->locator->get_items();

		$this->assertInstanceOf( get_class( $expected ), $actual[0] );
		$this->assertSame( $expected->get_id(), $actual[0]->get_id() );
		$this->assertSame( $expected->get_type(), $actual[0]->get_type() );
		$this->assertSame( $expected->get_subtype(), $actual[0]->get_subtype() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_User::get_items
	 */
	public function testWithSpecificUser() {
		$this->go_to( '?author=' . $this->user2 );

		$expected = Carbon_Breadcrumb_Item::factory( 'user', 1000 );
		$expected->set_id( $this->user1 );
		$expected->setup();

		$actual = $this->locator->get_items( 1000, $this->user1 );

		$this->assertInstanceOf( get_class( $expected ), $actual[0] );
		$this->assertSame( $expected->get_id(), $actual[0]->get_id() );
		$this->assertSame( $expected->get_type(), $actual[0]->get_type() );
		$this->assertSame( $expected->get_subtype(), $actual[0]->get_subtype() );
	}

}
