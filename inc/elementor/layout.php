<?php

register_post_type('fasding_layout', [
    'labels' => [
        'name' => __('Template Parts', 'textdomain'),
        'singular_name' => __('Template Part', 'textdomain'),
        'menu_name' => __('Template Parts', 'textdomain'),
        'name_admin_bar' => __('Template Part', 'textdomain'),
        'add_new' => __('Add New', 'textdomain'),
        'add_new_item' => __('Add New Template Part', 'textdomain'),
    ],
    'public' => false,
    'show_ui' => true,
    'supports' => ['title', 'editor', 'elementor'],
    'show_in_menu' => 'themes.php',
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'has_archive' => false,
    'rewrite' => false,
]);

add_action('parse_query', function ($query) {
    if (!is_admin() && isset($_GET['elementor-preview']) && isset($_GET['post'])) {
        $post_id = absint($_GET['post']);
        $post = get_post($post_id);

        if ($post && $post->post_type === 'fasding_layout') {
            $query->is_single = true;
            $query->is_singular = true;
            $query->is_home = false;
            $query->is_page = false;
            $query->is_archive = false;
            $query->is_post_type_archive = false;
            $query->is_main_query = true;
        }
    }
});

add_action('template_redirect', function () {
    if (
        is_singular('fasding_layout') &&
        !is_user_logged_in() &&
        !isset($_GET['elementor-preview'])
    ) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        include(get_query_template('404'));
        exit;
    }
});