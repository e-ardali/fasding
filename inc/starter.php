<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function theme_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails', array('post', 'page'));
    add_theme_support('html5', array('search-form'));

    register_nav_menus(array(
        'main-menu' => __('Main Menu'),
    ));
}

add_action('after_setup_theme', 'theme_setup');

function theme_enqueue_scripts(): void
{
    if (file_exists(get_template_directory() . '/vite_dev')) {
        wp_enqueue_script_module('vite-client', $_ENV['VITE_HOST'] . '/@vite/client', [], null, true);
        wp_enqueue_script_module('theme', $_ENV['VITE_HOST'] . '/src/js/app.js', [], null, true);
        wp_enqueue_style('theme', $_ENV['VITE_HOST'] . '/src/css/app.css', [], null);
    } else {
        $assetsManifest = assets_manifest();
        foreach ($assetsManifest as $asset) {
            if ($asset['file'] && $asset['name']) {
                wp_enqueue_script($asset['name'], get_stylesheet_directory_uri() . '/' . $_ENV['ASSETS_DIRECTORY'] . '/' . $asset['file'], [], null);

                if ($asset['css']) {
                    foreach ($asset['css'] as $key => $css) {
                        wp_enqueue_style($asset['name'] . '-' . $key + 1, get_stylesheet_directory_uri() . '/' . $_ENV['ASSETS_DIRECTORY'] . '/' . $css, [], null);
                    }
                }
            }
        }
    }
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');