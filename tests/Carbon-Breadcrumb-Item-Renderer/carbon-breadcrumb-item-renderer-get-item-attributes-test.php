<?php
/**
 * @group item_renderer
 */
class CarbonBreadcrumbItemRendererGetItemAttributesTest extends WP_UnitTestCase {

	public function custom_attributes_filter( $attributes = '' ) {
		$attributes['class'] = 'foo-bar';
		$attributes['id']    = 'FooBar';
		return $attributes;
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item' );

		$this->item_renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Item_Renderer' )->setMethods( null )->disableOriginalConstructor()->getMock();
		$this->item_renderer->set_item( $this->item );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
		unset( $this->item_renderer );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Renderer::get_item_attributes_html().
	 *
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_item_attributes_html
	 */
	public function testDefaultAttributes() {
		$default_attributes = ' target="_self"';
		$this->assertSame( $default_attributes, $this->item_renderer->get_item_attributes_html() );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Renderer::get_item_attributes_html().
	 *
	 * @covers Carbon_Breadcrumb_Item_Renderer::get_item_attributes_html
	 */
	public function testAttributesFilter() {
		add_filter( 'carbon_breadcrumbs_item_attributes', array( $this, 'custom_attributes_filter' ) );

		$expected = ' target="_self" class="foo-bar" id="FooBar"';
		$this->assertSame( $expected, $this->item_renderer->get_item_attributes_html() );

		remove_filter( 'carbon_breadcrumbs_item_attributes', array( $this, 'custom_attributes_filter' ) );
	}

}
