<?php
/**
 * The template for displaying post thumbnail
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 * @var $size
 * @var $noImage
 * @var $is_single
 */
$hasThumb = false;
$gallery_id = rand();
?>
<?php if (has_post_format('gallery')) : ?>
    <?php $g5plus_gallery = get_post_meta(get_the_ID(), 'g5plus_format_gallery_images', true); ?>
    <?php if ($g5plus_gallery) : ?>
        <?php $hasThumb = true; ?>
        <div class="entry-thumb-wrap">
	        <div class="owl-carousel owl-dot-bottom owl-nav-center-inner" data-plugin-options='{"items": 1, "loop" : false, "dots" : true, "nav" : true, "autoplay": true,"autoHeight": true}'>
		        <?php foreach ($g5plus_gallery as $image_id): ?>
			        <?php g5plus_get_post_image($image_id, $size, $gallery_id, $is_single); ?>
		        <?php endforeach; ?>
	        </div>
        </div>
    <?php endif; ?>
<?php elseif (has_post_format('video')) : ?>
    <?php $g5plus_video = get_post_meta(get_the_ID(), 'g5plus_format_video_embed', true); ?>
    <?php if (!empty($g5plus_video)): ?>
        <?php $hasThumb = true; ?>
        <div class="entry-thumb-wrap">
            <?php if (wp_oembed_get($g5plus_video)) : ?>
                <?php if (has_post_thumbnail()) : ?>
                    <?php $g5plus_video_image = g5plus_get_image_src(get_post_thumbnail_id(), $size); ?>
                    <div class="entry-thumbnail post-video">
                        <?php if ($is_single == true): ?>
                        <div class="entry-thumbnail-overlay">
                            <?php else: ?>
                            <a class="entry-thumbnail-overlay" href="<?php the_permalink(); ?>"
                               title="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                                <img class="img-responsive" src="<?php echo esc_url($g5plus_video_image); ?>"
                                     alt="<?php the_title_attribute(); ?>"/>
                                <?php if ($is_single == true): ?>
                        </div>
                        <?php else: ?>
                        </a>
                        <?php
                        endif; ?>
                        <a class="view-video zoomGallery" data-src="<?php echo esc_url($g5plus_video); ?>"><i
                                class="fa fa-play"></i></a>
                    </div>
                <?php else: ?>
                    <div
                        class="embed-responsive embed-responsive-16by9 embed-responsive-<?php echo esc_attr($size); ?>">
                        <?php echo wp_oembed_get($g5plus_video, array('wmode' => 'transparent')); ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="embed-responsive embed-responsive-16by9 embed-responsive-<?php echo esc_attr($size); ?>">
                    <?php echo sprintf('%s',$g5plus_video); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php elseif (has_post_format('audio')): ?>
    <?php $g5plus_audio = get_post_meta(get_the_ID(), 'g5plus_format_audio_embed', true); ?>
    <?php if (!empty($g5plus_audio)): ?>
        <?php $hasThumb = true; ?>
        <div class="entry-thumb-wrap">
            <div class="embed-responsive embed-responsive-16by9 embed-responsive-<?php echo esc_attr($size); ?>">
                <?php if (wp_oembed_get($g5plus_audio)) : ?>
                    <?php echo wp_oembed_get($g5plus_audio); ?>
                <?php else : ?>
	                <?php echo sprintf('%s',$g5plus_audio) ; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php elseif (has_post_format('quote')): ?>
    <?php
    $g5plus_quote_content = get_post_meta(get_the_ID(), 'g5plus_format_quote_content', true);
    $g5plus_quote_author_text = get_post_meta(get_the_ID(), 'g5plus_format_quote_author_text', true);
    $g5plus_quote_author_url = get_post_meta(get_the_ID(), 'g5plus_format_quote_author_url', true);
    ?>
    <?php if (!empty($g5plus_quote_content)): ?>
        <?php $hasThumb = true; ?>
        <div class="entry-thumb-wrap">
            <blockquote>
                <p>
                    "<?php echo esc_html($g5plus_quote_content); ?>"
                    <?php if (!empty($g5plus_quote_author_text) && !empty($g5plus_quote_author_url)) : ?>
                        <cite><a href="<?php echo esc_url($g5plus_quote_author_url) ?>"
                                 title="<?php echo esc_attr($g5plus_quote_author_text); ?>"><?php echo esc_html($g5plus_quote_author_text); ?></a></cite>
                    <?php endif;; ?>
                </p>
            </blockquote>
        </div>
    <?php endif; ?>
<?php elseif (has_post_format('link')): ?>
    <?php
    $g5plus_link_text = get_post_meta(get_the_ID(), 'g5plus_format_link_text', true);
    $g5plus_link_url = get_post_meta(get_the_ID(), 'g5plus_format_link_url', true);
    ?>
    <?php if (!empty($g5plus_link_text) && !empty($g5plus_link_url)) : ?>
        <?php $hasThumb = true; ?>
        <div class="entry-thumb-wrap">
	        <blockquote>
		        <a target="_blank" class="s-font" href="<?php echo esc_url($g5plus_link_url) ?>" title="<?php echo esc_attr($g5plus_link_text); ?>">
                    <?php echo esc_html($g5plus_link_text); ?>
                </a>
	        </blockquote>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (!$hasThumb) : ?>
    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-thumb-wrap">
            <?php g5plus_get_post_image(get_post_thumbnail_id(), $size, $gallery_id); ?>
        </div>
    <?php elseif ($noImage) : ?>
        <div class="entry-thumb-wrap">
            <div class="entry-thumbnail <?php echo esc_attr($size); ?>">
                <div class="no-image block-center">
                    <div class="block-center-inner"><?php esc_html_e('No Image', 'g5-beyot'); ?></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
