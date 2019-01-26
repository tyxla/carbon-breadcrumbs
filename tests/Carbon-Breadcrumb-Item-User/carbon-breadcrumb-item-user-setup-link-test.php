<?php
/**
 * Tests for Carbon_Breadcrumb_Item_User::setup_link()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_Item_User::setup_link()
 *
 * @group item
 */
class CarbonBreadcrumbItemUserSetupLinkTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->item = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Item_User', array(), '', false );
		$this->user = $this->factory->user->create();
		$this->item->set_id( $this->user );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->item );
		unset( $this->user );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Item_User::setup_link().
	 *
	 * @covers Carbon_Breadcrumb_Item_User::setup_link
	 */
	public function testItemLink() {
		$this->assertSame( null, $this->item->get_link() );

		$this->item->setup_link();

		$this->assertSame( get_author_posts_url( $this->user ), $this->item->get_link() );
	}

}
