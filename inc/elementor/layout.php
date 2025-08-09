<?php

/**
 *
 * Register a post type for headers and footers of pages
 */
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
    'show_in_rest' => true
]);

/**
 * Register a custom query variable for Elementor preview for the layouts
 *
 */
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

/**
 * Redirects to 404 if a user tries to access a layout without being logged in
 */
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

/**
 * Add a meta box to select the layout type (header or footer)
 * @return void
 */
function fasding_layout_add_meta_box(): void
{
    add_meta_box(
        'fasding_layout_type_meta_box',
        __('Layout Type', 'fasding'),
        'fasding_layout_type_meta_box_callback',
        'fasding_layout', // Custom Post Type
        'side'
    );
}

add_action('add_meta_boxes', 'fasding_layout_add_meta_box');

/**
 * Callback function for the layout type meta box
 * @param $post
 * @return void
 */
function fasding_layout_type_meta_box_callback($post): void
{
    $value = get_post_meta($post->ID, '_fasding_layout_type', true);
    ?>
    <label for="fasding_layout_type"><?php _e('Select layout type:', 'fasding'); ?></label><br>
    <select name="fasding_layout_type" id="fasding_layout_type">
        <option value=""><?php _e('-- Select --', 'fasding'); ?></option>
        <option value="header" <?php selected($value, 'header'); ?>>
            <?php _e('Header', 'fasding'); ?>
        </option>
        <option value="footer" <?php selected($value, 'footer'); ?>>
            <?php _e('Footer', 'fasding'); ?>
        </option>
    </select>
    <?php
}

/**
 * Save the selected layout type when the post is saved
 * @param $post_id
 * @return void
 */
function fasding_layout_save_meta_box($post_id): void
{
    if (array_key_exists('fasding_layout_type', $_POST)) {
        update_post_meta(
            $post_id,
            '_fasding_layout_type',
            sanitize_text_field($_POST['fasding_layout_type'])
        );
    }
}

add_action('save_post', 'fasding_layout_save_meta_box');


