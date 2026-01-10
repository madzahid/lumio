<?php
// hackmonks_theme/functions.php

function hackmonks_setup() {
    // Add dynamic title tag support
    add_theme_support('title-tag');
    
    // Add featured image support
    add_theme_support('post-thumbnails');
    
    // Add HTML5 support
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'hackmonks_setup');

function hackmonks_scripts() {
    // Enqueue Google Fonts (Syne + Figtree) for Array Clone
    wp_enqueue_style('hackmonks-fonts', 'https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&family=Syne:wght@400;700;800&display=swap');
    
    // Enqueue Font Awesome for Social Icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    // Enqueue Main Stylesheet
    wp_enqueue_style('hackmonks-style', get_stylesheet_uri(), array(), '1.0.1');

    // Enqueue TOC Script (only on single posts)
    if (is_single()) {
        wp_enqueue_script('hackmonks-toc', get_template_directory_uri() . '/js/toc.js', array(), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'hackmonks_scripts');

// Optimization: Remove Emoji bloat
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// SEO: Auto-downgrade H1s in content to H2s to maintain single H1 hierarchy
function hackmonks_downgrade_h1_to_h2($content) {
    // Regex matches <h1> and </h1> (case insensitive) and replaces with <h2> and </h2>
    return preg_replace('/<(\/?)h1(.*?)>/i', '<$1h2$2>', $content);
}
add_filter('the_content', 'hackmonks_downgrade_h1_to_h2');
// SEO Fallback: If Rank Math / Yoast are NOT active, generate basic tags
function hackmonks_seo_fallback() {
    // Check for Rank Math or Yoast - REMOVED to force output
    // if (defined('RANK_MATH_VERSION') || defined('WPSEO_VERSION')) { return; }

    global $post;
    $desc = '';
    $title = get_bloginfo('name');
    $url = home_url();

    if (is_front_page() || is_home()) {
        $desc = get_bloginfo('description');
        $title = get_bloginfo('name') . ' - ' . $desc;
    } elseif (is_single() || is_page()) {
        $desc = get_the_excerpt();
        $title = get_the_title() . ' - ' . get_bloginfo('name');
        $url = get_permalink();
    }

    // Clean up description
    $desc = strip_tags($desc);
    $desc = trim($desc);
    if (empty($desc)) {
        $desc = get_bloginfo('description');
    }

    // Output Meta Tags
    echo "\n<!-- Theme SEO Fallback -->\n";
    echo '<meta name="description" content="' . esc_attr($desc) . '" />' . "\n";
    
    // Open Graph
    echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($desc) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
    
    // OG Image
    if (has_post_thumbnail($post->ID)) {
        $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
        echo '<meta property="og:image" content="' . esc_url($img[0]) . '" />' . "\n";
    }
}
add_action('wp_head', 'hackmonks_seo_fallback', 1);
?>
