Carbon Breadcrumbs
==================

A basic WordPress plugin for breadcrumbs with advanced capabilities for extending.
Provides the theme and plugin developers an easy way to build and implement highly customizable breadcrumb functionality, specifically tailored to their needs.

- - -

Administration & Settings
------

Although this plugin provides various ways to be extended, it can be used by people with no programming skills.

If Carbon Breadcrumbs is installed and activated as a WordPress plugin, a `Carbon Breadcrumbs` page will appear in `Settings` in the WordPress administration. This page allows the default rendering settings to be modified to the preferred ones. The following settings are available:

* **Glue** - Displayed between the breadcrumb items.
* **Link Before** - Displayed before the breadcrumb item link.
* **Link After** - Displayed after the breadcrumb item link.
* **Wrapper Before** - Displayed before displaying the breadcrumb items.
* **Wrapper After** - Displayed after displaying the breadcrumb items.
* **Title Before** - Displayed before the breadcrumb item title.
* **Title After** - Displayed after the breadcrumb item title.
* **Min Items** - Determines the minimum number of items, required to display the breadcrumb trail.
* **Last Item Link** - Whether the last breadcrumb item should be a link.
* **Display Home Item?** - Whether the home breadcrumb item should be displayed.
* **Home Item Title** - Determines the title of the home item (if NOT using page_on_front).

If this plugin is manually included in a theme, the administration settings page will not be shown by default. This allows theme developers to disable control over the breadcrumb trail settings, if necessary. In this case, the administration settings can still be enabled by defining the `CARBON_BREADCRUMB_ENABLE_ADMIN` constant and setting it to true. To do that, add the following line to your theme `functions.php` file:

	define('CARBON_BREADCRUMB_ENABLE_ADMIN', true);

**Note:** The administration settings override the default breadcrumb settings, by using the `carbon_breadcrumbs_renderer_default_options` filter. This means that developers can still override these settings by using the `carbon_breadcrumbs_before_render` action. Both `carbon_breadcrumbs_renderer_default_options` and `carbon_breadcrumbs_before_render` are documented below in this readme.

- - -

Usage & Examples
------

#### Basic

The following example is the most basic way to display a breadcrumb trail, using the default options.
	
	<?php Carbon_Breadcrumb_Trail::output(); ?>

#### Simple with configuration options

The following example will display a breadcrumb trail with the specified settings.

	<?php
	Carbon_Breadcrumb_Trail::output(array(
		'glue' => ' &gt; ', // glue between breadcrumb items
		'link_before' => '',
		'link_after' => '',
		'wrapper_before' => '',
		'wrapper_after' => '',
		'title_before' => '',
		'title_after' => '',
		'min_items' => 2,
		'last_item_link' => true,
		'display_home_item' => true,
		'home_item_title' => __('Home', 'crb'),
	));
	?>

#### Intermediate

The following example will create and render an breadcrumb trail, providing you the option to set it up yourself with your preferred configuration. You can further manipulate the trail object by using its built-in methods.

	<?php
	$trail = new Carbon_Breadcrumb_Trail(array(
		'glue' => ' &gt; ',
		'link_before' => '',
		'link_after' => '',
		'wrapper_before' => '',
		'wrapper_after' => '',
		'title_before' => '',
		'title_after' => '',
		'min_items' => 2,
		'last_item_link' => true,
		'display_home_item' => true,
		'home_item_title' => __('Home', 'crb'),
	));
	$trail->setup(); // setup the trail by generating necessary breadcrumb items
	$trail->render(); // display the breadcrumb trail
	?>

#### Advanced

