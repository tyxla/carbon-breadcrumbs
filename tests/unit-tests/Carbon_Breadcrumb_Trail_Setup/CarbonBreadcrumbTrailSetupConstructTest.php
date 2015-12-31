<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupConstructTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->setup = $this->getMock('Carbon_Breadcrumb_Trail_Setup', null, array(), '', false);
	}

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