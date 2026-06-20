    </div><!-- .site-content -->

    <footer class="site-footer">
        <div class="container">
            <nav class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'container'      => false,
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo('name'); ?>.</p>
            <p style="font-size: 0.8em; margin-top: 10px; opacity: 0.7;">
                Theme Designed and Coded by <a href="https://xuro.net" target="_blank" style="color: #525252; text-decoration: underline;">Xuro.Net</a>
            </p>
        </div>
    </footer>

    <?php wp_footer(); ?>
    <script>
    (function() {
        var btn = document.getElementById('search-toggle');
        var bar = document.getElementById('search-bar');
        if (btn && bar) {
            btn.addEventListener('click', function() {
                var hidden = bar.hasAttribute('hidden');
                if (hidden) {
                    bar.removeAttribute('hidden');
                    bar.querySelector('.search-field') && bar.querySelector('.search-field').focus();
                } else {
                    bar.setAttribute('hidden', '');
                }
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') bar.setAttribute('hidden', '');
            });
        }
    })();
    </script>
</body>
</html>
