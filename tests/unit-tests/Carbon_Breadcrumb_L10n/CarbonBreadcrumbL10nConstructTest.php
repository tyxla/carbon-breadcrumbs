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
		global $wp_filter;

		$this->l10n->__construct('foo', 'bar');

		$expected = array(
			'function' => array(
				0 => $this->l10n,
				1 => 'plugins_loaded',
			),
			'accepted_args' => 1,
		);
		$this->assertContains( $expected, $wp_filter['plugins_loaded'][10] );
	}

}