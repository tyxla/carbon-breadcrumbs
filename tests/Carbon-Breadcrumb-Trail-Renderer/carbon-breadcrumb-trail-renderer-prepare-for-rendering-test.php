<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererPrepareForRenderingTest extends WP_UnitTestCase {
	/**
	 * Glue string.
	 *
	 * @var string
	 **/
	public $glue = ' => ';

	/**
	 * Set the glue of trail renderer.
	 *
	 * @param Carbon_Breadcrumb_Trail_Renderer $trail_renderer Renderer object.
	 */
	public function carbon_breadcrumbs_before_render( $trail_renderer ) {
		$trail_renderer->set_glue( $this->glue );
	}

	/**
	 * Filter whether to auto sort the items.
	 *
	 * @param boolean $sort Whether to sort the items.
	 * @return boolean Whether to sort the items.
	 */
	public function carbon_breadcrumbs_auto_sort_items( $sort ) {
		return false;
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->trail          = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$this->trail_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->getMock();

		$this->item1 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item2 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );
		$this->item3 = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );

		$this->item1->set_priority( 500 );
		$this->item2->set_priority( 200 );
		$this->item3->set_priority( 300 );

		$this->trail->add_item(
			array(
				$this->item1,
				$this->item2,
				$this->item3,
			)
		);
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->trail );
		unset( $this->trail_renderer );
		unset( $this->item1 );
		unset( $this->item2 );
		unset( $this->item3 );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering
	 */
	public function testBeforeRenderHook() {
		add_action( 'carbon_breadcrumbs_before_render', array( $this, 'carbon_breadcrumbs_before_render' ) );

		$this->trail_renderer->prepare_for_rendering( $this->trail );

		$this->assertSame( $this->glue, $this->trail_renderer->get_glue() );

		remove_action( 'carbon_breadcrumbs_before_render', array( $this, 'carbon_breadcrumbs_before_render' ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering
	 */
	public function testSortingEnabledByDefault() {
		$this->trail_renderer->prepare_for_rendering( $this->trail );

		$expected = array(
			$this->item2,
			$this->item3,
			$this->item1,
		);
		$this->assertSame( $expected, $this->trail->get_flat_items() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering
	 */
	public function testSortingDisabledByFilter() {
		add_filter( 'carbon_breadcrumbs_auto_sort_items', array( $this, 'carbon_breadcrumbs_auto_sort_items' ) );

		$this->trail_renderer->prepare_for_rendering( $this->trail );

		$expected = array(
			$this->item1,
			$this->item2,
			$this->item3,
		);
		$this->assertSame( $expected, $this->trail->get_flat_items() );

		remove_filter( 'carbon_breadcrumbs_auto_sort_items', array( $this, 'carbon_breadcrumbs_auto_sort_items' ) );
	}

}
