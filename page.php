<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pixelo
 */

get_header();
?>

<div class="site-content-inner pixelo-container">

    <?php 
        /**
         * pixelo_left_sidebar hook.
         *
         * @hooked pixelo_left_sidebar (outputs page left sidebar)
         */
        do_action( 'pixelo_left_sidebar' ); 
  
        /**
         * pixelo_page_content hook.
         *
         * @hooked pixelo_page_content (outputs page content)
         */
        do_action( 'pixelo_page_content' ); 
 
        /**
         * pixelo_right_sidebar hook.
         *
         * @hooked pixelo_right_sidebar (outputs page right sidebar)
         */
        do_action( 'pixelo_right_sidebar' ); 
        
    ?>
    
</div><!-- .site-content-inner -->

<?php get_footer(); ?>


