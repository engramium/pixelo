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
	 $post_content = get_theme_mod( 'pixelo_blog_post_content_option', true );
?>

<?php if( !empty( $feature_image ) ) { ?>
<?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'pixelo' ) . '</span>'; ?>

<?php if ( has_post_thumbnail() ) : ?>

	<div class="featured-media">
	
		<?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'pixelo' ) . '</span>'; ?>

		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php the_post_thumbnail(); ?>
		</a>
		
	</div><!-- .featured-media -->
		
<?php endif; ?>
<?php } ?>

<div class="post-excerpt">

	<?php 

	$image_caption = '';

	if ( has_post_thumbnail() ) {
		$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
	}
	
	if ( $image_caption ) {
		echo '<p class="image-caption">' . $image_caption . '</p>';
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