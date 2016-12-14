<?php
/**
 * @group trail_renderer
 */
class CarbonBreadcrumbTrailRendererGetSetTitleBeforeTest extends WP_UnitTestCase {

	public function setUp() {
		$this->renderer = $this->getMock('Carbon_Breadcrumb_Trail_Renderer', null);
		
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
		
		unset( $this->renderer );
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Renderer::get_title_before
	 * @covers Carbon_Breadcrumb_Trail_Renderer::set_title_before
	 */
	public function testGetSetRenderer() {
		$title_before = 'foobar';
		$this->renderer->set_title_before( $title_before );
		$this->assertSame( $title_before, $this->renderer->get_title_before() );
	}

}