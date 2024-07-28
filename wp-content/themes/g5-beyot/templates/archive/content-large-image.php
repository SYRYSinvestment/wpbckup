<?php
/**
 * The template for displaying content large image
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
/**
 * @var $args
 */
$size = 'large-image';
$excerpt =  get_the_excerpt();

?>
<article id="post-<?php the_ID(); ?>"  <?php post_class( esc_attr(join(' ', $args['class']))); ?>>
	<?php g5plus_get_post_thumbnail($size);?>
	<div class="entry-post-meta clearfix">
		<div class="entry-meta-date">
			<i class="icon-calendar2"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url(get_permalink()),esc_html( get_the_time(get_option('date_format')))); ?>
		</div>
		<div class="entry-meta-author">
			<i class="icon-user2"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() )); ?>
		</div>
		<div class="entry-meta-cat">
			<i class="icon-tags2"></i>

				<?php
				$categories = array();
				$categories = get_the_category(get_the_ID());
				$index = 0;
				if(!empty($categories)):?>
					<span>
						<?php echo esc_html__('Posted in','g5-beyot')?>
					</span>
					<ul>
						<?php foreach($categories as $key):
							$title_cate = $key->name;
							$slug_cate = $key->term_id;
							$link_cate = get_category_link($slug_cate);
							?>
							<?php if($index<2):?>
								<?php if($index == 0):?>
									<li class="category-item">
										<a href="<?php echo esc_url($link_cate)?>" title="<?php echo esc_attr($title_cate)?>"><?php echo esc_html($title_cate)?></a>
									</li>
								<?php endif;?>
								<?php if($index == 1):?>
									<li class="category-item">
										<a href="<?php echo esc_url($link_cate)?>" title="<?php echo esc_attr($title_cate)?>"><?php echo esc_html($title_cate)?></a>
									</li>
								<?php endif;?>
							<?php endif;?>
							<?php $index++;
						endforeach; ?>
					</ul>
				<?php endif;?>
		</div>
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<div class="entry-meta-comment">
				<?php comments_popup_link( wp_kses_post(__('<i class="icon-bubbles2"></i> 0 comments','g5-beyot')), wp_kses_post(__('<i class="icon-bubbles2"></i> 1 comment','g5-beyot')), wp_kses_post(__('<i class="icon-bubbles2"></i> % comments','g5-beyot')), '', ''); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="entry-content-wrap">
		<h3 class="entry-post-title"><a title="<?php the_title(); ?>"
										href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<a href="<?php echo get_permalink() ?>" class="blog-read-more">
			<?php esc_html_e('Read More', 'g5-beyot'); ?>
		</a>
	</div>
</article>
