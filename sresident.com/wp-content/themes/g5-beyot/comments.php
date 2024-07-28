<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>
<div id="comments" class="comments-area clearfix">
	<?php if (have_comments()) : ?>
		<div class="comments-list clearfix">
			<h4 class="blog-line-title mg-top-100"><?php comments_number(esc_html__('No Comments', 'g5-beyot'), esc_html__('One Comments', 'g5-beyot'), esc_html__('% Comments', 'g5-beyot')) ?></h4>
			<ol class="comment-list clearfix">
				<?php wp_list_comments(array(
					'style' => 'ol',
					'callback' => 'g5plus_render_comments',
					'avatar_size' => 100,
					'short_ping' => true,
				)); ?>
			</ol>
			<!-- .comment-list -->
			<?php if (get_comment_pages_count() > 1): ?>
				<nav class="comment-navigation text-right clearfix mg-top-20" role="navigation">
					<?php $paginate_comments_args = array(
						'prev_text' => '<i class="fa fa-arrow-left"></i>',
						'next_text' => '<i class="fa fa-arrow-right"></i>'
					);
					paginate_comments_links($paginate_comments_args);
					?>
				</nav>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'g5-beyot' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
