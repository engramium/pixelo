<!DOCTYPE html>
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
?>

<div class="wrapper <?php echo !empty($getLayoutOpt) ? esc_attr($getLayoutOpt) : ''; ?>"> 

    <header>
        <div class="row">
            <div class="col-6 col-s-6 logo-flex">
                <?php 
                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                    the_custom_logo();
                } else { /*Link to homepage */  ?>
                <h1><a href="/" title="<?php bloginfo('name'); ?>"><?php echo bloginfo('name'); ?></a></h1>
                <?php } ?> 
            </div>
            <div class="col-6 col-s-6 menu-flex">
                <button class="mobile-menu">
                    <span class="open__burger">
                        <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/menu.svg" alt="Menu"/>
                        <?php _e( 'Menu', 'pixelo' ) ?>
                    </span>
                    <span class="close__burger">
                        <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/menu_close.svg" alt="Close"/>
                        <?php _e( 'Close', 'pixelo' ) ?>
                    </span>
                </button>
            </div>
        </div> 
        <nav id="toggleMyMenu" style="display: none;">
            <?php
            wp_nav_menu( array (
                'theme_location' => 'primary', 
                'container_class' => 'custom-menu-class',
                )
            );
            ?>
        </nav>
    </header>
    
