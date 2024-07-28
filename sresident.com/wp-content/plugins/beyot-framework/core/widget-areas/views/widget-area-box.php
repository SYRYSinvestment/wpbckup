<?php
/**
 * The template for displaying widget-area-box.php
 *
 * @package WordPress
 * @subpackage emo
 * @since emo 1.0
 */
?>
<div id="gf-add-widget">
	<div class="sidebar-name">
		<h3><?php esc_html_e('Create Widget Area', 'beyot-framework'); ?></h3>
	</div>
	<div class="sidebar-description">
		<form id="addWidgetAreaForm" action="" method="post">
			<div class="widget-content">
				<input id="gf-add-widget-input" name="gf-add-widget-input" type="text" class="regular-text" required="required"
				       title="<?php echo esc_attr(esc_html__('Name','beyot-framework')); ?>"
				       placeholder="<?php echo esc_attr(esc_html__('Name','beyot-framework')); ?>" />
			</div>
			<div class="widget-control-actions">
				<?php wp_nonce_field('gf_add_sidebar_action', 'gf_add_sidebar_nonce') ?>
				<input class="gf-sidebar-add-sidebar button button-primary button-hero" type="submit" value="<?php echo esc_attr(esc_html__('Create Widget Area', 'beyot-framework')); ?>" />
			</div>
		</form>
	</div>
</div>