<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererRenderTest extends WP_UnitTestCase {

	public function carbon_breadcrumbs_before_render() {
		$this->trail->remove_item_by_title('Foo');
	}

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', array('get_min_items', 'get_wrapper_before', 'get_wrapper_after', 'get_glue'), array(), '', false);
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);

		$this->item1 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item2 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');

		$this->item1->set_title( 'Foo' );
		$this->item2->set_title( 'Bar' );

		$this->item1->set_link( '#0' );
		$this->item2->set_link( '#1' );

		$this->trail->add_item(array(
			$this->item1,
			$this->item2,
		));
	}

	public function tearDown() {
		unset( $this->renderer );
		unset( $this->trail );
		unset( $this->item1 );
		unset( $this->item2 );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::render
	 */
	public function testTotalItemsLimitation() {
		$this->renderer->expects($this->any())
			->method('get_min_items')
			->will($this->returnValue(3));

		$actual = $this->renderer->render($this->trail, true);
		$this->assertSame( NULL, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::render
	 */
	public function testTrailPreparation() {
		add_action( 'carbon_breadcrumbs_before_render', array($this, 'carbon_breadcrumbs_before_render') );

		$this->renderer->render($this->trail, true);

		$expected = array($this->item2);
		$actual = $this->trail->get_flat_items();
		$this->assertSame( $expected, $actual );

		remove_action( 'carbon_breadcrumbs_before_render', array($this, 'carbon_breadcrumbs_before_render') );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::render
	 */
	public function testFullOutputReturned() {
		$before = '<span class="wrapper">';
		$after = '</span>';
		$glue = ' => ';

		$this->renderer->expects($this->any())
			->method('get_min_items')
			->will($this->returnValue(1));

		$this->renderer->expects($this->any())
			->method('get_wrapper_before')
			->will($this->returnValue($before));

		$this->renderer->expects($this->any())
			->method('get_wrapper_after')
			->will($this->returnValue($after));

		$this->renderer->expects($this->any())
			->method('get_glue')
			->will($this->returnValue($glue));

		$expected = $before . implode( $glue, $this->renderer->render_items( $this->trail ) ) . $after;
		$actual = $this->renderer->render($this->trail, true);
		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::render
	 */
	public function testFullOutputEchoed() {
		$before = '<span class="wrapper">';
		$after = '</span>';
		$glue = ' => ';

		$this->renderer->expects($this->any())
			->method('get_min_items')
			->will($this->returnValue(1));

		$this->renderer->expects($this->any())
			->method('get_wrapper_before')
			->will($this->returnValue($before));

		$this->renderer->expects($this->any())
			->method('get_wrapper_after')
			->will($this->returnValue($after));

		$this->renderer->expects($this->any())
			->method('get_glue')
			->will($this->returnValue($glue));

		$expected = $before . implode( $glue, $this->renderer->render_items( $this->trail ) ) . $after;
		$expected = wp_kses( $expected, wp_kses_allowed_html( 'post' ) );

		ob_start();
		$this->renderer->render($this->trail);
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

}