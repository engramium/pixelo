<?php
/**
 * Displays the menu icon and modal
 *
 * @package pixelo
 * @since 1.0.0
 */

?>

<div class="menu-modal cover-modal header-footer-group" data-modal-target-string=".menu-modal">

	<div class="menu-modal-inner modal-inner">

		<div class="menu-wrapper section-inner">

			<div class="menu-top">

				<button class="toggle close-nav-toggle fill-children-current-color" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".menu-modal">
					<span class="toggle-text"><?php _e( 'Close Menu', 'pixelo' ); ?></span>
					<img src="<?php echo esc_url( get_theme_file_uri( '/images/close-icon.png' ) ); ?>" alt="Icon">
				</button><!-- .nav-toggle -->

				

				<nav class="mobile-menu" aria-label="<?php echo esc_attr_x( 'Mobile', 'menu', 'pixelo' ); ?>" role="navigation">

					<ul class="modal-menu reset-list-style">

						<?php
							wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '%3$s',
									'show_toggles'   => true,
									'theme_location' => 'primary',
								)
							);

						?>

					</ul>

				</nav>

			</div><!-- .menu-top -->

		</div><!-- .menu-wrapper -->

	</div><!-- .menu-modal-inner -->

</div><!-- .menu-modal -->
