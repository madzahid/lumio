<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    
    <header class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php if (is_front_page() || is_home()) : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                    </h1>
                <?php else : ?>
                    <div class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div class="site-content">
