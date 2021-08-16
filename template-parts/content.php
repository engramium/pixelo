<?php 
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pixelo
 * @since 1.0
 */

    $feature_image = get_theme_mod( 'pixelo_blog_post_feature_image', true );
    $title_meta = get_theme_mod( 'pixelo_blog_post_title_tag', true );
    $comment = get_theme_mod( 'pixelo_blog_post_comment', true );
    $author = get_theme_mod( 'pixelo_blog_post_author', true );
    $publish_date = get_theme_mod( 'pixelo_blog_post_publish_date', true );
    $post_content = get_theme_mod( 'pixelo_blog_post_content_option', true );

?>

<?php if( !empty( $title_meta ) ) { ?>
<div class="post-header">

	<?php if ( get_the_title() ) : ?>
		<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php endif; ?>
    
    <?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'pixelo' ) . '</span>'; ?>
    
</div><!-- .post-header -->
<?php } ?>

<?php if( !empty( $feature_image  ) ) { ?>
    <?php if ( has_post_thumbnail() ) : ?>

    <div class="featured-media">
        <a href="<?php the_permalink(); ?>" rel="bookmark">
            <?php the_post_thumbnail(); ?>
        </a>
    </div><!-- .featured-media -->

    <?php endif; ?>
<?php } ?>

<?php if ( get_the_content() ) : ?>
	<div class="post-excerpt">
		<?php 

            if( $post_content == 'excerpt' ) {
                the_excerpt( 60 ); 
                ?>
                    <a class="read-btn" href="<?php echo esc_url( the_permalink() )?>"><?php echo __( "Continue Reading", "pixelo" ); ?> <img src="<?php echo esc_url( get_theme_file_uri( '/images/arrow-icon.png' ) )  ?>" alt="Icon"></a>
                <?php
            }else {
                the_content();
                
            }
            
        ?>

	</div><!-- .post-excerpt -->
<?php endif; ?>

<?php if( !empty( $title_meta ) ) { ?>
<div class="post-meta">
    <?php if( !empty( $publish_date ) ) { ?> 
    <span class="post-date"><?php echo get_the_date( 'M j, Y' ); ?></span>
    <?php } ?>
    
    <?php if( !empty( $comment ) ) { ?> 
    <?php

        if ( comments_open() ) {
            comments_popup_link( '0', '1', '%', 'post-comments' );
        }
    ?>
    <?php } ?>

    <?php if( !empty( $author ) ) { ?> 
    <p class="author_icon">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <?php 
                global $current_user; wp_get_current_user();
                echo get_the_author(); 
            
            ?>
        </a>
    </p>
    <?php } ?>
    
    <div class="clear"></div>
    
</div><!-- .post-meta -->
<?php } ?>
