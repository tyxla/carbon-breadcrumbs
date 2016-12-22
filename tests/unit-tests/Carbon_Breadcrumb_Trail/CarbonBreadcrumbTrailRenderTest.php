<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailRenderTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', array('get_renderer'));
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null, array(), '', false);

		$this->trail->expects($this->any())
			->method('get_renderer')
			->will($this->returnValue($this->renderer));

		$this->item1 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		$this->item2 = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');

		$this->item1->set_link( '#1' );
		$this->item2->set_link( '#2' );

		$this->item1->set_title( 'Item 1' );
		$this->item2->set_title( 'Item 2' );

		$this->trail->add_item(array(
			$this->item1,
			$this->item2,
		));
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->trail );
		unset( $this->renderer );
		unset( $this->item1 );
		unset( $this->item2 );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::render
	 */
	public function testReturnedOutput() {
		$expected = $this->renderer->render( $this->trail, true );
		$actual = $this->trail->render( true );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::render
	 */
	public function testEchoedOutput() {
		$expected = $this->renderer->render( $this->trail, true );
		$expected = wp_kses( $expected, wp_kses_allowed_html( 'post' ) );

		ob_start();
		$this->trail->render();
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

}