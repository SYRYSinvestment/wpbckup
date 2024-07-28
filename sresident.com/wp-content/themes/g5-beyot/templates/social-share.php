<?php
/**
 * The template for displaying social share
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */

$social_sharing = g5plus_get_option('social_sharing', array());
if($social_sharing == '' || count($social_sharing)<1) return;
?>
<div class="social-share">
    <?php foreach ($social_sharing as $social):?>
        <?php if ($social == "facebook") : ?>
            <a class="facebook" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>','sharer', 'toolbar=0,status=0');"  href="javascript:;">
                <i class="fa fa-facebook"></i>
            </a>
        <?php endif; ?>

        <?php if ($social == "twitter") :  ?>
            <a class="twitter" onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr(urlencode(get_the_title())); ?> <?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;"  href="javascript:;">
                <i class="fa fa-twitter"></i>
            </a>
        <?php endif; ?>

        <?php if ($social == "google") :  ?>
            <a class="google-plus" href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;">
                <i class="fa fa-google-plus"></i>
            </a>
        <?php endif; ?>

        <?php if ($social == "linkedin"):?>
            <a class="linkedin" onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;title=<?php echo esc_attr(urlencode(get_the_title())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                <i class="fa fa-linkedin"></i>
            </a>
        <?php endif; ?>

        <?php if ($social == "tumblr") :  ?>
            <a class="tumblr" onclick="popUp=window.open('http://www.tumblr.com/share/link?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;name=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_excerpt())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                <i class="fa fa-tumblr"></i>
            </a>

        <?php endif; ?>

        <?php if ($social == "pinterest") :  ?>
            <a class="pinterest" onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo has_post_thumbnail() ? esc_attr($arrImages[0])  : "" ; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                <i class="fa fa-pinterest"></i>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>