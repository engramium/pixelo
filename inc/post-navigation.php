<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package pixelo
 * @since 1.0.0
 */


$next_post = get_next_post();
$prev_post = get_previous_post();

if ( $next_post || $prev_post ) {

	$pagination_classes = '';

	if ( ! $next_post ) {
		$pagination_classes = ' only-one only-prev';
	} elseif ( ! $prev_post ) {
		$pagination_classes = ' only-one only-next';
	}

	?>

	<nav class="pagination-single <?php echo esc_attr( $pagination_classes ); ?>" aria-label="<?php esc_attr_e( 'Post', 'pixelo' ); ?>" role="navigation">

		<div class="pagination-single-inner">

			<?php
			if ( $prev_post ) {
				?>

				<a class="previous-post" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
          <span class="arrow" aria-hidden="true">&larr;</span>
          <span><?php printf( __( 'Previous Post', 'pixelo' ) ); ?></span>
				</a>

				<?php
			}

			if ( $next_post ) {
				?>

				<a class="next-post" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
					<span><?php printf( __( 'Next Post', 'pixelo' ) ); ?></span>
          <span class="arrow" aria-hidden="true">&rarr;</span>
				</a>
				<?php
			}
			?>

		</div><!-- .pagination-single-inner -->

	</nav><!-- .pagination-single -->

	<?php
}
