<?php
/**
 * Adds a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param WP_Post  $item  Menu item data object.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return stdClass An object of wp_nav_menu() arguments.
 */
function pixelo_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

	// Add sub menu toggles to the Expanded Menu with toggles.
	if ( isset( $args->show_toggles ) && $args->show_toggles ) {

		// Wrap the menu item link contents in a div, used for positioning.
		$args->before = '<div class="ancestor-wrapper">';
		$args->after  = '';

		// Add a toggle to items with children.
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

			$toggle_target_string = '.menu-modal .menu-item-' . $item->ID . ' > .sub-menu';
			$toggle_duration      = pixelo_toggle_duration();

			// Add the sub menu toggle.
			$args->after .= '<button class="toggle sub-menu-toggle fill-children-current-color" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="' . absint( $toggle_duration ) . '" aria-expanded="false"><span class="screen-reader-text"></span></button>';

		}

		// Close the wrapper.
		$args->after .= '</div><!-- .ancestor-wrapper -->';

		// Add sub menu icons to the primary menu without toggles.
	} elseif ( 'primary' === $args->theme_location ) {
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$args->after = '<span class="icon"></span>';
		} else {
			$args->after = '';
		}
	}

	return $args;

}

add_filter( 'nav_menu_item_args', 'pixelo_add_sub_toggles_to_main_menu', 10, 3 );

/**
 * Miscellaneous
 */

/**
 * Toggles animation duration in milliseconds.
 *
 * @return int Duration in milliseconds
 */
function pixelo_toggle_duration() {
	/**
	 * Filters the animation duration/speed used usually for submenu toggles.
	 *
	 * @since Pixelo 1.0
	 *
	 * @param int $duration Duration in milliseconds.
	 */
	$duration = apply_filters( 'pixelo_toggle_duration', 250 );

	return $duration;
}

/**
 * Function to get single post meta
 */
function pixelo_single_post_meta() {
	
    $comment = get_theme_mod( 'pixelo_single_blog_post_comment', true );
    $author = get_theme_mod( 'pixelo_signle_blog_post_author', true );
    $publish_date = get_theme_mod( 'pixelo_single_blog_post_publish_date', true );
    $cateogry = get_theme_mod( 'pixelo_single_blog_post_category', true );

	?>
    
		<div class="single_meta">

            <?php if( !empty( $author ) ) { ?> 

                <div class="author-item">

                    <img src="<?php echo esc_url( get_theme_file_uri('/images/user-icon.png') ); ?>" alt="">

                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">

                        <?php 

                            global $current_user; wp_get_current_user();
                            
                            echo get_the_author(); 
                        
                        ?>

                    </a>

                </div>

            <?php } ?>

            <?php if( !empty( $cateogry ) ) { ?> 

                <div class="cat-item">

                    <?php echo esc_attr('Category: ', 'pixelo'); the_category( ); ?>

                </div>

            <?php } ?>

            <?php if( !empty( $comment ) ) { ?> 
                
                <div class="comment-item">

                    <img src="<?php echo esc_url( get_theme_file_uri('/images/comment-icon.png') ); ?>" alt="Icon">

                    <?php

                        if ( comments_open() ) {

                            comments_popup_link( '0', '1', '%', 'post-comments' );

                        }

                    ?>

                </div>

            <?php } ?>

            <?php if( !empty( $publish_date ) ) { ?>

                <div class="date-item">

                    <img src="<?php echo esc_url( get_theme_file_uri('/images/clock-icon.png') ); ?>" alt="Icon">

                    <span>

                        <?php echo get_the_date( 'M j, Y' ); ?>

                    </span>

                </div>

            <?php } ?>

		</div>

	<?php

}

/**
 * Function to get post pagination
 */
if ( !function_exists( 'pixelo_post_pagination' ) ) {

	/**
	 * Function to get pagination
	 *
	 * @since Pixelo 1.0
	 *
	 * @param int $duration Duration in milliseconds.
	 */
	function pixelo_post_pagination() {
		
		$prev_arrow = is_rtl() ? 'Next' : 'Prev';
		$next_arrow = is_rtl() ? 'Prev' : 'Next';
		
		global $wp_query;
		$total = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}
	
}