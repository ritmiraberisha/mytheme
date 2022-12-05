<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Blog Theme</title>
    <?php wp_head(); ?>
  </head>

  <?php if (is_front_page()):
    $blog_classes = ["blog-class", "my-class"];
  else:
    $blog_classes = ["no-blog-class"];
  endif; ?>
	
	<body <?php body_class($blog_classes); ?>>
		
		<div class="container">
		
			<div class="row">
				
				<div class="col-xs-12">
					
					<nav class="navbar navbar-default navbar-fixed-top">
					  <div class="container">
					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					      <a class="navbar-brand" href="#">Blog Theme</a>
					    </div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<?php wp_nav_menu([
         "theme_location" => "primary",
         "container" => false,
         "menu_class" => "nav navbar-nav navbar-right",
         //  "walker" => new Walker_Nav_Primary(),
       ]); ?>
						</div>
					  </div><!-- /.container-fluid -->
					</nav>
				
				</div>
				
				<div class="col-xs-12">
					<div class="search-form-container">
						<div class="container">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>
				
			</div>
			
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()
  ->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
