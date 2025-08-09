<?php
/**
 * Template Part: Custom Footer Layout
 * Loads the first "Footer" layout from fasding_layout post type.
 */

$footer_query = new WP_Query([
    'post_type' => 'fasding_layout',
    'meta_key' => '_fasding_layout_type',
    'meta_value' => 'footer',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC'
]);

?>
<footer>
    <?php if ($footer_query->have_posts()) {
        while ($footer_query->have_posts()) {
            $footer_query->the_post();
            the_content();
        }
        wp_reset_postdata();
    } ?>
</footer>
