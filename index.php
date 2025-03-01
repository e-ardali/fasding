<?php get_header(); ?>

<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div>
            <?php the_title(); ?>
        </div>
    <?php endwhile;
endif;
?>

<?php get_footer(); ?>
