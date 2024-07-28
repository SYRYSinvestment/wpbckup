<div id="g5plus-pfui-post-format-gallery" class="g5plus-pfui-wrap" style="display:none;">
	<div  class="g5plus-pfui-elm-block g5plus-pfui-elm-block-image">
		<label><span><?php esc_html_e('Gallery Images','beyot-framework'); ?></span></label>
		<div class="g5plus-pfui-elm-container">
			<?php do_action( 'g5plus_pfui_before_gallery_meta' ); ?>
			<div class="g5plus-pfui-gallery-picker">
				<?php
				// query the gallery images meta
				$post = get_post();
				$images = get_post_meta($post->ID, G5Plus_Post_Formats_UI::$format_gallery_images, true);

				echo '<div class="gallery clearfix">';
				if ($images) {
					foreach ($images as $image) {
						$thumbnail = wp_get_attachment_image_src($image, 'thumbnail');
						if ($thumbnail) {
							echo '<span data-id="' . $image . '" title="' . 'title' . '"><img src="' . $thumbnail[0] . '" alt="" /><span class="close">x</span></span>';
						}

					}
				}
				echo '</div>';
				?>
				<input type="hidden" name="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_gallery_images) ?>" value="<?php echo (empty($images) ? "" : implode(',', $images)); ?>" />
				<p class="none"><a href="#" class="button g5plus-pfui-gallery-button"><?php esc_html_e('Pick Images','beyot-framework'); ?></a></p>
			</div>

			<?php do_action( 'g5plus_pfui_after_gallery_meta' ); ?>
		</div>
	</div>
</div>
