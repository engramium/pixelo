<div class="related-posts">
  <h2><?php printf( __( 'Related Posts:', 'pixelo' ) ); ?></h2>
  <div class="related-post-wrap">
    <?php
      $pixelo_related_query = new WP_Query(  array (
        'post_type' => 'post',
        'post__not_in' => array(  get_the_ID()  ),
        'ignore_sticky_posts' => 1,
        'posts_per_page' => 3,
        'orderby' => 'date',
      ));
    ?>
    <?php if (  $pixelo_related_query->have_posts()  ) { ?>
      <?php while ( $pixelo_related_query->have_posts()  ) { ?>

      <?php $pixelo_related_query->the_post(); ?>
      <div class="single-item">

        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'blog-related-thumb' ); ?>
          <h4><?php the_title(); ?></h4>
        </a>

      </div>
      <?php } ?>
      <?php wp_reset_postdata(); ?>

    <?php } ?>
  </div>

</div>