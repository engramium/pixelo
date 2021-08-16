<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pixelo
 */


get_header(); 

$pixelo_sidebar_layout = get_theme_mod('pixelo_sidebar_layout_options');

?>

  <div class="archive-page">

    <?php 

      if( $pixelo_sidebar_layout == 'left-sidebar' ) {

        get_sidebar();
          
      }

    ?>

    <div class="content-area <?php echo !empty($pixelo_sidebar_layout) ? esc_attr($pixelo_sidebar_layout) : ''; ?>">

      <?php
      if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

          <?php
            /* Include the Post-Format-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            */
            get_template_part( 'template-parts/content', 'archive' );
            
          ?>

        <?php endwhile; ?>

      <?php else : ?>

        <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

    </div><!-- #main -->
    
      <?php 

        if( $pixelo_sidebar_layout == 'right-sidebar' ) {

          get_sidebar();

        }

      ?>

  </div><!-- #primary -->

  <?php if ( function_exists( 'paginate_links') ) { ?>

    <nav class="pagination"><?php echo paginate_links(); ?> </nav> 

  <?php }  ?>

<?php get_footer(); ?>
