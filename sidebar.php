<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pixelo
 */

?>
<div id="secondary" class="widget-area" role="complementary">
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
		</aside>
		<aside id="archives" class="widget">
				<h3 class="widget-title"><?php printf( __('Archives', 'pixelo') ); ?></h3>
				<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
		</aside>
	<?php endif; ?>
</div><!-- #secondary -->	
