<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2017, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   3.0.0
 *
 * Comments Template
 * The template for displaying Comments
 * This is the template that displays the area of the page that contains both the current comments and the comment form
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area" itemscope itemtype="http://schema.org/Comment">

    <span class="comments-title">
    	<?php esc_html_e( 'Comentários:', 'storms' ); ?>
	    <?php
	    	
	    	// This is the original title for comments section
			//$comment_count = get_comments_number();
			//if ( 1 === $comment_count ) {
			//	printf(
			//		/* translators: 1: title. */
			//		esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'storms' ),
			//		'<span>' . get_the_title() . '</span>'
			//	);
			//} else {
			//	printf( // WPCS: XSS OK.
			//		/* translators: 1: comment count number, 2: title. */
			//		esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'storms' ) ),
			//		number_format_i18n( $comment_count ),
			//		'<span>' . get_the_title() . '</span>'
			//	);
			//}
			
		?>
    </span>

    <?php
    if ( have_comments() ) : ?>
        <ul class="commentlist list-unstyled">
            <?php
            // Register Bootstrap Comment Walker
            wp_list_comments( array(
                'style'         => 'ul',
                'short_ping'    => true,
                'avatar_size'   => '64',
                'walker'        => new \StormsFramework\Storms\Bootstrap\WP_Bootstrap_Commentwalker(),
            ) );
            ?>
        </ul><!-- .comment-list -->

        <?php the_comments_pagination( array(
            'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i><span class="sr-only"> ' . esc_html__( 'Older Comments', 'storms' ) . '</span>',
            'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i><span class="sr-only"> ' . esc_html__( 'Newer Comments', 'storms' ) . '</span>',
        ) );
    endif; // Check for have_comments().

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'storms' ); ?></p>

        <?php
    endif;

    comment_form();
    ?>

</div><!-- #comments -->
