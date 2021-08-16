<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pixelo
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
wp_body_open(); 

// Getting Layout Options
$getLayoutOpt = get_theme_mod('pixelo_layout_options');
$pixelo_content_loyout = get_post_meta( get_the_ID(), '_pixelo_content_meta_kay', true );

?>
<div class="pixelo__header-section">
    <div class="wrapper <?php echo !empty($getLayoutOpt ) ? esc_attr($getLayoutOpt ) : ''; ?>  <?php echo !empty($pixelo_content_loyout ) ? esc_attr($pixelo_content_loyout ) : ''; ?>"> 
        <header id="site-header" class="header-footer-group" role="banner">
        
            <div class="header-inner section-inner">
                <div class="header-titles-wrapper">
            
                    <button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                        <span class="toggle-inner">
                            <span class="toggle-icon">
                                <img src="<?php echo esc_url( get_theme_file_uri( '/images/search-icon.png' ) ); ?>" alt="Icon">
                            </span>
                            
                        </span>
                    </button><!-- .search-toggle -->

                    <div class="header-titles">

                    <?php 
                        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                            the_custom_logo();
                        } else { /*Link to homepage */  ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php echo bloginfo('name'); ?></a>
                        <h4><?php echo wp_kses_post( get_bloginfo( 'description' ) );  ?></h4>
                        <?php } ?> 

                    </div><!-- .header-titles -->
                    
                    <button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
                        <span class="toggle-inner">
                            <span class="toggle-icon">
                                <img src="<?php echo esc_url( get_theme_file_uri( '/images/toggle-menu.png' ) ); ?>" alt="Icon">
                            </span>
                        </span>
                    </button><!-- .nav-toggle -->
                </div>
                    
                <div class="header-navigation-wrapper">
                
                    <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'pixelo' ); ?>" role="navigation">
                    

                        <ul class="primary-menu reset-list-style">

                            <?php
                                if ( has_nav_menu( 'primary' ) ) {

                                    wp_nav_menu(
                                        array(
                                            'container'  => '',
                                            'items_wrap' => '%3$s',
                                            'theme_location' => 'primary',
                                        )
                                    );

                                }
                            ?>

                        </ul>
                    </nav>
                </div>
                
                <div class="toggle-wrapper search-toggle-wrapper">

                    <button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                        <span class="toggle-inner">
                            
                            <img src="<?php echo esc_url( get_theme_file_uri( '/images/search-icon.png' ) )  ?>" alt="">
                            
                        </span>
                    </button><!-- .search-toggle -->

                </div>

            </div> 

            <?php 

                get_template_part( 'inc/modal-search' ); 

            ?>

        </header>
        
        <?php 
            get_template_part( 'inc/modal-menu' );

        ?>
    </div>
</div>

<div id="site-content" class="wrapper site-content <?php echo !empty($getLayoutOpt) ? esc_attr($getLayoutOpt) : ''; ?> <?php echo !empty($pixelo_content_loyout ) ? esc_attr($pixelo_content_loyout ) : ''; ?>"> 

   
