<?php get_header(); ?>

<?php 
// SEO: JSON-LD Schema for Author
$author_id = get_the_author_meta('ID');
$schema = [
    "@context" => "https://schema.org",
    "@type" => "Person",
    "name" => get_the_author(),
    "url" => get_author_posts_url($author_id),
    "description" => get_the_author_meta('description'),
    "image" => get_avatar_url($author_id),
    "sameAs" => [
        get_the_author_meta('user_url')
    ]
];
?>
<script type="application/ld+json">
<?php echo json_encode($schema); ?>
</script>

<div class="author-profile-header">
    <div class="container" style="text-align: center; max-width: 800px; padding: 80px 0;">
        <div class="author-avatar-wrapper" style="margin-bottom: 25px;">
            <?php echo get_avatar(get_the_author_meta('ID'), 140, '', '', array('class' => 'profile-img-large')); ?>
        </div>
        <h1 class="author-name" style="font-size: 3.5rem; margin-bottom: 15px; letter-spacing: -0.02em;"><?php the_author(); ?></h1>
        <div class="author-bio" style="font-size: 1.3rem; color: var(--color-text-light); line-height: 1.6; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
            <?php the_author_meta('description'); ?>
        </div>
        <div class="author-meta-row" style="display: flex; justify-content: center; gap: 20px; font-size: 1rem; font-weight: 600; color: #888;">
            <span class="location"><i class="fa-solid fa-location-dot"></i> <?php echo get_the_author_meta('user_url') ? '<a href="'.get_the_author_meta('user_url').'" target="_blank">Website</a>' : 'Everywhere'; ?></span>
            <span>&bull;</span>
            <span class="posts-count"><?php echo count_user_posts(get_the_author_meta('ID')); ?> Posts</span>
        </div>
    </div>
</div>

<main class="container">
    <div class="posts-list">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post-item">
                <div class="post-content">
                    <div class="post-meta-row" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <span style="color: var(--color-accent); font-weight: 800; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px;">
                            <?php $cats = get_the_category(); echo !empty($cats) ? esc_html($cats[0]->name) : 'Story'; ?>
                        </span>
                        <span style="color: #ccc;">&bull;</span>
                        <span style="color: var(--color-text-light); font-weight: 400; font-size: 0.9rem;">
                            <?php echo get_the_date(); ?>
                        </span>
                    </div>
                    
                    <h2 class="post-item-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <div class="post-item-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
    
    <div class="pagination" style="margin-top: 60px; text-align: center;">
        <?php the_posts_pagination(); ?>
    </div>
</main>

<?php get_footer(); ?>
