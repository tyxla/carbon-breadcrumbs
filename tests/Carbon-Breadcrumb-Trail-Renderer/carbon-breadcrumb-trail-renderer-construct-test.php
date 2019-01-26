<?php
/**
 * Tests for Carbon_Breadcrumb_Trail_Renderer::__construct()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Trail_Renderer::__construct()
 *
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererConstructTest extends WP_UnitTestCase {

	/**
	 * Filter the default renderer options.
	 *
	 * @return array The filtered options.
	 */
	public function carbon_breadcrumbs_renderer_default_options() {
		return array(
			'min_items' => 5,
		);
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->renderer );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testDefaultSettings() {
		$this->renderer->__construct();
		$this->assertSame( 'Home', $this->renderer->get_home_item_title() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testWithSomeUnexistingSettings() {
		$this->renderer->__construct(
			array(
				'home_item_title' => 'Foo',
				'foo'             => 'Bar',
			)
		);

		$this->assertSame( 'Foo', $this->renderer->get_home_item_title() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testWithSomeExistingSettings() {
		$this->renderer->__construct(
			array(
				'glue'           => ' => ',
				'min_items'      => 3,
				'last_item_link' => false,
			)
		);

		$this->assertSame( 'Home', $this->renderer->get_home_item_title() );
		$this->assertSame( ' => ', $this->renderer->get_glue() );
		$this->assertSame( 3, $this->renderer->get_min_items() );
		$this->assertSame( false, $this->renderer->get_last_item_link() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testArgumentFilter() {
		add_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );

		$this->renderer->__construct();

		$this->assertSame( 5, $this->renderer->get_min_items() );

		remove_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Trail_Renderer::__construct().
	 *
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testArgumentArgsPriorityToFilter() {
		add_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );

		$this->renderer->__construct(
			array(
				'min_items' => 3,
			)
		);

		$this->assertSame( 3, $this->renderer->get_min_items() );

		remove_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );
	}

}
