<?php
/*
Plugin Name: Carbon Breadcrumbs
Description: A basic plugin for breadcrumbs with advanced capabilities for extending.
Version: 1.0
*/

// include the plugin files
add_action('after_setup_theme', 'crb_include_carbon_breadcrumbs');
function crb_include_carbon_breadcrumbs() {
	$includes_dir = dirname(__FILE__) . '/includes/';

	include_once($includes_dir . 'Carbon_Breadcrumb_Trail.php');

	include_once($includes_dir . 'Carbon_Breadcrumb_DB_Object.php');	

	include_once($includes_dir . 'Carbon_Breadcrumb_Locator.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Locator_Post.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Locator_Term.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Locator_User.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Locator_Date.php');

	include_once($includes_dir . 'Carbon_Breadcrumb_Item.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Item_Post.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Item_Term.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Item_User.php');
	include_once($includes_dir . 'Carbon_Breadcrumb_Item_Custom.php');

	include_once($includes_dir . 'Carbon_Breadcrumb_Exception.php');
}