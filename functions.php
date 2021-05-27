<?php

/* Adding CSS & JS */
function pixelo_basic_enqueue_styles_scripts() {
    wp_register_style( 'styles', get_template_directory_uri() . '/css/styles.css', false, '1.0.2' );
    $dependencies = array( 'styles' );
    wp_enqueue_style( 'styles', get_stylesheet_uri(), $dependencies); 
    add_theme_support( 'post-thumbnails' );
    wp_register_script( 'gsap-tweenmax', get_theme_file_uri('js/TweenMax.min.js'), false, '2.1.3' );
    wp_enqueue_script( 'gsap-tweenmax' );
    wp_enqueue_script( 'my-custom-script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'pixelo_basic_enqueue_styles_scripts' );


// Adding Title-Tag
function pixelo_basic_wp_setup() {
    add_theme_support ( 'title-tag' );
    

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

// Creating Custom Menu
function pixelo_custom_new_menu() {
    register_nav_menu( 'primary', __( 'Primary Menu', 'pixelo' ) );
}
add_action( 'init', 'pixelo_custom_new_menu' );

// Post Thumbnails
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );


// Support for custom Logo
add_theme_support( 'custom-logo' );
function pixelo_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'pixelo_custom_logo_setup' );
 
// Customizer Settings
require get_stylesheet_directory() . '/inc/pixelo-customizer.php';
new Pixelo_Customizer();

if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

add_theme_support( 'post-thumbnails', array( 'post' ) ); // Posts only

// Comment Reply Fix
function pixelo_load_script_for_fake_threading() {
  if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'pixelo_load_script_for_fake_threading' );

require_once get_theme_file_path( '/inc/custom-styles.php' );