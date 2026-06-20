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
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lumio' ), 'after' => '</div>' ) ); ?>

                    <!-- Social Share -->
                    <div class="share-box-container" style="margin-top: 60px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05);">
                        <div class="share-box">
                            <span style="font-weight: 700; font-size: 0.9rem; color: #888;">Share:</span>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn" aria-label="<?php esc_attr_e( 'Share on Twitter', 'lumio' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="currentColor"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8l164.9-188.5L26.8 48h145.6l100.5 132.9zm-24.8 373.8h39.1L151.1 88h-42z"/></svg></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn" aria-label="<?php esc_attr_e( 'Share on Facebook', 'lumio' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="16" height="16" fill="currentColor"><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V146.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8z"/></svg></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'lumio' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16" height="16" fill="currentColor"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg></a>
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-btn" aria-label="<?php esc_attr_e( 'Share via Email', 'lumio' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" fill="currentColor"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></a>
                            <button onclick="navigator.clipboard.writeText('<?php echo esc_js( get_permalink() ); ?>').then(function(){alert('<?php esc_attr_e( 'Link copied!', 'lumio' ); ?>');});" class="share-btn" aria-label="<?php esc_attr_e( 'Copy link', 'lumio' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="16" height="16" fill="currentColor"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C75 372.6 75 321.6 106.5 290L217.7 178.8c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.8l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg></button>
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
