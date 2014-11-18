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