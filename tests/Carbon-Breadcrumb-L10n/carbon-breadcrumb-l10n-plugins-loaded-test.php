<?php
/**
 * @group l10n
 */
class CarbonBreadcrumbL10nPluginsLoadedTest extends WP_UnitTestCase {

	public function locale( $locale ) {
		return 'bg_BG';
	}

	public function load_textdomain_mofile( $mofile, $domain ) {
		if ( $domain === 'carbon_breadcrumbs' ) {
			$filename   = basename( $mofile );
			$plugin_dir = dirname( dirname( dirname( dirname( __FILE__ ) ) ) );
			$path       = $plugin_dir . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $filename;
			return $path;
		}

		return $mofile;
	}

	/**
	 * Test setup
	 */
	public function setUp() {
		$this->l10n = $this->getMockBuilder( 'Carbon_Breadcrumb_L10n' )->setMethods( null )->disableOriginalConstructor()->getMock();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->l10n );
	}

	/**
	 * @covers Carbon_Breadcrumb_L10n::plugins_loaded
	 */
	public function testTextdomainLoaded() {
		$this->markTestSkipped( 'Plugin localizations are now automatically loaded.' );

		add_filter( 'locale', array( $this, 'locale' ) );
		add_filter( 'load_textdomain_mofile', array( $this, 'load_textdomain_mofile' ), 10, 2 );

		$this->l10n->plugins_loaded();

		$this->assertArrayHasKey( 'carbon_breadcrumbs', $l10n );

		remove_filter( 'locale', array( $this, 'locale' ) );
		remove_filter( 'load_textdomain_mofile', array( $this, 'load_textdomain_mofile' ), 10, 2 );
	}

}
