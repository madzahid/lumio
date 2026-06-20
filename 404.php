<?php get_header(); ?>

<main class="container" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 80px 20px;">
    <div class="error-404">
        <h1 style="font-size: 8rem; font-weight: 800; line-height: 1; margin-bottom: 0; color: var(--color-accent);">404</h1>
        <h2 style="font-size: 2rem; font-weight: 700; margin: 20px 0 16px;"><?php esc_html_e( 'Page Not Found', 'lumio' ); ?></h2>
        <p style="color: var(--color-text-light); font-size: 1.1rem; max-width: 480px; margin: 0 auto 40px;">
            <?php esc_html_e( "The page you're looking for doesn't exist or has been moved.", 'lumio' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary" style="display: inline-block; padding: 14px 32px; background: var(--color-accent); color: #fff; border-radius: var(--radius-sm); font-weight: 700; text-decoration: none; font-size: 1rem;">
            <?php esc_html_e( 'Back to Home', 'lumio' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
