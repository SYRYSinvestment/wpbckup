<div class="g5plus-pfui-wrap" style="display: none;" id="g5plus-pfui-post-format-link">
	<?php do_action( 'g5plus_pfui_before_link_meta' ); ?>
	<div class="g5plus-pfui-elm-block">
		<label for="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_link_text); ?>"><?php esc_html_e('Text','beyot-framework'); ?></label>
		<input type="text" name="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_link_text); ?>" value="<?php echo esc_attr(get_post_meta($post->ID, G5Plus_Post_Formats_UI::$format_link_text, true)); ?>" id="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_link_text); ?>" tabindex="1" />
	</div>
	<div class="g5plus-pfui-elm-block">
		<label for="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_link_url); ?>"><?php esc_html_e('Url','beyot-framework'); ?></label>
		<input type="text" name="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_link_url); ?>" value="<?php echo esc_attr(get_post_meta($post->ID, G5Plus_Post_Formats_UI::$format_link_url, true)); ?>" id="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_link_url); ?>" tabindex="2" />
	</div>
	<?php do_action( 'g5plus_pfui_after_link_meta' ); ?>
</div>

