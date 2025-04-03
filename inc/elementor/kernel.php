<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function register_widgets($widgets_manager): void
{
    require_once(__DIR__ . '/inc/elementor/widgets/Sample.php');

    $widgets_manager->register(new \Elementor\Sample());
}

add_action('elementor/widgets/register', 'register_sample_widget');