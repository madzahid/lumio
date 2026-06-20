<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="max-image-preview:large">
    <?php wp_head(); ?>
    <style>
    .site-header .container{display:flex!important;align-items:center!important;justify-content:space-between!important;flex-wrap:nowrap!important;gap:16px!important;}
    .search-toggle{background:none!important;border:none!important;cursor:pointer;color:#262626;padding:8px;border-radius:6px;display:flex!important;align-items:center;margin-left:auto!important;flex-shrink:0;}
    .search-toggle:hover{color:#87CEEB;background:rgba(135,206,235,0.12)!important;}
    .main-navigation{flex:1;margin-left:32px;}
    .site-title,.site-title a{font-size:1.5rem!important;font-weight:800;color:#262626;text-decoration:none;margin:0;padding:0;}
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
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

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>

            <!-- Search toggle -->
            <button class="search-toggle" id="search-toggle" aria-label="<?php esc_attr_e( 'Search', 'lumio' ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>
        </div>

        <!-- Search bar (hidden by default) -->
        <div class="search-bar" id="search-bar" hidden>
            <div class="container">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <div class="site-content">
