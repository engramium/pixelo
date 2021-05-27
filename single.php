<?php get_header(); ?>
<?php
    if(have_posts()) { while(have_posts()) : the_post();
?>

<main class="row single-page">

    <h1 class="heading"><?php the_title(); ?></h1>
    <p class="meta">
        <?php 
        _e( 'By ', 'pixelo' );
        the_author(); 
        _e( ' in', 'pixelo' );
        ?>
        <?php the_category( ' ' ); ?> &middot;
        <time class="date"><?php the_date( get_option( 'date_format' ) ); ?></time>
    </p>

    <?php the_content();?>

    <?php 
    if(has_tag()) {
       ?><div class="post-tags"><?php the_tags(); ?> </div>
       <?php
    } else { /* Article untagged */ } ?>
    <?php
        $defaults = array(
            'before'           => '<p>' . __( 'Pages:', 'pixelo' ),
            'after'            => '</p>',
            'link_before'      => '',
            'link_after'       => '',
            'next_or_number'   => 'number',
            'separator'        => ' ',
            'nextpagelink'     => __( 'Next page', 'pixelo'),
            'previouspagelink' => __( 'Previous page', 'pixelo' ),
            'pagelink'         => '%',
            'echo'             => 1
        );
        wp_link_pages( $defaults );
    ?>

    <?php 
        endwhile; }
    ?>

    <?php comments_template() ?>


</main>
<?php get_footer(); ?>
