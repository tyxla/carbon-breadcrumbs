<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailSetupTest extends WP_UnitTestCase {
	protected $glueBefore = ' => ';
	protected $glueAfter = ' -> ';

	public function modifyTrailGlueBefore() {
		$this->trail->get_renderer()->set_glue( $this->glueBefore );
	}

	public function modifyTrailGlueAfter() {
		$this->trail->get_renderer()->set_glue( $this->glueAfter );
	}

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
	}

	public function tearDown() {
		unset( $this->trail );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::setup
	 */
	public function testSetupProcess() {
		$this->trail->setup();

		$mockTrail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$mockTrailSetup = $this->getMock('Carbon_Breadcrumb_Trail_Setup', null, array($mockTrail));

		$trailItems = $this->trail->get_items();
		$mockTrailItems = $mockTrail->get_items();

		$this->assertSame( count( $mockTrailItems ), count( $trailItems ) );

		foreach ($mockTrailItems as $priority => $items) {
			foreach ($items as $key => $item) {
				$this->assertInstanceOf( get_class( $item ), $trailItems[ $priority ][ $key ] );
			}
		}
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::setup
	 */
	public function testBeforeSetupHook() {
		add_action( 'carbon_breadcrumbs_before_setup_trail', array( $this, 'modifyTrailGlueBefore' ) );

		$this->trail->setup();
		$this->assertSame( $this->glueBefore, $this->trail->get_renderer()->get_glue() );

		remove_action( 'carbon_breadcrumbs_before_setup_trail', array( $this, 'modifyTrailGlueBefore' ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::setup
	 */
	public function testAfterSetupHook() {
		add_action( 'carbon_breadcrumbs_before_setup_trail', array( $this, 'modifyTrailGlueBefore' ) );
		add_action( 'carbon_breadcrumbs_after_setup_trail', array( $this, 'modifyTrailGlueAfter' ) );

		$this->trail->setup();
		$this->assertSame( $this->glueAfter, $this->trail->get_renderer()->get_glue() );

		remove_action( 'carbon_breadcrumbs_before_setup_trail', array( $this, 'modifyTrailGlueBefore' ) );
		remove_action( 'carbon_breadcrumbs_after_setup_trail', array( $this, 'modifyTrailGlueAfter' ) );
	}

}