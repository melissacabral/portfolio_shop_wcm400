<?php
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
add_action( 'wp_footer', 'mmc_footer_text' );

//example using simply show hooks
function mmc_breadcrumb(){
	echo 'these are breadcrumbs...mmm...';
}
add_action( 'loop_start', 'mmc_breadcrumb' );




//better comment form UX
function mmc_commentreply(){
	wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'mmc_commentreply' );
//no close php