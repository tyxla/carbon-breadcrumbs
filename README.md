Carbon Breadcrumbs
==================

A basic WordPress plugin for breadcrumbs with advanced capabilities for extending.
Provides the theme and plugin developers an easy way to build and implement highly customizable breadcrumb functionality, specifically tailored to their needs.

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
		'glue' => ' / ',
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

The following example will create, setup and render a breadcrumb trail with a custom breadcrumb item and will use a custom renderer. It also takes advantage of some of the available filters and actions.

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