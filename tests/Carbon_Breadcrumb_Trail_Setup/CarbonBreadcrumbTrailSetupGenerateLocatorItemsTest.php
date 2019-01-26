<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupGenerateLocatorItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup_Generate_Locator_Items_Exposed' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->post  = $this->factory->post->create();
	}

	public function tearDown() {
		parent::tearDown();

		unset( $this->trail );
		unset( $this->setup );
		unset( $this->post );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::generate_locator_items
	 */
	public function testLocatorGenerationPost() {
		$this->go_to( '?p=' . $this->post );

		$locator  = Carbon_Breadcrumb_Locator::factory( 'post' );
		$expected = $locator->generate_items();
		$actual   = $this->setup->exposed_generate_locator_items( 'post' );

		$this->assertSame( count( $expected ), count( $actual ) );
		foreach ( $expected as $key => $expectedItem ) {
			$this->assertSame( $expectedItem->get_id(), $actual[ $key ]->get_id() );
			$this->assertSame( $expectedItem->get_title(), $actual[ $key ]->get_title() );
			$this->assertSame( $expectedItem->get_link(), $actual[ $key ]->get_link() );
			$this->assertSame( $expectedItem->get_priority(), $actual[ $key ]->get_priority() );
			$this->assertSame( get_class( $expectedItem ), get_class( $actual[ $key ] ) );
		}
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::generate_locator_items
	 */
	public function testLocatorGeneration404() {
		$this->go_to( '?p=123456' );

		$actual = $this->setup->exposed_generate_locator_items( 'post' );

		$this->assertSame( array(), $actual );
	}

}

/**
 * Helper for exposing the protected Carbon_Breadcrumb_Trail_Setup::generate_locator_items()
 */
class Carbon_Breadcrumb_Trail_Setup_Generate_Locator_Items_Exposed extends Carbon_Breadcrumb_Trail_Setup {
	public function exposed_generate_locator_items( $locator_name ) {
		return $this->generate_locator_items( $locator_name );
	}
}
