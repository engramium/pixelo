<?php  
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pixelo
 * @since 1.0
 */

$feature_image = get_theme_mod( 'pixelo_single_blog_post_feature_image', true );
$title_meta = get_theme_mod( 'pixelo_single_blog_post_title_tag', true );
$tag = get_theme_mod( 'pixelo_single_blog_post_tag', true );
$related_post = get_theme_mod( 'pixelo_single_blog_post_related', true );
      
?>
<div id="primary" class="content-area primary">

    <main class="single__blog-post-wrap">

        <div class="single-page post__content-item">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php if( !empty( $feature_image ) ) { ?> 

                    <?php if ( has_post_thumbnail() ) : ?>

                        <div class="featured-media">

                            <a href="<?php the_permalink(); ?>" rel="bookmark">

                                <?php the_post_thumbnail(); ?>

                            </a>

                        </div><!-- .featured-media -->
                        
                    <?php endif; ?>

                <?php } ?>

                <?php if( !empty( $title_meta ) ) { ?> 

                    <h1 class="heading"><?php the_title(); ?></h1>
                    
                    <?php pixelo_single_post_meta(); ?>

                <?php } ?>

                <?php the_content();?>

                <?php 

                    if(has_tag()) {  ?>

                    <?php if( !empty( $tag ) ) { ?>

                        <div class="post-tags"><?php the_tags(); ?> </div>

                    <?php } ?>

                    <?php
                    
                    } else { /* Article untagged */ } ?>
                    <?php
                        $defaults = array(
                            'before'           => '<p>' . __( 'Pages:', 'pixelo' ),
                            'after'            => '</p>',
                            'link_before'      => '',
                            'link_after'       => '',
                            'next_or_number'   => 'number',
                            'separator'        => ' ',
                            'nextpagelink'     => __( 'Next page', 'pixelo'),
                            'previouspagelink' => __( 'Previous page', 'pixelo' ),
                            'pagelink'         => '%',
                            'echo'             => 1
                        );
                        wp_link_pages( $defaults );
                    ?>

                    <?php 

                        get_template_part('inc/post-navigation'); 

                        if( ( $related_post == 'show' ) ) {

                            get_template_part('inc/related-post'); 

                        }
                        
                    ?>

                <?php comments_template() ?>
            <?php endwhile; // end of the loop. ?>
        </div>
    </main>
</div>
