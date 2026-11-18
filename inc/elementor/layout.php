<?php

/**
 *
 * Register a post type for headers and footers of pages
 */
add_action('init', function () {
    register_post_type('fasding_layout', [
        'labels' => [
            'name' => __('Template Parts', 'fasding'),
            'singular_name' => __('Template Part', 'fasding'),
            'menu_name' => __('Template Parts', 'fasding'),
            'name_admin_bar' => __('Template Part', 'fasding'),
            'add_new' => __('Add New', 'fasding'),
            'add_new_item' => __('Add New Template Part', 'fasding'),
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
});

add_action('template_redirect', function () {
    if (is_singular('fasding_layout') && ! current_user_can('edit_post', get_queried_object_id())) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
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
    wp_nonce_field('fasding_layout_type', 'fasding_layout_nonce');
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
    $nonce = $_POST['fasding_layout_nonce'] ?? '';
    $type = $_POST['fasding_layout_type'] ?? null;

    if (! is_string($nonce) || ! wp_verify_nonce(wp_unslash($nonce), 'fasding_layout_type')
        || ! current_user_can('edit_post', $post_id) || wp_is_post_revision($post_id)
        || ! in_array($type, ['', 'header', 'footer'], true)) {
        return;
    }

    update_post_meta($post_id, '_fasding_layout_type', $type);
}

add_action('save_post_fasding_layout', 'fasding_layout_save_meta_box');