The following example will create, setup and render a breadcrumb trail with a custom breadcrumb items and will use a custom renderer. It also takes advantage of some of the available filters and actions. Each portion of the code can be used separately in case you need to perform advanced manipulation on the trail. The following can be seen in the example: custom renderer setup, prepending text to specific items, appending something to the URLs of some items, adding a custom item, adding a page item along with its ancenstry, removing a certain item by name and link, removing all items by priority, initialization with setup and rendering. Each portion of the code is commented accordingly so you can understand what it does.

	<?php
	# A custom breadcrumb trail renderer class
	class Crb_Carbon_Breadcrumb_Trail_Renderer extends Carbon_Breadcrumb_Trail_Renderer {
		// your custom renderer methods & overrides here
	}

	# Modify the default breadcrumb trail renderer class
	function crb_carbon_breadcrumbs_renderer_class($renderer_class) {
		return 'Crb_Carbon_Breadcrumb_Trail_Renderer';
	}

	# Prepend "Blog Post: " to the title of the post items
	add_filter('carbon_breadcrumbs_item_title', 'crb_carbon_breadcrumbs_item_title_post', 10, 2);
	function crb_carbon_breadcrumbs_item_title_post($item_title, $item) {
		if ( is_a($item, 'Carbon_Breadcrumb_Item_Post') && $item->get_subtype() == 'post' ) {
			$item_title = 'Blog Post: ' . $item_title;
		}
		return $item_title;
	}

	# Append "?test=1" to the link of the post items
	add_filter('carbon_breadcrumbs_item_link', 'crb_carbon_breadcrumbs_item_link_post', 10, 2);
	function crb_carbon_breadcrumbs_item_link_post($item_link, $item) {
		if ( is_a($item, 'Carbon_Breadcrumb_Item_Post') && $item->get_subtype() == 'post' ) {
			$item_link = add_query_arg('test', 1, $item_link);
		}
		return $item_link;
	}

	# Add a new custom item by specifying title, link and priority
	add_action('carbon_breadcrumbs_after_setup_trail', 'crb_add_custom_item');
	function crb_add_custom_item($trail) {
		$trail->add_custom_item('Link Title', 'http://example.com/custom/link/', 500);
	}

	# Add a new page item and its ancestry
	add_action('carbon_breadcrumbs_after_setup_trail', 'crb_add_test_page_item');
	function crb_add_test_page_item($trail) {
		$locator = Carbon_Breadcrumb_Locator::factory('post', 'page');
		$priority = 500;
		$page_id = 123;
		$items = $locator->get_items($priority, $page_id);
		if ($items) {
			$trail->add_item($items);
		}
	}

	# Remove the "Electronics" category item
	add_action('carbon_breadcrumbs_after_setup_trail', 'crb_remove_electronics_category_item', 500);
	function crb_remove_electronics_category_item($trail) {
		$trail->remove_item('Electronics', 'http://example.com/category/electronics/');
	}

	# Remove all items with priority 999
	add_action('carbon_breadcrumbs_after_setup_trail', 'crb_remove_items_priority_999', 500);
	function crb_remove_items_priority_999($trail) {
		$trail->remove_item_by_priority(999);
	}

	# Initialize the trail as bulleted list
	$trail = new Carbon_Breadcrumb_Trail(array(
		'glue' => '',
		'link_before' => '<li>',
		'link_after' => '</li>',
		'wrapper_before' => '<ul>',
		'wrapper_after' => '</ul>',
		'title_before' => '',
		'title_after' => '',
		'min_items' => 1,
		'last_item_link' => true,
		'display_home_item' => true,
		'home_item_title' => __('Home', 'crb'),
	));

	# Setup the trail by generating necessary breadcrumb items
	$trail->setup();

	# Display the breadcrumb trail
	$trail->render();
	?>

- - -

Configuration Options
------

The following options can be passed to `Carbon_Breadcrumb_Trail()`, `Carbon_Breadcrumb_Trail::output()` or `Carbon_Breadcrumb_Trail_Renderer()` - whichever you are using.

#### glue

_(string). Default: **' &gt; '**_.

The HTML, displayed between the breadcrumb items.

#### link_before

_(string). Default: **''** (none)_.

The HTML before the `<a>` link of each of the breadcrumb items.

#### link_after

_(string). Default: **''** (none)_.

