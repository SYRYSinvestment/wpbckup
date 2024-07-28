<?php
/**
 * The template for displaying tags on single post
 *
 * @package WordPress
 * @subpackage Beyot
 * @since Beyot 1.0
 */
$single_tag_enable = g5plus_get_option('single_tag_enable',1);
$single_share_enable = g5plus_get_option('single_share_enable',1);
if ($single_tag_enable || $single_share_enable){
	echo '<div class="entry-meta-tag-wrap clearfix">';
	if ($single_tag_enable) {
		the_tags('<div class="entry-meta-tag"><i class="fa fa-tags"></i>', ', ', '</div>');
	}
	if ($single_share_enable) {
		g5plus_the_social_share();
	}
	echo '</div>';
}

