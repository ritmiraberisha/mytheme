<?php

/*

	 Include scripts
	
*/

function awesome_script_enqueue()
{
  wp_enqueue_style(
    "bootstrap",
    get_template_directory_uri() . "/css/bootstrap.min.css",
    [],
    "3.4.1",
    "all"
  );
  wp_enqueue_script(
    "bootstrapjs",
    get_template_directory_uri() . "/js/bootstrap.min.js",
    [],
    "3.4.1",
    true
  );
  wp_enqueue_script("jquery");
  wp_enqueue_style(
    "customstyle",
    get_template_directory_uri() . "/css/blog.css",
    [],
    "1.0.0",
    "all"
  );
  wp_enqueue_script(
    "customjs",
    get_template_directory_uri() . "/js/blog.js",
    [],
    "1.0.0",
    true
  );
}

add_action("wp_enqueue_scripts", "awesome_script_enqueue");

/*

	 Activate menus
	
*/

function realestate_theme_setup()
{
  add_theme_support("menus");

  register_nav_menu("primary", "Primary Header Navigation");
  register_nav_menu("secondary", "Footer Navigation");
}

add_action("init", "realestate_theme_setup");

/*
	
	 Theme support function
	
*/

add_theme_support("custom-background");
add_theme_support("custom-header");
add_theme_support("post-thumbnails");
add_theme_support("post-formats", ["aside", "image", "video"]);
add_theme_support("html5", ["search-form"]);

/*
	
	 Sidebar function
	
*/

function blog_widget_setup()
{
  register_sidebar([
    "name" => "Sidebar",
    "id" => "sidebar-1",
    "class" => "custom",
    "description" => "Standard Sidebar",
    "before_widget" => '<aside id="%1$s" class="widget %2$s">',
    "after_widget" => "</aside>",
    "before_title" => '<h1 class="widget-title">',
    "after_title" => "</h1>",
  ]);
}
add_action("widgets_init", "blog_widget_setup");

/*
	
	 Include Walker file

*/
require get_template_directory() . "/inc/walker.php";

/*
	
	 Head function
	
*/
function blog_remove_version()
{
  return "";
}
add_filter("the_generator", "blog_remove_version");

/*
	
	 Custom Post Type
	
*/
function blog_custom_post_type()
{
  $labels = [
    "name" => "Agents",
    "singular_name" => "Agents",
    "add_new" => "Add Item",
    "all_items" => "All Items",
    "add_new_item" => "Add Item",
    "edit_item" => "Edit Item",
    "new_item" => "New Item",
    "view_item" => "View Item",
    "search_item" => "Search Agents",
    "not_found" => "No items found",
    "not_found_in_trash" => "No items found in trash",
    "parent_item_colon" => "Parent Item",
  ];
  $args = [
    "labels" => $labels,
    "public" => true,
    "has_archive" => true,
    "publicly_queryable" => true,
    "query_var" => true,
    "rewrite" => true,
    "capability_type" => "post",
    "hierarchical" => false,
    "supports" => ["title", "editor", "excerpt", "thumbnail", "revisions"],
    // "taxonomies" => ["category", "post_tag"],
    "menu_position" => 5,
    "exclude_from_search" => false,
  ];
  register_post_type("agents", $args);
}
add_action("init", "blog_custom_post_type");

function blog_custom_taxonomies()
{
  //add new taxonomy hierarchical
  $labels = [
    "name" => "Fields",
    "singular_name" => "Field",
    "search_items" => "Search Fields",
    "all_items" => "All Fields",
    "parent_item" => "Parent Field",
    "parent_item_colon" => "Parent Field:",
    "edit_item" => "Edit Field",
    "update_item" => "Update Field",
    "add_new_item" => "Add New Work Field",
    "new_item_name" => "New Field Name",
    "menu_name" => "Fields",
  ];

  $args = [
    "hierarchical" => true,
    "labels" => $labels,
    "show_ui" => true,
    "show_admin_column" => true,
    "query_var" => true,
    "rewrite" => ["slug" => "field"],
  ];

  register_taxonomy("field", ["agents"], $args);

  //add new taxonomy NOT hierarchical

  register_taxonomy("software", "agents", [
    "label" => "Software",
    "rewrite" => ["slug" => "software"],
    "hierarchical" => false,
  ]);
}

add_action("init", "blog_custom_taxonomies");

/*
	
	Custom Term Function

*/

function blog_get_terms($postID, $term)
{
  $terms_list = wp_get_post_terms($postID, $term);
  $output = "";

  $i = 0;
  foreach ($terms_list as $term) {
    $i++;
    if ($i > 1) {
      $output .= ", ";
    }
    $output .= '<a href="' . get_term_link($term) . '">' . $term->name . "</a>";
  }

  return $output;
}
