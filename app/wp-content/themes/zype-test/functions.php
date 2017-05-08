<?php
/**
 * Zype Test functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Zype_Test
 */

if ( ! function_exists( 'zype_test_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zype_test_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Zype Test, use a find and replace
	 * to change 'zype-test' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'zype-test', get_template_directory() . '/languages' );

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
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'zype-test' ),
	) );

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
	add_theme_support( 'custom-background', apply_filters( 'zype_test_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'zype_test_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zype_test_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zype_test_content_width', 640 );
}
add_action( 'after_setup_theme', 'zype_test_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zype_test_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'zype-test' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'zype-test' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'zype_test_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zype_test_scripts() {
        wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7' );
    
	wp_enqueue_style( 'zype-test-style', get_stylesheet_uri(), array('bootstrap') );

	wp_enqueue_script( 'zype-test-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'zype-test-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zype_test_scripts' );

// Creates Customer Custom Post Type
add_action( 'init', 'zype_customer_init' );
function zype_customer_init() {
    $args = array(
        'label' => __('Customers'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'customers'),
        'query_var' => true,
        'menu_icon' => 'dashicons-businessman',    
    );
    $supports = array(
        'title', // post title
        'editor', // post content
        'thumbnail', // featured images
    );
    $labels = array(
        'name' => _x('Customers', 'plural'),
        'singular_name' => _x('Customer', 'singular'),
        'menu_name' => _x('Customers', 'admin menu'),
        'name_admin_bar' => _x('Customers', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New Customer'),
        'new_item' => __('New Customer'),
        'edit_item' => __('Edit Customer'),
        'view_item' => __('View Customer'),
        'all_items' => __('All Customers'),
        'search_items' => __('Search Customers'),
        'not_found' => __('No Customers found.'),
    );
    $args = array(
        'supports'  => $supports,
        'labels'    => $labels,
        'public'    => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'customer'),
        'has_archive' => true,
    );
    
    register_post_type( 'customers', $args ); 
    
    $labels = array(
        'name'              => _x( 'Sagments', 'taxonomy general name' ),
        'singular_name'     => _x( 'Sagment', 'taxonomy singular name' ),
        'search_items'      =>  __( 'Search Sagments' ),
        'all_items'         => __( 'All Sagments' ),
        'parent_item'       => __( 'Parent Sagment' ),
        'parent_item_colon' => __( 'Parent Sagment:' ),
        'edit_item'         => __( 'Edit Sagment' ), 
        'update_item'       => __( 'Update Sagment' ),
        'add_new_item'      => __( 'Add New Sagment' ),
        'new_item_name'     => __( 'New Sagment Name' ),
        'menu_name'         => __( 'Sagments' ),
    ); 	
 
    register_taxonomy('sagments', 'customers', array(
        'hierarchical'        => true,
        'labels'              => $labels,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'query_var'           => true
    ));
}

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
