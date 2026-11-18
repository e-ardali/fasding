<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php echo \Illuminate\Support\Facades\Vite::withEntryPoints(['resources/css/app.css'])->toHtml(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php \App\renderFasdingLocation('header'); ?>
