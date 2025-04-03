<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function register_widgets( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/oembed-widget.php' );

    $widgets_manager->register( new \Elementor_oEmbed_Widget() );

}
add_action( 'elementor/widgets/register', 'register_widgets' );