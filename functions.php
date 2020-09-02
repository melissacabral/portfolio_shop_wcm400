<?php
//max width of auto-embeds (youtube, insta, twitter, etc)
if ( ! isset( $content_width ) ) $content_width = 500;

//activate sleeping features
add_theme_support( 'custom-background' );

//add SEO-friendly titles
//developer note: remove the <title> tag from header.php
add_theme_support( 'title-tag' );

//upgrade to HTML5
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 
					'script' ) );

//add "featured image" to each post & page
add_theme_support( 'post-thumbnails' );

//custom image header
//dev note: display header_image() somewhere in header.php
$args = array(
	'width' 		=> 1300,
	'height' 		=> 800,
	'flex-width' 	=> true,
	'flex-height' 	=> true,
	'header-text' => array( 'site-title', 'site-description' ),
);
add_theme_support( 'custom-header', $args );


//custom logo uploader
$args = array(
	'width' 		=> 300,
	'height'		=> 300,
	'flex-width' 	=> true,
	'flex-height' 	=> false,
);
add_theme_support( 'custom-logo', $args );

//improve RSS feed links - useful for blogs and news outlets
add_theme_support( 'automatic-feed-links' );

//post formats let you style different kinds of posts (see Post Formats in the codex)
add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'link' ) );

//custom image size
//				name, 	width, height, crop?
add_image_size( 'banner', 1300, 300, true );


//simple hook example - change the length of the default excerpt using a built-in filter
function mmc_excerpt_length(){
	return 20; //words
}
add_filter( 'excerpt_length', 'mmc_excerpt_length' );


//replace the [...] on excerpts
function mmc_readmore(){
	//permalink is the URL of single post
	return '&hellip; <a href="' . get_permalink() . '" class="readmore button">Read More</a>';
}
add_filter( 'excerpt_more', 'mmc_readmore' );


//example action hook
function mmc_footer_text(){
	echo 'Hello this is the footer action hook';
}
//add_action( 'wp_footer', 'mmc_footer_text' );

//example using simply show hooks
function mmc_breadcrumb(){
	echo 'these are breadcrumbs...mmm...';
}
// add_action( 'loop_start', 'mmc_breadcrumb' );


//better comment form UX
function mmc_commentreply(){
	if(comments_open() && is_singular()){
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mmc_commentreply' );

//Activate all menu areas for the site
add_action( 'init', 'mmc_menu_areas' );
function mmc_menu_areas(){
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
		'social_icons' => 'Social Media Icons',
	) );
}


//Register any Widget Areas we will need
add_action('widgets_init', 'mmc_widget_areas');
function mmc_widget_areas(){
	register_sidebar( array(
		'name'			=> 'Blog Sidebar',
		'id'			=> 'blog_sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Footer Area',
		'id'			=> 'footer_area',
		'description'	=> 'Appears at the bottom of every screen',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Home Page Area',
		'id'			=> 'home-area',
		'description'	=> 'An area to feature 3 highlights on the front page',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Shop Sidebar',
		'id'			=> 'shop-sidebar',
		'description'	=> 'Appears next to the shop products page',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
}


//Count all real comments on a post
add_filter( 'get_comments_number', 'sc_comments_count' );
function sc_comments_count(){
	//post id
	global $id;
	$comments = get_approved_comments( $id );
	$count = 0;
	
	//go through the comments array, counting each real comment
	foreach( $comments AS $comment ){
		if( $comment->comment_type == 'comment' ){
			$count ++;
		}
	}
	return $count;
}

//Count all the trackbacks and pingbacks on a post

function sc_pings_count(){
	//post id
	global $id;
	$comments = get_approved_comments( $id );
	$count = 0;

	//go through the comments array, counting each real comment
	foreach( $comments AS $comment ){
		if( $comment->comment_type != 'comment' ){
			$count ++;
		}
	}

	return $count;
}


//WOOCommerce support
add_action( 'after_setup_theme', 'mmc_woo' );
function mmc_woo(){
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

//Replace the <main> content wrapper with our own
//https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<main class="content">';
}

function my_theme_wrapper_end() {
  echo '</main>';
}

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

//remove  woocommerce stylesheets
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	//unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}


//example of modifying woocommerce page with hooks
//
add_action('woocommerce_before_checkout_form', 'mmc_example', 5);

function mmc_example(){
	echo 'Something here!';
}

//example of using hooks to customize instead of a template
add_action('after_setup_theme', 'mmc_unhook');
function mmc_unhook(){
	 remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}

//no close php
