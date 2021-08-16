<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pixelo
 */

get_header();
?>

<div class="site-content-inner pixelo-container">
    
    <?php 
        /**
         * pixelo_single_post_content hook.
         *
         * @hooked pixelo_single_post_content (outputs single post content)
         */
        do_action( 'pixelo_single_post_content' ); 
    ?>

</div><!-- .site-content-inner -->

<?php get_footer(); ?>