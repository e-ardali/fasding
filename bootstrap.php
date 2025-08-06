<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Vendor autoload
require_once __DIR__ . '/vendor/autoload.php';

// Load env
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(__DIR__ . '/.env');

// Require includes
require_once __DIR__ . '/inc/helpers.php';
require_once __DIR__ . '/inc/starter.php';

// Load WordPress plugin functions
require_once ABSPATH . 'wp-admin/includes/plugin.php';
if (is_plugin_active('elementor/elementor.php')) {
    require_once __DIR__ . '/inc/elementor/kernel.php';
    require_once __DIR__ . '/inc/elementor/layout.php';
}