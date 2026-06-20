<?php
/*
Template Name: Google News Sitemap
*/

header('Content-Type: text/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    <?php
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1000,
        'date_query'     => array(
            array(
                'after' => '2 days ago'
            )
        )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $category = get_the_category();
            $genre = 'Blog'; // Default genre
    ?>
    <url>
        <loc><?php the_permalink(); ?></loc>
        <news:news>
            <news:publication>
                <news:name><?php bloginfo('name'); ?></news:name>
                <news:language><?php echo substr(get_bloginfo('language'), 0, 2); ?></news:language>
            </news:publication>
            <news:publication_date><?php echo get_the_date('c'); ?></news:publication_date>
            <news:title><?php echo get_the_title(); ?></news:title>
        </news:news>
    </url>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</urlset>
