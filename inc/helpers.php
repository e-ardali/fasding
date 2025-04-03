<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('assets_manifest')) {
    function assets_manifest(): array
    {
        $manifest = [];
        if ($_ENV['MANIFEST_PATH']) {
            $path = get_template_directory() . '/' . $_ENV['ASSETS_DIRECTORY'] . '/' . $_ENV['MANIFEST_PATH'];
            if (file_exists($path)) {
                $manifest = json_decode(file_get_contents($path), true);
            }
        }
        return $manifest;
    }
}
