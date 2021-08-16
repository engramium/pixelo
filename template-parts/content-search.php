<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pixelo
 */

?>

<div class="blog_wrap-item"  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>   

    <div class="entry-summary">
		<?php the_excerpt(); ?>
        <a class="read-btn" href="<?php echo esc_url( the_permalink() )?>">
            <?php echo __( "Continue Reading", "pixelo" ); ?> <img src="<?php echo esc_url( get_theme_file_uri( '/images/arrow-icon.png' ) )  ?>" alt="Icon">
        </a>
	</div><!-- .entry-summary -->

</div>






