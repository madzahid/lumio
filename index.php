<?php get_header(); ?>

<!-- Hero Section with Radial Glow -->
<div class="hero-wrapper">
    <div class="container">
        <h2 class="hero-title"><?php bloginfo( 'description' ); ?></h2>
        <p class="hero-desc"><?php bloginfo( 'name' ); ?> is your premier source for Artificial Intelligence news, Cybersecurity alerts, and Consumer Tech reviews. We decode complex innovations for professionals and enthusiasts alike.</p>
    </div>
</div>

<main class="container">

    <!-- Category Cards (3 Column) -->
    <div class="category-grid">
        <?php
        $lumio_categories = get_categories( array(
            'orderby' => 'count',
            'order'   => 'DESC',
            'number'  => 6,
        ) );
        $lumio_i = 0;
        foreach ( $lumio_categories as $lumio_cat ) {
            $lumio_i++;
            $lumio_color = 'color-' . ( ( $lumio_i - 1 ) % 4 + 1 );
            $lumio_link  = get_category_link( $lumio_cat->term_id );
            ?>
            <a href="<?php echo esc_url( $lumio_link ); ?>" class="cat-card <?php echo esc_attr( $lumio_color ); ?>">
                <h3 class="cat-title"><?php echo esc_html( $lumio_cat->name ); ?></h3>
                <span class="cat-count"><?php echo esc_html( $lumio_cat->count ); ?> Articles</span>
            </a>
            <?php
        }
        ?>
    </div>

    <!-- Latest Posts -->
    <div class="posts-list">
        <h3 class="section-heading"><?php esc_html_e( 'Latest Stories', 'lumio' ); ?></h3>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>

                <!-- Author Column (Left) -->
                <div class="post-author-col">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 60, '', esc_attr( get_the_author() ), array( 'class' => 'home-author-img' ) ); ?>
                        <span class="home-author-name"><?php the_author(); ?></span>
                    </a>
                </div>

                <div class="post-content">
                    <div class="post-meta-row">
                        <span class="post-cat-label">
                            <?php
                            $lumio_post_cats = get_the_category();
                            echo ! empty( $lumio_post_cats ) ? esc_html( $lumio_post_cats[0]->name ) : esc_html__( 'Story', 'lumio' );
                            ?>
                        </span>
                        <span class="meta-sep">&bull;</span>
                        <span class="post-date-label"><?php echo esc_html( get_the_date() ); ?></span>
                    </div>

                    <h2 class="post-item-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="post-item-excerpt">
                        <?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
                    </div>
                </div>

                <!-- Featured Image (Right) -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-image-col">
                        <a href="<?php the_permalink(); ?>" class="post-list-thumb">
                            <?php the_post_thumbnail( 'medium_large', array( 'class' => 'post-list-img' ) ); ?>
                        </a>
                    </div>
                <?php endif; ?>

            </article>
        <?php endwhile; endif; ?>
    </div>

    <div class="pagination">
        <?php the_posts_pagination(); ?>
    </div>

</main>

<?php get_footer(); ?>
