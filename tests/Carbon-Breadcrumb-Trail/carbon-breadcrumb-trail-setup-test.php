<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailSetupTest extends WP_UnitTestCase {
	protected $glue_before = ' => ';
	protected $glue_after  = ' -> ';

	public function modifyTrailGlueBefore() {
		$this->trail->get_renderer()->set_glue( $this->glue_before );
	}

	public function modifyTrailGlueAfter() {
		$this->trail->get_renderer()->set_glue( $this->glue_after );
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::setup
	 */
	public function testSetupProcess() {
		$this->trail->setup();

		$mock_trail       = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$mock_trail_setup = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Setup' )->setMethods( null )->setConstructorArgs( array( $mock_trail ) )->getMock();

		$trailItems       = $this->trail->get_items();
		$mock_trail_items = $mock_trail->get_items();

		$this->assertSame( count( $mock_trail_items ), count( $trailItems ) );

		foreach ( $mock_trail_items as $priority => $items ) {
			foreach ( $items as $key => $item ) {
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
		$this->assertSame( $this->glue_before, $this->trail->get_renderer()->get_glue() );

		remove_action( 'carbon_breadcrumbs_before_setup_trail', array( $this, 'modifyTrailGlueBefore' ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::setup
	 */
	public function testAfterSetupHook() {
		add_action( 'carbon_breadcrumbs_before_setup_trail', array( $this, 'modifyTrailGlueBefore' ) );
		add_action( 'carbon_breadcrumbs_after_setup_trail', array( $this, 'modifyTrailGlueAfter' ) );

		$this->trail->setup();
		$this->assertSame( $this->glue_after, $this->trail->get_renderer()->get_glue() );

		remove_action( 'carbon_breadcrumbs_before_setup_trail', array( $this, 'modifyTrailGlueBefore' ) );
		remove_action( 'carbon_breadcrumbs_after_setup_trail', array( $this, 'modifyTrailGlueAfter' ) );
	}

}
