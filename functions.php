<?php
/**
 * sfu_theme functions and definitions
 *
 * @package sfu_theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'sfu_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sfu_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sfu_theme, use a find and replace
	 * to change 'sfu_theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sfu_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sfu_theme' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sfu_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // sfu_theme_setup
add_action( 'after_setup_theme', 'sfu_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function sfu_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sfu_theme' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'sfu_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sfu_theme_scripts() {
	/* stylesheets */
	wp_enqueue_style( 'default-style', get_template_directory_uri() . '/css/default.css' );
	
	wp_enqueue_style( 'sfu_theme-style', get_stylesheet_uri() );
	
	//wp_enqueue_style( 'foundicons', get_template_directory_uri() . '/fonts/foundation-icons.css' );
	
	//wp_enqueue_style( 'foundiconsie', get_template_directory_uri() . '/css/general_foundicons_ie7.css' );

    /* scripts */
	wp_enqueue_script( 'jquery');
	
	wp_enqueue_script( 'foundation-script', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), false, true);
	
	wp_enqueue_script( 'foundation-topbar-script', get_template_directory_uri() . '/js/foundation/foundation.topbar.js', array('jquery', 'foundation-script'), false, true);
	
	wp_enqueue_script( 'sfu_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'sfu_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sfu_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Load custom Foundation menu walker.
 */
require_once get_template_directory() . '/inc/foundation-walker.php';
