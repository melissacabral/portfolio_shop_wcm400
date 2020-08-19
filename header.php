<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
</head>
<body <?php body_class(); ?>>
	<div class="site">
		<header class="header" style="background-image: url(<?php header_image(); ?>); color:#<?php header_textcolor(); ?>">
			<div class="branding">
				<?php the_custom_logo(); ?>
				
				<?php if( display_header_text()){ ?>
				<h1 class="site-title">
					<a href="<?php echo home_url(); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2><?php bloginfo( 'description' ); ?></h2>
				<?php } ?>

			</div>
			<div class="navigation">
				<nav class="main-menu">
					<ul>
						<?php 
						wp_list_pages( array(
							'title_li' => '',
						) ); 
						?>
					</ul>
				</nav>
			</div>
			<div class="utilities">
				<!-- Utility menu will go here -->
			</div>
			<?php get_search_form(); ?>

			
		</header>