<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemGetSetAttributesTest extends WP_UnitTestCase {

	public function setUp() {
		$this->item = $this->getMockForAbstractClass('Carbon_Breadcrumb_Item');
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->item );
	}

	/**
	 * @covers Carbon_Breadcrumb_Item::get_attributes
	 * @covers Carbon_Breadcrumb_Item::set_attributes
	 */
	public function testGetSetAttributes() {
		$expected = array(
			'target' => '_blank',
			'class' => 'foo-bar',
		);
		$this->item->set_attributes( $expected );
		$this->assertSame( $expected, $this->item->get_attributes() );
	}

}