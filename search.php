<?php get_header(); ?>

<main class="container" style="padding-top: 60px; padding-bottom: 80px; min-height: 60vh;">

    <!-- Search Header -->
    <div style="margin-bottom: 48px;">
        <p style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-text-light); font-weight: 700; margin-bottom: 12px;">
            <?php esc_html_e( 'Search Results', 'lumio' ); ?>
        </p>
        <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: -0.02em; margin-bottom: 20px;">
            <?php
            printf(
                /* translators: %s: search query */
                esc_html__( 'Results for: %s', 'lumio' ),
                '<span style="color: var(--color-accent);">' . esc_html( get_search_query() ) . '</span>'
            );
            ?>
        </h1>

        <!-- Search form -->
        <?php get_search_form(); ?>
    </div>

    <?php if ( have_posts() ) : ?>

        <div class="posts-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>

                    <div class="post-author-col" style="text-align: center;">
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" style="text-decoration: none;">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 60, '', esc_attr( get_the_author() ), array( 'class' => 'home-author-img' ) ); ?>
                            <span class="home-author-name"><?php the_author(); ?></span>
                        </a>
                    </div>

                    <div class="post-content">
                        <div class="post-meta-row" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <span style="color: var(--color-accent); font-weight: 800; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px;">
                                <?php $cats = get_the_category(); echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : esc_html__( 'Post', 'lumio' ); ?>
                            </span>
                            <span style="color: #ccc;">&bull;</span>
                            <span style="color: var(--color-text-light); font-size: 0.9rem;">
                                <?php echo esc_html( get_the_date() ); ?>
                            </span>
                        </div>

                        <h2 class="post-item-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <div class="post-item-excerpt">
                            <?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
                        </div>
                    </div>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-image-col">
                            <a href="<?php the_permalink(); ?>" class="post-list-thumb">
                                <?php the_post_thumbnail( 'medium_large', array( 'style' => 'width:100%; height:100%; object-fit:cover; border-radius:12px;' ) ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination" style="margin-top: 60px; text-align: center;">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>

        <div style="text-align: center; padding: 80px 0;">
            <p style="font-size: 5rem; margin-bottom: 16px;">🔍</p>
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 16px;">
                <?php esc_html_e( 'Nothing found', 'lumio' ); ?>
            </h2>
            <p style="color: var(--color-text-light); font-size: 1.05rem; max-width: 480px; margin: 0 auto 40px;">
                <?php esc_html_e( 'Sorry, no results matched your search. Try different keywords.', 'lumio' ); ?>
            </p>
            <?php get_search_form(); ?>
        </div>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
