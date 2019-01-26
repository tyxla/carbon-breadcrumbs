<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorDateGetArchiveItemDetailsTest extends WP_UnitTestCase {
	/**
	 * Test setup
	 */
	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Date', array( 'test1', 'test2' ) );
		$this->post    = $this->factory->post->create();
	}

	/**
	 * Test teardown
	 */
	public function tearDown() {
		unset( $this->locator );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Date::get_archive_item_details().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Date::get_archive_item_details
	 */
	public function testOnYearArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) );

		$expected = array(
			'year'  => array(
				'condition'    => true,
				'title_format' => 'Y',
				'link'         => get_year_link( date( 'Y' ) ),
			),
			'month' => array(
				'condition'    => false,
				'title_format' => 'F',
				'link'         => get_month_link( date( 'Y' ), date( 'm' ) ),
			),
			'day'   => array(
				'condition'    => false,
				'title_format' => 'd',
				'link'         => get_day_link( date( 'Y' ), date( 'm' ), date( 'd' ) ),
			),
		);
		$actual   = $this->locator->get_archive_item_details();

		$this->assertSame( $expected, $actual );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Date::get_archive_item_details().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Date::get_archive_item_details
	 */
	public function testOnMonthArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) );

		$expected = array(
			'year'  => array(
				'condition'    => true,
				'title_format' => 'Y',
				'link'         => get_year_link( date( 'Y' ) ),
			),
			'month' => array(
				'condition'    => true,
				'title_format' => 'F',
				'link'         => get_month_link( date( 'Y' ), date( 'm' ) ),
			),
			'day'   => array(
				'condition'    => false,
				'title_format' => 'd',
				'link'         => get_day_link( date( 'Y' ), date( 'm' ), date( 'd' ) ),
			),
		);
		$actual   = $this->locator->get_archive_item_details();

		$this->assertSame( $expected, $actual );
	}

	/**
	 * Tests for Carbon_Breadcrumb_Locator_Date::get_archive_item_details().
	 *
	 * @covers Carbon_Breadcrumb_Locator_Date::get_archive_item_details
	 */
	public function testOnDayArchive() {
		$this->go_to( '/?year=' . date( 'Y' ) . '&monthnum=' . date( 'm' ) . '&day=' . date( 'd' ) );

		$expected = array(
			'year'  => array(
				'condition'    => true,
				'title_format' => 'Y',
				'link'         => get_year_link( date( 'Y' ) ),
			),
			'month' => array(
				'condition'    => true,
				'title_format' => 'F',
				'link'         => get_month_link( date( 'Y' ), date( 'm' ) ),
			),
			'day'   => array(
				'condition'    => true,
				'title_format' => 'd',
				'link'         => get_day_link( date( 'Y' ), date( 'm' ), date( 'd' ) ),
			),
		);
		$actual   = $this->locator->get_archive_item_details();

		$this->assertSame( $expected, $actual );
	}

}
