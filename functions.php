<?php
// lumio/functions.php

function lumio_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );
    add_editor_style( 'style.css' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'lumio' ),
        'footer'  => __( 'Footer Menu', 'lumio' ),
    ) );
}
add_action( 'after_setup_theme', 'lumio_setup' );

function lumio_scripts() {
    // Google Fonts
    wp_enqueue_style( 'lumio-fonts', 'https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&family=Syne:wght@400;700;800&display=swap', array(), null );

    // Main stylesheet
    wp_enqueue_style( 'lumio-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    // TOC + share scripts (single posts only)
    if ( is_single() ) {
        wp_enqueue_script( 'lumio-toc', get_template_directory_uri() . '/js/toc.js', array(), wp_get_theme()->get( 'Version' ), true );
        wp_enqueue_script( 'lumio-share', get_template_directory_uri() . '/js/share.js', array(), wp_get_theme()->get( 'Version' ), true );
        wp_localize_script( 'lumio-share', 'lumioShare', array(
            'copied' => __( 'Link copied!', 'lumio' ),
        ) );
    }

    // Comment reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lumio_scripts' );

// Widget area
function lumio_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'lumio' ),
        'id'            => 'footer-widgets',
        'description'   => __( 'Add widgets here to appear in the footer.', 'lumio' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'lumio_widgets_init' );

// Robots meta via hook
function lumio_robots_meta() {
    echo '<meta name="robots" content="max-image-preview:large">' . "\n";
}
add_action( 'wp_head', 'lumio_robots_meta' );

// Remove emoji bloat
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Auto-downgrade H1s in content to H2s
function lumio_downgrade_h1_to_h2( $content ) {
    return preg_replace( '/<(\/?)h1(.*?)>/i', '<$1h2$2>', $content );
}
add_filter( 'the_content', 'lumio_downgrade_h1_to_h2' );

// SEO fallback (when Rank Math / Yoast not active)
function lumio_seo_fallback() {
    if ( defined( 'RANK_MATH_VERSION' ) || defined( 'WPSEO_VERSION' ) ) {
        return;
    }

    global $post;
    $desc  = '';
    $title = get_bloginfo( 'name' );
    $url   = home_url();

    if ( is_front_page() || is_home() ) {
        $desc  = get_bloginfo( 'description' );
        $title = get_bloginfo( 'name' ) . ' - ' . $desc;
    } elseif ( is_single() || is_page() ) {
        $desc  = get_the_excerpt();
        $title = get_the_title() . ' - ' . get_bloginfo( 'name' );
        $url   = get_permalink();
    }

    $desc = trim( strip_tags( $desc ) );
    if ( empty( $desc ) ) {
        $desc = get_bloginfo( 'description' );
    }

    echo "\n<!-- Lumio SEO Fallback -->\n";
    echo '<meta name="description" content="' . esc_attr( $desc ) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";

    if ( ! empty( $post->ID ) && has_post_thumbnail( $post->ID ) ) {
        $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        if ( $img ) {
            echo '<meta property="og:image" content="' . esc_url( $img[0] ) . '" />' . "\n";
        }
    }
}
add_action( 'wp_head', 'lumio_seo_fallback', 1 );

// Local avatars
function lumio_get_custom_avatar( $avatar, $id_or_email, $args ) {
    $user_id = false;

    if ( is_numeric( $id_or_email ) ) {
        $user_id = absint( $id_or_email );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $user_id = absint( $id_or_email->user_id );
        } elseif ( ! empty( $id_or_email->ID ) ) {
            $user_id = absint( $id_or_email->ID );
        } elseif ( ! empty( $id_or_email->post_author ) ) {
            $user_id = absint( $id_or_email->post_author );
        }
    } elseif ( is_string( $id_or_email ) && is_email( $id_or_email ) ) {
        $user = get_user_by( 'email', $id_or_email );
        if ( $user ) {
            $user_id = $user->ID;
        }
    }

    if ( ! $user_id ) {
        return $avatar;
    }

    $custom_avatar_id = get_user_meta( $user_id, 'custom_avatar_id', true );

    if ( $custom_avatar_id ) {
        $image = wp_get_attachment_image_src( $custom_avatar_id, 'thumbnail' );
        if ( $image ) {
            $size    = isset( $args['size'] ) ? $args['size'] : '96';
            $classes = 'avatar avatar-' . $size . ' photo';
            if ( ! empty( $args['class'] ) ) {
                $classes .= ' ' . ( is_array( $args['class'] ) ? implode( ' ', $args['class'] ) : $args['class'] );
            }
            $alt_text = get_the_author_meta( 'display_name', $user_id );
            return '<img alt="' . esc_attr( $alt_text ) . '" src="' . esc_url( $image[0] ) . '" class="' . esc_attr( $classes ) . '" height="' . esc_attr( $size ) . '" width="' . esc_attr( $size ) . '" style="border-radius:50%;" />';
        }
    }

    return $avatar;
}
add_filter( 'pre_get_avatar', 'lumio_get_custom_avatar', 10, 3 );

function lumio_register_avatar_meta() {
    register_meta( 'user', 'custom_avatar_id', array(
        'type'         => 'integer',
        'single'       => true,
        'show_in_rest' => true,
    ) );
}
add_action( 'rest_api_init', 'lumio_register_avatar_meta' );
