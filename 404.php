<?php
get_header(); ?>

	<div class="container error404">
        <h1 class="page-title"><?php _e( 'Not Found', 'pixelo' ); ?></h1>
        <h2><?php _e( 'This is somewhat embarrassing, isn`t it?', 'pixelo' ); ?></h2>
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'pixelo' ); ?></p>
		<?php get_search_form(); ?>
    </div>

<?php get_footer(); ?>