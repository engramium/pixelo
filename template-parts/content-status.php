<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pixelo
 * @since 1.0
 */

	 $post_content = get_theme_mod( 'pixelo_blog_post_content_option', true );
?>

<?php if ( get_the_content() ) : ?>
	<div class="post-excerpt">
		<?php 
			if( $post_content == 'excerpt' ) {
				the_excerpt( 100 ); 
					?>
							<a class="read-btn" href="<?php echo esc_url( the_permalink() )?>"><?php echo __( "Continue Reading", "pixelo" ); ?> <img src="<?php echo esc_url( get_theme_file_uri( '/images/arrow-icon.png' ) )  ?>" alt="Icon"></a>
					<?php
			}else {
					the_content();
					
			} 
		?>
	</div><!-- .post-excerpt -->
<?php endif; ?>

<?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'pixelo' ) . '</span>'; ?>
