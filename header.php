<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
	<?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
	
</head>
<body <?php body_class(); ?>>
 <?php wp_body_open(); ?>
 
	<div class="site">
		<header class="header" style="background-image: url(<?php header_image(); ?>); color:#<?php header_textcolor(); ?>">
			<div class="branding">
				<?php the_custom_logo(); ?>
				
				<?php if( display_header_text()){ ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2><?php bloginfo( 'description' ); ?></h2>
				<?php } ?>

			</div>
			<div class="navigation">
				<?php wp_nav_menu( array(
					'theme_location' 	=> 'main_menu',
					'container'			=> 'nav', //or div
					'container_class' 	=> 'main-menu',
				) ); ?>
			</div>
			<div class="utilities">
				<?php wp_nav_menu( array(
					'theme_location' 	=> 'social_icons',
					'fallback_cb' 		=> false,  //no fallback menu
					'container_class'	=> 'social-navigation',
				) ); ?>



				<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"> 
					<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?>
				</a>

			</div>
			<?php get_search_form(); ?>

			
		</header>