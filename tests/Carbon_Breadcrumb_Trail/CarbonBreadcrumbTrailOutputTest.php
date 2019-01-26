<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailOutputTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();

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
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->item1 );
		unset( $this->item2 );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::output
	 */
	public function testDefaultArgs() {
		ob_start();
		$trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$trail->setup();
		$trail->render();
		$expected = ob_get_clean();

		ob_start();
		Carbon_Breadcrumb_Trail::output();
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::output
	 */
	public function testCustomArgs() {
		$args = array(
			'glue' => ' => ',
		);

		ob_start();
		$renderer = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail_Renderer' )->setMethods( null )->setConstructorArgs( $args )->getMock();
		$trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
		$trail->set_renderer( $renderer );
		$trail->setup();
		$trail->render();
		$expected = ob_get_clean();

		ob_start();
		Carbon_Breadcrumb_Trail::output( $args );
		$actual = ob_get_clean();

		$this->assertSame( $expected, $actual );
	}

}