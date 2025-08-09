<?php get_header(); ?>

<?php
if (have_posts()) : the_post(); ?>
    <div>
        <?php the_title(); ?>
    </div>
    <div>
        <?php the_content(); ?>
    </div>
<?php endif;
?>

<?php get_footer(); ?>
