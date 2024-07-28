<?php
/**
 * The template for displaying content masonry
 *
 * @package WordPress
 * @subpackage Beyot
 * @since Beyot 1.0
 */
/**
 * @var $args
 */
$size = 'medium-image';
$excerpt =  get_the_excerpt();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr(join(' ', $args['class']))); ?>>
	<div class="entry-content-wrap clearfix">
		<?php g5plus_get_post_thumbnail($size,0,false); ?>
		<div class="entry-post-meta clearfix">
			<div class="entry-meta-date">
				<i class="icon-calendar2"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url(get_permalink()),esc_html( get_the_time(get_option('date_format')))); ?>
			</div>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="entry-meta-comment">
					<?php comments_popup_link( wp_kses_post(__('<i class="icon-bubbles2"></i> 0 comments','g5-beyot')), wp_kses_post(__('<i class="icon-bubbles2"></i> 1 comment','g5-beyot')), wp_kses_post(__('<i class="icon-bubbles2"></i> % comments','g5-beyot')), '', ''); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="entry-content-inner">
			<div class="entry-info-post clearfix">
				<h3 class="entry-post-title"><a title="<?php the_title(); ?>"
												href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</article>
