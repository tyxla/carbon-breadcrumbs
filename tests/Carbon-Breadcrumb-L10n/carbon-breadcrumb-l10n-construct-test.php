<?php
/**
 * Tests for Carbon_Breadcrumb_L10n::__construct()
 *
 * @package carbon-breadcrumbs
 */

/**
 * Test class for Carbon_Breadcrumb_L10n::__construct()
 *
 * @group l10n
 */
class CarbonBreadcrumbL10nConstructTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		$this->l10n = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_L10n', array(), '', false );
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->l10n );
	}

	/**
	 * Tests for Carbon_Breadcrumb_L10n::__construct().
	 *
	 * @covers Carbon_Breadcrumb_L10n::__construct
	 */
	public function testHookRegistered() {
		$this->l10n->__construct();

		$this->assertSame( 10, has_filter( 'plugins_loaded', array( $this->l10n, 'plugins_loaded' ) ) );
	}

}
