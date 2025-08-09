<?php
/**
 * Template for displaying a single Fasding Layout post.
 * This template skips the regular header and footer.
 */

get_header();
if (have_posts()) :
    the_post();

    if (\Elementor\Plugin::instance()->preview->is_preview_mode() || is_user_logged_in()) {
        the_content();
    } else {
        wp_die('You are not allowed to view this page.');
    }
endif;
get_footer();


