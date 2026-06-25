<?php get_header(); ?>

<main id="content" class="single-container" style="max-width: 100%;">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- 1. Centered Header (Simple) -->
            <header class="single-header" style="max-width: 800px; margin: 0 auto 60px; text-align: center;">
                <h1 class="single-title" style="margin-bottom: 30px; font-size: 3rem; line-height: 1.2;"><?php the_title(); ?></h1>
            </header>

            <!-- 2. Featured Image (Optional for Pages) -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image-container" style="max-width: 1000px; margin: 0 auto 80px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
                    <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
                </div>
            <?php endif; ?>

            <!-- 3. Content Body -->
            <div class="content-wrapper-context" style="position: relative; max-width: 720px; margin: 0 auto;">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>

        </article>
    
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>
