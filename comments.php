<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $lumio_comment_count = get_comments_number();
            if ('1' === $lumio_comment_count) {
                printf(
                    esc_html__('One comment on &ldquo;%1$s&rdquo;', 'lumio'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf( 
                    esc_html(_nx('%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $lumio_comment_count, 'comments title', 'lumio')),
                    number_format_i18n($lumio_comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
            ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'lumio'); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().

    comment_form(array(
        'class_submit' => 'submit-btn',
        'title_reply' => '<span style="font-size: 1.2rem; font-weight: 700;">Leave a Reply</span>',
        'fields' => array(
            'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="Name" value="" size="30" maxlength="245" required="required" /></p>',
            'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" placeholder="Email" value="" size="30" maxlength="100" aria-describedby="email-notes" required="required" /></p>',
        ),
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="Share your thoughts..." required="required"></textarea></p>',
    ));
    ?>

</div><!-- #comments -->
