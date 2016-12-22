<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererConstructTest extends WP_UnitTestCase {

	public function carbon_breadcrumbs_renderer_default_options() {
		return array(
			'min_items' => 5,
		);
	}

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null, array(), '', false);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testDefaultSettings() {
		$this->renderer->__construct();
		$this->assertSame( 'Home', $this->renderer->get_home_item_title() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testWithSomeUnexistingSettings() {
		$this->renderer->__construct(array(
			'home_item_title' => 'Foo',
			'foo' => 'Bar',
		));
		
		$this->assertSame( 'Foo', $this->renderer->get_home_item_title() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testWithSomeExistingSettings() {
		$this->renderer->__construct(array(
			'glue' => ' => ',
			'min_items' => 3,
			'last_item_link' => false,
		));
		
		$this->assertSame( 'Home', $this->renderer->get_home_item_title() );
		$this->assertSame( ' => ', $this->renderer->get_glue() );
		$this->assertSame( 3, $this->renderer->get_min_items() );
		$this->assertSame( false, $this->renderer->get_last_item_link() );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testArgumentFilter() {
		add_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );

		$this->renderer->__construct();
		
		$this->assertSame( 5, $this->renderer->get_min_items() );

		remove_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::__construct
	 */
	public function testArgumentArgsPriorityToFilter() {
		add_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );

		$this->renderer->__construct(array(
			'min_items' => 3,
		));
		
		$this->assertSame( 3, $this->renderer->get_min_items() );

		remove_filter( 'carbon_breadcrumbs_renderer_default_options', array( $this, 'carbon_breadcrumbs_renderer_default_options' ) );
	}

}