<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage beyot
 * @since beyot 1.0
 */
$size = 'large-image';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single clearfix'); ?>>
	<?php g5plus_get_post_thumbnail($size, 0, true);?>
	<div class="entry-post-meta clearfix">
		<div class="entry-meta-date">
			<i class="icon-calendar2"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url(get_the_title()),esc_html( get_the_time(get_option('date_format')))); ?>
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
								<a href="<?php echo esc_url($link_cate)?>" title="<?php echo esc_attr($title_cate)?>"><?php echo esc_html($title_cate);?></a>
							</li>
						<?php endif;?>
						<?php if($index == 1):?>
							<li class="category-item">
								<a href="<?php echo esc_url($link_cate)?>" title="<?php echo esc_attr($title_cate)?>"><?php echo esc_html($title_cate);?></a>
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
	<h1 class="entry-post-title"><?php the_title(); ?></h1>
	<div class="entry-content-wrap">
		<div class="entry-content clearfix">
			<?php $title_enable = g5plus_get_option('single_title_enable',0);?>
			<?php if($title_enable == 1):?>
				<h3 class="entry-post-title"><?php the_title(); ?></h3>
			<?php endif;?>
			<?php
			the_content();
			wp_link_pages(array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:','g5-beyot') . '</span>',
				'after' => '</div>',
				'link_before' => '<span class="page-link">',
				'link_after' => '</span>',
			)); ?>
		</div>
	</div>
</article>
<?php
/**
 * @hooked - g5plus_post_tag - 5
 * @hooked - g5plus_post_nav - 10
 * @hooked - g5plus_post_author_info - 15
 * @hooked - g5plus_post_comment - 20
 * @hooked - g5plus_post_related - 30
 *
 **/
do_action('g5plus_after_single_post');
?>

