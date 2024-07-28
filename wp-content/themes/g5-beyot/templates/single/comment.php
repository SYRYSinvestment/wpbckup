<?php
/**
 * The template for displaying comment item
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
		<?php echo get_avatar($comment, $args['avatar_size']); ?>
		<div class="comment-text entry-content">
			<div class="comment-author-date">
				<div class="author-name"><?php printf('%s', get_comment_author_link()) ?></div>
				<div class="comment-date"><?php echo (esc_html__('Posted on ','g5-beyot') . get_comment_date(get_option('date_format'))) ; ?></div>
			</div>
			<div class="text">
				<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php esc_html_e('Your comment is awaiting moderation.','g5-beyot');?></em>
				<?php endif; ?>
				<div class="comment-meta">
					<?php edit_comment_link('<i class="fa fa-pencil"></i>'); ?>
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="fa fa-reply"></i>'))) ?>
				</div>
			</div>
		</div>
	</div>

