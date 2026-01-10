<?php get_header(); ?>

<main class="single-container" style="max-width: 100%;"> <!-- Main wrapper -->
    
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- 1. Centered Header -->
            <header class="single-header" style="max-width: 800px; margin: 0 auto 60px; text-align: center;">
                <div class="single-cats" style="margin-bottom: 20px;">
                    <?php the_category(', '); ?>
                </div>
                <h1 class="single-title" style="margin-bottom: 30px; font-size: 3rem; line-height: 1.2;"><?php the_title(); ?></h1>
                
                <!-- Rich Metadata with Avatar -->
                <div class="single-meta-rich" style="display: flex; align-items: center; justify-content: center; gap: 15px;">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="meta-avatar-link">
                        <?php echo get_avatar(get_the_author_meta('ID'), 50, '', '', array('style' => 'border-radius:50%; display:block;')); ?>
                    </a>
                    <div class="meta-info" style="text-align: left; line-height: 1.3;">
                        <span class="meta-author" style="font-weight: 700; color: var(--color-text-main); display: block; font-size: 1rem;">
                            <?php the_author_posts_link(); ?>
                        </span>
                        <span class="meta-date" style="color: var(--color-text-light); font-size: 0.85rem;">
                            <?php echo get_the_date(); ?> &bull; 5 min read
                        </span>
                    </div>
                </div>
            </header>

            <!-- 2. Featured Image (Rounded) -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image-container" style="max-width: 1000px; margin: 0 auto 80px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
                    <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
                </div>
            <?php endif; ?>

            <!-- 3. Content Body & TOC Wrapper -->
            <!-- The strategy: A centered container of 720px. The TOC is absolutely positioned relative to this container BUT pushed out to the left. -->
            <div class="content-wrapper-context" style="position: relative; max-width: 720px; margin: 0 auto;">
                
                <!-- TOC Widget: Absolute Positioned on Desktop -->
                <!-- left: -300px places it to the left of the content. Media queries in CSS will handle hiding it on small screens. -->
                <aside id="toc-container" class="toc-widget"></aside>

                <div class="entry-content">
                    <?php the_content(); ?>
                    
                    <!-- Social Share -->
                    <div class="share-box-container" style="margin-top: 60px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05);">
                        <div class="share-box">
                            <span style="font-weight: 700; font-size: 0.9rem; color: #888;">Share:</span>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn"><i class="fa-brands fa-twitter"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-btn"><i class="fa-solid fa-envelope"></i></a>
                            <button onclick="navigator.clipboard.writeText('<?php echo get_permalink(); ?>'); alert('Link copied!');" class="share-btn"><i class="fa-solid fa-link"></i></button>
                        </div>
                    </div>

                    <!-- Tags -->
                    <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <?php the_tags('', '', ''); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Comments -->
            <div class="comments-container" style="max-width: 720px; margin: 80px auto 0;">
                <?php 
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>

        </article>

    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>
