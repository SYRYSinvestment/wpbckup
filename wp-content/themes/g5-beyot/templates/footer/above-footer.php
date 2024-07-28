<?php
$set_footer_above_custom = g5plus_get_option('set_footer_above_custom', 0);
$footer_container_layout = g5plus_get_option('footer_container_layout','container');
if ($set_footer_above_custom):
	global $post;
	$post = get_post($set_footer_above_custom);
	setup_postdata( $post );
	?>
	<div class="footer-above-wrapper">
		<div class="<?php echo esc_attr($footer_container_layout); ?>">
		<?php the_content(); ?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
endif;