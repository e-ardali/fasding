<?php
/**
 * Template Part: Custom Header Layout
 * Loads the first "Header" layout from fasding_layout post type.
 */

$header_query = new WP_Query([
    'post_type'      => 'fasding_layout',
    'meta_key'       => '_fasding_layout_type',
    'meta_value'     => 'header',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC'
]);

?>
<header>
    <?php
    if ($header_query->have_posts()) {
        $header_query->the_post();
        the_content();
        wp_reset_postdata();
    }
    ?>
</header>
