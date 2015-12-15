<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererPrepareForRenderingTest extends WP_UnitTestCase {

	public $glue = ' => ';

	public function carbon_breadcrumbs_before_render($trail_renderer) {
		$trail_renderer->set_glue( $this->glue );
	}

	public function carbon_breadcrumbs_auto_sort_items($sort) {
		return false;
	}

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->trail_renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null);

		$this->item1 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item2 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item3 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');

		$this->item1->set_priority( 500 );
		$this->item2->set_priority( 200 );
		$this->item3->set_priority( 300 );

		$this->trail->add_item( array(
			$this->item1,
			$this->item2,
			$this->item3,
		) );
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->trail_renderer );
		unset( $this->item1 );
		unset( $this->item2 );
		unset( $this->item3 );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering
	 */
	public function testBeforeRenderHook() {
		add_action( 'carbon_breadcrumbs_before_render', array($this, 'carbon_breadcrumbs_before_render') );

		$this->trail_renderer->prepare_for_rendering( $this->trail );

		$this->assertSame( $this->glue, $this->trail_renderer->get_glue() );

		remove_action( 'carbon_breadcrumbs_before_render', array($this, 'carbon_breadcrumbs_before_render') );
	}

	/**
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
	 * @covers Carbon_Breadcrumb_Trail_Renderer::prepare_for_rendering
	 */
	public function testSortingDisabledByFilter() {
		add_filter( 'carbon_breadcrumbs_auto_sort_items', array($this, 'carbon_breadcrumbs_auto_sort_items') );

		$this->trail_renderer->prepare_for_rendering( $this->trail );

		$expected = array(
			$this->item1,
			$this->item2,
			$this->item3,
		);
		$this->assertSame( $expected, $this->trail->get_flat_items() );

		remove_filter( 'carbon_breadcrumbs_auto_sort_items', array($this, 'carbon_breadcrumbs_auto_sort_items') );
	}

}