<?php
/**
 * @group trail_setup
 */
class CarbonBreadcrumbTrailSetupPopulateDateArchiveItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->trail = $this->getMock('Carbon_Breadcrumb_Trail', null);
		$this->setup = $this->getMock('Carbon_Breadcrumb_Trail_Setup', null, array(), '', false);
		$this->post = $this->factory->post->create();

		$this->setup->set_trail( $this->trail );
	}

	public function tearDown() {
		unset( $this->trail );
		unset( $this->setup );
		unset( $this->post );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_date_archive_items
	 */
	public function testWithYearArchive() {
		$this->go_to('/?year=' . date('Y') );

		$this->setup->populate_date_archive_items();

		$expected_items = Carbon_Breadcrumb_Locator::factory( 'date' )->get_items();
		$actual_items = array_values($this->trail->get_items());
		foreach ($expected_items as $key => $item) {
			$actual_item = $actual_items[0][$key];

			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( get_class($item), get_class($actual_item) );
		}
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_date_archive_items
	 */
	public function testWithMonthArchive() {
		$this->go_to('/?year=' . date('Y') . '&monthnum=' . date('m') );

		$this->setup->populate_date_archive_items();

		$expected_items = Carbon_Breadcrumb_Locator::factory( 'date' )->get_items();
		$actual_items = array_values($this->trail->get_items());
		foreach ($expected_items as $key => $item) {
			$actual_item = $actual_items[0][$key];

			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( get_class($item), get_class($actual_item) );
		}
	}

	/**
	 * @covers Carbon_Breadcrumb_Trail_Setup::populate_date_archive_items
	 */
	public function testWithDayArchive() {
		$this->go_to('/?year=' . date('Y') . '&monthnum=' . date('m') . '&day=' . date('d') );

		$this->setup->populate_date_archive_items();

		$expected_items = Carbon_Breadcrumb_Locator::factory( 'date' )->get_items();
		$actual_items = array_values($this->trail->get_items());
		foreach ($expected_items as $key => $item) {
			$actual_item = $actual_items[0][$key];

			$this->assertSame( $item->get_type(), $actual_item->get_type() );
			$this->assertSame( $item->get_subtype(), $actual_item->get_subtype() );
			$this->assertSame( get_class($item), get_class($actual_item) );
		}
	}

}
