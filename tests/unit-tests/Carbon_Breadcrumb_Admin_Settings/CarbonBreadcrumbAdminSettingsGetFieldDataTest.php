<?php
/**
 * @group admin_settings
 */
class CarbonBreadcrumbAdminSettingsGetFieldDataTest extends WP_UnitTestCase {

	public function setUp() {
		$this->adminSettings = $this->getMock('Carbon_Breadcrumb_Admin_Settings', null, array(), '', false);
	}

	public function tearDown() {
		unset( $this->adminSettings );
	}

	/**
	 * @covers Carbon_Breadcrumb_Admin_Settings::get_field_data
	 */
	public function testGetFieldData() {
		$expected = array(
			'glue' => array(
				'type' => 'text',
				'title' => 'Glue',
				'default' => ' > ',
				'help' => 'This is displayed between the breadcrumb items.',
			),
			'link_before' => array(
				'type' => 'text',
				'title' => 'Link Before',
				'default' => '',
				'help' => 'This is displayed before the breadcrumb item link.',
			),
			'link_after' => array(
				'type' => 'text',
				'title' => 'Link After',
				'default' => '',
				'help' => 'This is displayed after the breadcrumb item link.',
			),
			'wrapper_before' => array(
				'type' => 'text',
				'title' => 'Wrapper Before',
				'default' => '',
				'help' => 'This is displayed before displaying the breadcrumb items.',
			),
			'wrapper_after' => array(
				'type' => 'text',
				'title' => 'Wrapper After',
				'default' => '',
				'help' => 'This is displayed after displaying the breadcrumb items.',
			),
			'title_before' => array(
				'type' => 'text',
				'title' => 'Title Before',
				'default' => '',
				'help' => 'This is displayed before the breadcrumb item title.',
			),
			'title_after' => array(
				'type' => 'text',
				'title' => 'Title After',
				'default' => '',
				'help' => 'This is displayed after the breadcrumb item title.',
			),
			'min_items' => array(
				'type' => 'text',
				'title' => 'Min Items',
				'default' => 2,
				'help' => 'Determines the minimum number of items, required to display the breadcrumb trail.',
			),
			'last_item_link' => array(
				'type' => 'checkbox',
				'title' => 'Last Item Link',
				'default' => true,
				'help' => 'Whether the last breadcrumb item should be a link.',
			),
			'display_home_item' => array(
				'type' => 'checkbox',
				'title' => 'Display Home Item?',
				'default' => true,
				'help' => 'Whether the home breadcrumb item should be displayed.',
			),
			'home_item_title' => array(
				'type' => 'text',
				'title' => 'Home Item Title',
				'default' => 'Home',
				'help' => 'Determines the title of the home item.',
			),
		);

		$this->assertSame( $expected, $this->adminSettings->get_field_data() );
	}

}
