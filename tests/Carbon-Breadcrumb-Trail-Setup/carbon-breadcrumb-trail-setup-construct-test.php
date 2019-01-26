<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupConstructTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::__construct
	 */
	public function testTrailSet() {
		$this->setup->__construct( $this->trail );
		$this->assertSame( $this->trail, $this->setup->get_trail() );
	}

}
