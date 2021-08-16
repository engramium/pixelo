<?php 
function pixelo_theme_get_customizer_css() {
	$pixelo_custom_background_color 		= get_theme_mod( 'custom_background_color', '' );
	$pixelo_wrapper_background_color 	= get_theme_mod( 'wrapper_background_color', '' );

	$pixelo_text_color 				= get_theme_mod( 'text_color', '' );
	$pixelo_link_color 				= get_theme_mod( 'link_color', '' );
	$pixelo_link_hover_color 	= get_theme_mod( 'link_hover_color', '' );
	$pixelo_heading_color 			= get_theme_mod( 'heading_color', '' );

	$page_sidebar = get_theme_mod( 'pixelo_single_post_sidebar', true );

?>
<style>
	<?php 
	if ( !empty( $pixelo_custom_background_color ) ) : ?>
	body { background-color: <?php echo esc_attr( $pixelo_custom_background_color ); ?>; }
	<?php
	endif;

	if ( !empty( $pixelo_wrapper_background_color ) ) : ?>
	.wrapper { background-color: <?php echo esc_attr( $pixelo_wrapper_background_color ); ?>;}
	<?php 
	endif; 

	if( !empty( $pixelo_heading_color ) ) : ?>
		h1.heading { 
			color: <?php echo esc_attr( $pixelo_heading_color ); ?>;
		}
	<?php 
	endif;

	if( !empty( $pixelo_text_color ) ) : ?>
		.site-content p, .content-area p { 
			color: <?php echo esc_attr( $pixelo_text_color ); ?>;
		}
	<?php 
	endif;

	if( !empty( $pixelo_link_color ) ) : ?>
		.site-content a, .content-area a, .blog_wrap-item a{ 
			color: <?php echo esc_attr( $pixelo_link_color ); ?> !important;
		}
	<?php 
	endif;

	if( !empty( $pixelo_link_hover_color ) ) : ?>
		.site-content a:hover, .content-area a:hover, .blog_wrap-item a:hover{ 
			color: <?php echo esc_attr( $pixelo_link_hover_color ); ?> !important;
		}
	<?php endif; ?>

	<?php 

	if( 'no-sidebar' !== $page_sidebar ) : ?>
		.pixelo-single-post-no-sidebar { 
			padding-left: 0px;
		}
	<?php endif; ?>
	

	

</style>

<?php
}
add_action( 'wp_head', 'pixelo_theme_get_customizer_css' );
?>