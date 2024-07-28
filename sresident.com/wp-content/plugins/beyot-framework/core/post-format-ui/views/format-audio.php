<div id="g5plus-pfui-post-format-audio" class="g5plus-pfui-wrap" style="display: none;">
	<?php do_action( 'g5plus_pfui_before_audio_meta' ); ?>
	<div class="g5plus-pfui-elm-block">
		<label for="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_audio_embed); ?>"><?php esc_html_e('Audio URL (oEmbed) or Embed Code','beyot-framework'); ?></label>
		<textarea name="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_audio_embed); ?>" id="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_audio_embed); ?>" tabindex="1"><?php echo esc_textarea(get_post_meta($post->ID, G5Plus_Post_Formats_UI::$format_audio_embed, true)); ?></textarea>
	</div>
	<?php do_action( 'g5plus_pfui_after_audio_meta' ); ?>
</div>
