<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>
<body <?php body_class('body'); ?>>

<?php if (get_post_type() !== 'fasding_layout') : ?>
<header>
    // Header
</header>
<?php endif ?>