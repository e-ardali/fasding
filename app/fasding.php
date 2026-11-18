<?php

namespace App;

add_action('after_setup_theme', function () {
    register_nav_menu('main-menu', __('Main Menu', 'fasding'));

    if (did_action('elementor/loaded')) {
        require_once get_theme_file_path('inc/elementor/kernel.php');
        require_once get_theme_file_path('inc/elementor/layout.php');
    }
});

add_action('elementor/theme/register_locations', function ($manager) {
    $manager->register_location('header');
    $manager->register_location('footer');
});

/**
 * Render an existing Fasding template part, unless Elementor Pro supplies it.
 */
function renderFasdingLocation(string $location): void
{
    if (is_singular('fasding_layout')) {
        return;
    }

    if (function_exists('elementor_theme_do_location') && elementor_theme_do_location($location)) {
        return;
    }

    if (! post_type_exists('fasding_layout')) {
        return;
    }

    $layouts = new \WP_Query([
        'post_type' => 'fasding_layout',
        'post_status' => 'publish',
        'meta_key' => '_fasding_layout_type',
        'meta_value' => $location,
        'posts_per_page' => 1,
        'no_found_rows' => true,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);

    if ($layouts->have_posts()) {
        $layouts->the_post();
        the_content();
        wp_reset_postdata();
    }
}
