=== Carbon Breadcrumbs ===
Contributors: tyxla
Tags: breadcrumb, breadcrumbs, carbon, admin, trail, settings, developer, configuration, extending, advanced, glue, before, after, auto
Requires at least: 3.8
Tested up to: 4.1.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A basic WordPress plugin for breadcrumbs with advanced capabilities for extending.

== Description ==

Provides the theme and plugin developers an easy way to build and implement highly customizable breadcrumb functionality, specifically tailored to their needs.
Supports a lot of filters and hooks, and is written in OOP style, giving developers full control over the breadcrumb trail items and appearance.
This plugin can also be embedded in themes, instead of installing it as a WordPress plugin.

== Installation ==

1. Install Carbon Breadcrumbs either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin.
1. That's it. You're ready to go! Please, refer to the Configuration section for examples and usage information.

== Configuration ==

The most basic way to insert Carbon Breadcrumbs in your theme code is:

`<?php Carbon_Breadcrumb_Trail::output(); ?>`

If you want to specify various breadcrumb rendering options, you can specify them in an array, like this:

`<?php
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
?>`

For additional configuration and developer documentation, you can visit the Github repository: https://github.com/tyxla/carbon-breadcrumbs

== Ideas and bug reports ==

Any ideas for new modules or any other additional functionality that users would benefit from are welcome. 

If you have an idea for a new feature, or you want to report a bug, feel free to do it here in the Support tab, or you can do it at the Github repository of the project: 

https://github.com/tyxla/carbon-breadcrumbs

== Changelog ==

= 1.0 =
Initial version.