<?php
/**
 * Base Layer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Yo_Base_Layer
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function yo_baselayersetup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Base Layer, use a find and replace
	 * to change 'baselayer' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'baselayer', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	// add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/* Enable support for Post Thumbnails on posts and pages. */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'baselayer' ),
			'footer'  => esc_html__( 'Footer', 'baselayer' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'yo_baselayercustom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// remove meta 'generator' tag
	remove_action( 'wp_head', 'wp_generator' );

	// make default action for inline images to link to 'none'
	update_option( 'image_default_link_type','none' );

	// responsive video support
	add_theme_support( 'responsive-embeds' );

	/*
	// Disable font size choices and custom font sizes
	add_theme_support( 'editor-font-sizes', array() );
	add_theme_support( 'disable-custom-font-sizes' );

	// Disable color palette and custom colors
	add_theme_support( 'editor-color-palette', array() );
	add_theme_support( 'disable-custom-colors' );

	// Disable gradients and custom gradients
	add_theme_support( 'editor-gradient-presets', array() );
	add_theme_support( 'disable-custom-gradients' );
	*/

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add custom editor font sizes.
	// These variables should be identical to their CSS equivalents in 
	// inc/sass/variables/_typography.scss
	$rem = 16;
	$type_scale = 1.33;
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html__( 'Small' ),
				'shortName' => esc_html_x( 'S', 'Font size' ),
				'size'      => $rem * 0.9,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Normal' ),
				'shortName' => esc_html_x( 'M', 'Font size' ),
				'size'      => $rem,
				'slug'      => 'normal',
			),
			array(
				'name'      => esc_html__( 'Large' ),
				'shortName' => esc_html_x( 'L', 'Font size' ),
				'size'      => $rem * $type_scale,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Extra large' ),
				'shortName' => esc_html_x( 'XL', 'Font size' ),
				'size'      => $rem * $type_scale * $type_scale,
				'slug'      => 'extra-large',
			),
			array(
				'name'      => esc_html__( 'XX Large' ),
				'shortName' => esc_html_x( 'XXL', 'Font size' ),
				'size'      => $rem * $type_scale * $type_scale * $type_scale,
				'slug'      => 'extra-extra-large',
			),
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'yo_baselayersetup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yo_baselayercontent_width() {
	// $GLOBALS['content_width'] = apply_filters( 'yo_baselayercontent_width', 640 );
}
// add_action( 'after_setup_theme', 'yo_baselayercontent_width', 0 );

/** Register widget area. */
function yo_baselayerwidgets_init() {
	/*
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'baselayer' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baselayer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	*/
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'baselayer' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'baselayer' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'baselayer' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'baselayer' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'baselayer' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'baselayer' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'yo_baselayerwidgets_init' );

/** Enqueue scripts and styles. */
function yo_baselayerscripts() {
	wp_enqueue_style( 'baselayer-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'baselayer-style', 'rtl', 'replace' );

	wp_enqueue_script( 'baselayer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'yo_baselayerscripts' );

/** Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/** Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/** Functions which enhance the theme by hooking into WordPress. */
require get_template_directory() . '/inc/template-functions.php';

/** Navigation traversal feature. */
// require get_template_directory() . '/inc/main-menu.php';
// require get_template_directory() . '/inc/main-menu-walker-class.php';
// require get_template_directory() . '/inc/subnav-walker-class.php';

/** Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/** Load Jetpack compatibility file. */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/** Load WooCommerce compatibility file. */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/** Remove fucking default admin dashboard widgets
 * (such as "Events and News")
 */
if ( ! function_exists( 'remove_dashboard_meta' ) ) {
	// if this exists in a child theme, ignore this one
	function remove_dashboard_meta() {
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		// remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		// remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		// remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		// remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		// remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
	}
	add_action( 'admin_init', 'remove_dashboard_meta' );
}
