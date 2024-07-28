<div class="g5plus-pfui-wrap" id="g5plus-pfui-post-format-quote" style="display: none;">
	<?php do_action( 'g5plus_pfui_before_quote_meta' ); ?>
	<div class="g5plus-pfui-elm-block">
		<label for="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_content);?>"><?php esc_html_e('Quote Content','beyot-framework'); ?></label>
		<textarea name="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_content); ?>" id="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_content); ?>" tabindex="1"><?php echo esc_textarea(get_post_meta($post->ID, G5Plus_Post_Formats_UI::$format_quote_content, true)); ?></textarea>
	</div>
	<div class="g5plus-pfui-elm-block">
		<label for="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_author_text);?>"><?php  esc_html_e('Author Name','beyot-framework'); ?></label>
		<input type="text" name="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_author_text);?>" value="<?php echo esc_attr(get_post_meta($post->ID, G5Plus_Post_Formats_UI::$format_quote_author_text, true)); ?>" id="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_author_text);?>" tabindex="2" />
	</div>
	<div class="g5plus-pfui-elm-block">
		<label for="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_author_url);?>"><?php  esc_html_e('Author Url','beyot-framework'); ?></label>
		<input type="text" name="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_author_url);?>" value="<?php echo esc_attr(get_post_meta($post->ID, G5Plus_Post_Formats_UI::$format_quote_author_url, true)); ?>" id="<?php echo esc_attr(G5Plus_Post_Formats_UI::$format_quote_author_url);?>" tabindex="2" />
	</div>
	<?php do_action( 'g5plus_pfui_after_quote_meta' ); ?>
</div>