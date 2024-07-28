<?php
/**
 * The template for displaying image hover
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
$image_attr = array();
if (!empty($width) && !empty($height)) {
	$image_attr[] = "width='$width'";
	$image_attr[] = "height='$height'";
}
?>
<div class="entry-thumbnail">
	<?php if ($is_single): ?>
	<div class="entry-thumbnail-overlay">
		<?php else: ?>
		<a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>" class="entry-thumbnail-overlay">
			<?php endif; ?>
			<img <?php echo join(' ', $image_attr); ?> src="<?php echo esc_url($image_src); ?>"
			                                           alt="<?php echo esc_attr($title); ?>" class="img-responsive">
			<?php if ($is_single): ?>
	</div>
<?php else: ?>
	</a>
<?php endif; ?>
	<a data-thumb-src="<?php echo esc_url($image_thumb_link); ?>" data-gallery-id="<?php echo esc_attr($galleryId); ?>"
	   data-rel="lightGallery" href="<?php echo esc_url($image_full_src); ?>" class="zoomGallery"><i
			class="fa fa-expand"></i></a>
</div>