The HTML after the `<a>` link of each of the breadcrumb items.

#### wrapper_before

_(string). Default: **''** (none)_.

The HTML before all breadcrumb items.

#### wrapper_after

_(string). Default: **''** (none)_.

The HTML after all breadcrumb items.

#### title_before

_(string). Default: **''** (none)_.

The HTML displayed before the breadcrumb item title.

#### title_after

_(string). Default: **''** (none)_.

The HTML displayed after the breadcrumb item title.

#### min_items

_(int). Default: **2**_.

The minimum number of breadcrumb items, required to display the trail.

#### last\_item_link

_(bool). Default: **true**_.

Whether the last item will be a link or not.

#### display\_home_item

_(bool). Default: **true**_.

Whether the **Home** breadcrumb item should be displayed or not.

#### home\_item_title

_(string). Default: **Home**_.

The title of the home item, used if there is no page specified as `page_on_front`.

- - -

Actions & Filters
------

The following actions and filters can allow developers to modify the default behavior and hook to add custom functionality in various situations.

- - -

### Filters

#### the\_title

**$title** *(string)*. The unfiltered title of the item.

This filter is default for WordPress and is applied on the titles of all Post, Term and User breadcrumb items.

#### carbon\_breadcrumbs\_renderer\_class

**$class_name** *(string)*. The name of the renderer class.

This filter can allow you to modify the default renderer class, which is used for rendering the breadcrumb trail.

#### carbon\_breadcrumbs\_renderer\_default\_options

**$options** *(array)*. A list of all default options.

This filter allows you to modify the default options of the breadcrumb renderer. They are used if no other settings are specified. Here is a list of all default options and their default values:

	$default_options = array(
		'glue' => ' &gt; ',
		'link_before' => '',
		'link_after' => '',
		'wrapper_before' => '',
		'wrapper_after' => '',
		'title_before' => '',
		'title_after' => '',
		'min_items' => 2,
		'last_item_link' => true,
		'display_home_item' => true,
		'home_item_title' => __('Home', 'crb'),
	);

#### carbon\_breadcrumbs\_auto\_sort\_items

**$autosort** *(bool)*. Whether to autosort the items before rendering or not.

This filter allows you to specify whether to automatically sort the items by their priority right before they are rendered. 

#### carbon\_breadcrumbs\_item

**$item** *(Carbon\_Breadcrumb\_Item)*. The breadcrumb item object.

This filter allows you to modify a breadcrumb item right before its rendering.

#### carbon\_breadcrumbs\_item\_link

**$link** *(string)*. The link of the breadcrumb item.

This filter allows you to modify the link URL of a breadcrumb item right before its rendering.

#### carbon\_breadcrumbs\_item\_title

**$title** *(string)*. The title of the breadcrumb item.

This filter allows you to modify the title of a breadcrumb item right before its rendering.

#### carbon\_breadcrumbs\_item\_attributes

**$attributes** *(array)*. The custom attributes of the breadcrumb item.

This filter allows you to modify the link attributes of a breadcrumb item right before its rendering. By default, the `target="_self"` attribute is added. This array expects the attribute name as the array element key, and the attribute value as the array element value. Example: `'target' => '_blank'`.

- - -

### Actions

#### carbon\_breadcrumbs\_before\_setup\_trail

**$trail** *(Carbon\_Breadcrumb\_Trail)*. The breadcrumb trail object.

This action allows you to modify the breadcrumb trail object before the setup (which adds breadcrumb items) has started.

#### carbon\_breadcrumbs\_after\_setup\_trail

**$trail** *(Carbon\_Breadcrumb\_Trail)*. The breadcrumb trail object.

This action allows you to modify the breadcrumb trail object after the setup (which adds breadcrumb items) has been completed.

#### carbon\_breadcrumbs\_before\_render

**$trail** *(Carbon\_Breadcrumb\_Trail)*. The breadcrumb trail object.

This action allows you to modify the breadcrumb trail object right before the breadcrumb trail rendering.