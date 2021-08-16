<?php
/**
 * pixelo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pixelo
 */

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

/* Adding CSS & JS */
function pixelo_enqueue_styles_scripts() {
    wp_register_style( 'pixelo-styles', get_template_directory_uri() . '/css/styles.css', false, '1.0.2' );
    wp_enqueue_style( 'pixelo-work-font', 'https://fonts.googleapis.com/css?family=Work+Sans:700&display=swap', false, '1.0.2' );
    wp_enqueue_style( 'pixelo-open-sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans&display=swap', false, '1.0.2' );
    $dependencies = array( 'pixelo-styles' );
    wp_enqueue_style( 'pixelo-style', get_stylesheet_uri(), $dependencies); 
    wp_style_add_data( 'pixelo-style', 'rtl', 'replace' );
    wp_enqueue_script( 'pixelo-accessibility-js', get_template_directory_uri() . '/js/accessibility.js', array(), false );
    wp_enqueue_script( 'pixelo-custom-script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'pixelo_enqueue_styles_scripts' );

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function pixelo_metabox_style() {
    wp_register_style( 'pixelo-metabox-settings-css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'pixelo-metabox-settings-css' );
}
add_action( 'admin_enqueue_scripts', 'pixelo_metabox_style' );

/**
 * Enqueue customizer stylesheet.
 */
function pixelo_enqueue_customizer_stylesheet() {

    wp_register_style( 'pixelo-customizer-css', get_template_directory_uri() . '/css/pixelo-customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'pixelo-customizer-css' );

    wp_enqueue_script( 'pixelo-customizer-js', get_template_directory_uri() . '/js/pixelo-customizer.js', NULL, NULL, 'all' );

}
add_action( 'customize_controls_print_styles', 'pixelo_enqueue_customizer_stylesheet' );


/**
 * Setup theme register support.
 */
function pixelo_basic_wp_setup() {

    // Title tag
    add_theme_support ( 'title-tag' );

    // Post Thumbnails
    add_theme_support( 'post-thumbnails' );

    // Feed links
    add_theme_support( 'automatic-feed-links' );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
    // Post formats
    add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

        // Define and register starter content to showcase the theme on new sites.
        $starter_content = array(

            // Specify the core-defined pages to create and add custom thumbnails to some of them.
            'posts' => array(
                'home',
                'about',
                'contact',
                'blog',
            ),

            // Default to a static front page and assign the front and posts pages.
            'options' => array(
                'show_on_front'     => 'page',
                'page_on_front'     => '{{home}}',
                'page_for_posts'    => '{{blog}}',
            ),

            // Set up nav menus for each of the two areas registered in the theme.
            'nav_menus' => array(
                // Assign a menu to the "primary" location.
                'primary' => array(
                    'name' => __( 'Primary Menu', 'pixelo' ),
                    'items' => array(
                        'link_home',
                        'page_about',
                        'page_contact',
                        'page_blog',
                    ),
                ),
            ),
        );

        add_theme_support( 'starter-content', $starter_content );
    }
    
add_action ( 'after_setup_theme', 'pixelo_basic_wp_setup' );

/**
 * Register primary menu.
 */
function pixelo_custom_new_menu() {
    register_nav_menu( 'primary', __( 'Primary Menu', 'pixelo' ) );
}
add_action( 'init', 'pixelo_custom_new_menu' );

 
// Customizer Settings
require get_stylesheet_directory() . '/inc/pixelo-customizer.php';
new Pixelo_Customizer();

if ( ! isset( $content_width ) ) {
    $content_width = 600;
}


// Comment Reply Fix
function pixelo_load_script_for_fake_threading() {
  if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'pixelo_load_script_for_fake_threading' );

require_once get_theme_file_path( '/inc/custom-styles.php' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * REQUIRED FILES
 * Include required files metabox.
 */
require get_template_directory() . '/inc/pixelo-metabox.php';

/**
 * Theme functions
 */
require get_template_directory() . '/inc/pixelo-theme-functions.php';


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pixelo_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Sidebar', 'pixelo' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'WooCommerce', 'pixelo' ),
        'id'            => 'pixelo_wc_sidebar',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Single Prodcut', 'pixelo' ),
        'id'            => 'single_product_sidebar',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 1', 'pixelo' ),
        'id'            => 'footer-1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer 2', 'pixelo' ),
        'id'            => 'footer-2',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer 3', 'pixelo' ),
        'id'            => 'footer-3',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'pixelo_widgets_init' );


if ( ! function_exists( 'wp_body_open' ) ) {

    /**
     * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
     */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}


/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function pixelo_skip_link() {
    echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'pixelo' ) . '</a>';
}

add_action( 'wp_body_open', 'pixelo_skip_link', 5 );


/**
 * Register WooCommer support.
 */
function pixelo_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
    
add_action( 'after_setup_theme', 'pixelo_add_woocommerce_support' );
