<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>
<body <?php body_class('body'); ?>>

<?php if ( is_singular('fasding_layout') ) { ?>
    <header>
    // Header
</header>
<?php } ?>