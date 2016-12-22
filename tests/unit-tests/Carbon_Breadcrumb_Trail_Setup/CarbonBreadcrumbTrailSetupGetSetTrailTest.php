<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupGetSetTrailTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->setup = $this->getMock('Carbon_Breadcrumb_Trail_Setup', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->trail );
		unset( $this->setup );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::get_trail
	 * @covers Carbon_Breadcrumb_Trail_Setup::set_trail
	 */
	public function testGetSetTrail() {
		$this->setup->set_trail( $this->trail );
		$this->assertSame( $this->trail, $this->setup->get_trail() );
	}

}