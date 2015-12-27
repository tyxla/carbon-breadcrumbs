<?php
/**
 * @group l10n
 */
class CarbonBreadcrumbL10nConstructTest extends WP_UnitTestCase {

	public function setUp() {
		$this->l10n = $this->getMockForAbstractClass('Carbon_Breadcrumb_L10n', array(), '', false);
	}

	public function tearDown() {
		unset( $this->l10n );
	}

	/**
	 * @covers Carbon_Breadcrumb_L10n::__construct
	 */
	public function testHookRegistered() {
		$this->l10n->__construct();

		$this->assertSame( 10, has_filter( 'plugins_loaded', array( $this->l10n, 'plugins_loaded' ) ) );
	}

}