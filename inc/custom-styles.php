<?php 
function pixelo_theme_get_customizer_css() {
	$text_color = get_theme_mod( 'text_color', '' );
	$link_color = get_theme_mod( 'link_color', '' );
	$accent_color = get_theme_mod( 'accent_color', '' );
	$custom_background_color = get_theme_mod( 'custom_background_color', '' );
	$wrapper_background_color = get_theme_mod( 'wrapper_background_color', '' );
?>
<style>
	<?php if ( !empty( $text_color ) ) : ?>
		body { color: <?php echo $text_color; ?>;}
	<?php
	endif;
	if ( !empty( $link_color ) ) : ?>
		a {
			color: <?php echo $link_color; ?>;
			border-bottom-color: <?php echo $link_color; ?>;
		}
	<?php
	endif;
	if ( !empty( $accent_color ) ) : ?>
	a:hover {
		color: <?php echo $accent_color; ?>;
		border-bottom-color: <?php echo $accent_color; ?>;
	}

	button,
	input[type="submit"] { background-color: <?php echo $accent_color; ?>;}
	<?php
	endif;
	if ( !empty( $custom_background_color ) ) : ?>
	body { background-color: <?php echo $custom_background_color; ?>; }
	<?php
	endif;

	if ( !empty( $wrapper_background_color ) ) : ?>
	.wrapper { background-color: <?php echo $wrapper_background_color; ?>;}
	<?php endif; ?>
</style>

<?php
}
add_action( 'wp_head', 'pixelo_theme_get_customizer_css' );
?>