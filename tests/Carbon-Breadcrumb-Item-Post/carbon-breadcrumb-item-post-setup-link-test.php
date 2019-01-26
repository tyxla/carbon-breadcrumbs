<?php
/**
 * @group item
 */
class CarbonBreadcrumbItemPostSetupLinkTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_Post', array(), '', false );
		$this->post = $this->factory->post->create();
		$this->item->set_id( $this->post );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_Post::setup_link().
	 *
	 * @covers Carbon_Breadcrumb_Item_Post::setup_link
	 */
	public function testItemLink() {
		$this->assertSame( null, $this->item->get_link() );

		$this->item->setup_link();

		$this->assertSame( get_permalink( $this->post ), $this->item->get_link() );
	}

}
