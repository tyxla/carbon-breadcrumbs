<?php
/**
 * @group trail
 */
class CarbonBreadcrumbTrailSortItemsTest extends WP_UnitTestCase {

	public function setUp() {
		$this->trail = $this->getMockBuilder( 'Carbon_Breadcrumb_Trail' )->setMethods( null )->getMock();
	}

	public function tearDown() {
		unset( $this->trail );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail::sort_items
	 */
	public function testSortItems() {
		$original = array(
			5 => array(),
			3 => array(),
			10 => array(),
			1 => array(),
			21 => array(),
			9 => array()
		);
		$this->trail->set_items( $original );
		$this->trail->sort_items();

		$expected = array(
			1 => array(),
			3 => array(),
			5 => array(),
			9 => array(),
			10 => array(),
			21 => array(),
		);
		$this->assertSame( $expected, $this->trail->get_items() );
	}

}