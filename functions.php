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
// require get_template_directory() . "/inc/walker.php";

/*
	
	 Head function
	
*/
function blog_remove_version()
{
  return "";
}
add_filter("the_generator", "blog_remove_version");
