<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pixelo
 * @since 1.0
 */

	 $title_meta = get_theme_mod( 'pixelo_blog_post_title_tag', true );
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

<div class="post-quote">

	<?php
		
	// Fetch post content
	$content = get_post_field( 'post_content', get_the_ID() );
	
	// Get content parts
	$content_parts = get_extended( $content );
	
	// Output part before <!--more--> tag
	echo $content_parts['main'];
	
	?>

</div><!-- .post-quote -->

<div class="post-excerpt">
		
	<?php 
		if ( strpos( $post->post_content, '<!--more-->' ) ) {
			echo '<p>' . mb_strimwidth( $content_parts['extended'], 0, 200, '...' ) . '</p>';
		} else {
			if( $post_content == 'excerpt' ) {
				the_excerpt( 100 ); 
					?>
							<a class="read-btn" href="<?php echo esc_url( the_permalink() )?>"><?php echo __( "Continue Reading", "pixelo" ); ?> <img src="<?php echo esc_url( get_theme_file_uri( '/images/arrow-icon.png' ) )  ?>" alt="Icon"></a>
					<?php
			}else {
					the_content();
					
			}  
		}
	?>

</div><!-- .post-excerpt -->