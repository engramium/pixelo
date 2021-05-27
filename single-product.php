<?php get_header(); ?>
<?php
    if(have_posts()) {
        while(have_posts()) : the_post();
?>
<main class="row single-page">
    <h1 class="heading"><?php the_title(); ?></h1>
    <?php the_content();?>
    <ol class="commentlist">
        <?php wp_list_comments(); paginate_comments_links(); ?>

    </ol>

    <?php comment_form(); ?>
    <?php 
        endwhile; }
    ?>
</main>
<?php get_footer(); ?>
