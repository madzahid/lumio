<?php get_header(); ?>

<!-- Hero Section with Radial Glow -->
<div class="hero-wrapper">
    <div class="container">
        <h2 class="hero-title"><?php bloginfo('description'); ?></h2>
        <p class="hero-desc">Explore the future of technology with deep dives into AI, Cybersecurity, and Innovation.</p>
    </div>
</div>

<main class="container">
    
    <!-- Section A: Category Cards (3 Column) -->
    <!-- We simulate this by fetching actual categories -->
    <div class="category-grid">
        <?php
        $categories = get_categories(array(
            'orderby' => 'count',
            'order'   => 'DESC',
            'number'  => 3
        ));
        $i = 0;
        foreach( $categories as $category ) {
            $i++;
            $color_class = 'color-' . $i; // color-1, color-2, color-3
            $cat_link = get_category_link($category->term_id);
            ?>
            <a href="<?php echo esc_url($cat_link); ?>" class="cat-card <?php echo $color_class; ?>">
                <h3 class="cat-title"><?php echo esc_html($category->name); ?></h3>
                <span class="cat-count"><?php echo esc_html($category->count); ?> Articles</span>
            </a>
            <?php
        }
        ?>
    </div>

    <!-- Section B: Latest Posts (List Layout) -->
    <div class="posts-list">
        <h3 style="margin-bottom: 30px; font-size: 1.2rem; text-transform: uppercase; letter-spacing: 1px; color: #888;">Latest Stories</h3>
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post-item">
                
                <!-- Author Column (Left) -->
                <div class="post-author-col" style="text-align: center;">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" style="text-decoration: none;">
                        <?php echo get_avatar(get_the_author_meta('ID'), 60, '', 'Author', array('class' => 'home-author-img')); ?>
                        <span class="home-author-name"><?php the_author(); ?></span>
                    </a>
                </div>

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

                <!-- Featured Image Column (Right) -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-image-col">
                        <a href="<?php the_permalink(); ?>" class="post-list-thumb">
                            <?php the_post_thumbnail('medium_large', array('style' => 'width:100%; height:100%; object-fit:cover; border-radius:12px;')); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; endif; ?>
    </div>

    <div class="pagination" style="margin-top: 60px; text-align: center;">
        <?php the_posts_pagination(); ?>
    </div>

</main>

<?php get_footer(); ?>
