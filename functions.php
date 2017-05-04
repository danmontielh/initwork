<?php
/**
 *  Initwork functions core :)
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Initwork
 * 
 * Framework Theme based Underscores http://underscores.me/
 *
 *
 */

if ( ! function_exists( 'initwork_setup' ) ) :
/* Declarate */
function initwork_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Initwork, use a find and replace
	 * to change 'initwork' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'initwork', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * For more formart post Thumbnails add her
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'initwork' ),
	) );


	// Enable support Navs Bootstrap

	require_once('bs4navwalker.php');

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'initwork_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'initwork_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function initwork_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'initwork_content_width', 640 );
}
add_action( 'after_setup_theme', 'initwork_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function initwork_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'initwork' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'initwork' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'initwork_widgets_init' );

/**
 * Enqueue scripts and styles. Bootstrap 4, Jquery, animated css, normalize ccs.
 */
function initwork_scripts() {
	/*  Boot */
	wp_enqueue_style( 'Bootstrap4', get_template_directory_uri() . '/dist/bootstrap/bootstrap.min.css');
	wp_enqueue_style( 'Bootstrap4grid', get_template_directory_uri() . '/dist/bootstrap/bootstrap-grid.min.css');

	wp_enqueue_style( 'Bootstrap4reboot', get_template_directory_uri() . '/dist/bootstrap/bootstrap-reboot.min.css');

	wp_enqueue_style( 'initwork-style', get_stylesheet_uri() );

	wp_enqueue_style( 'animatecss', get_template_directory_uri() . '/dist/animate/animate.css');

	wp_enqueue_script('jquery');

	wp_enqueue_script('tether_js', get_template_directory_uri() . '/js/bootstrap/tether.min.js', array('jquery'), '2.0', true);

	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap/bootstrap.min.js', array('jquery'), '4.0', true);


	wp_enqueue_script( 'initwork-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'initwork_scripts' );


/** 
* Enqueue script for Font Awesome 
*
* default looks commented.
*
*
*/



function enable_fontawesome(){

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/dist/fontawesome_4_7/css/font-awesome.min.css');

}

add_action('wp_enqueue_scripts', 'enable_fontawesome');





/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// default hide admin bar

add_filter('show_admin_bar','__return_false');
