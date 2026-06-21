    </div><!-- .site-content -->

    <?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
    <div class="footer-widgets">
        <div class="container">
            <?php dynamic_sidebar( 'footer-widgets' ); ?>
        </div>
    </div>
    <?php endif; ?>

    <footer class="site-footer">
        <div class="container">
            <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'lumio' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'container'      => false,
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ) );
                ?>
            </nav>
            <p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</p>
            <p class="footer-credit">
                <?php
                printf(
                    /* translators: %s: link to Xuro.Net */
                    esc_html__( 'Theme Designed and Coded by %s', 'lumio' ),
                    '<a href="https://xuro.net" target="_blank" rel="noopener noreferrer">Xuro.Net</a>'
                );
                ?>
            </p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
