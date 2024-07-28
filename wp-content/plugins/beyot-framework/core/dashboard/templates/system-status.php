<?php
/**
 * The template for displaying system-report
 *
 * @package WordPress
 * @subpackage g5-beyot
 * @since g5-beyot 1.0.1
 */

$settings = gfDashboard()->system_status()->get_system_status_settings();
?>
<div class="gf-box gf-copy-system-status">
	<div class="gf-box-head">
		<?php esc_html_e('Get System Report', 'beyot-framework') ?>
	</div>
	<ul class="gf-system-status-list clearfix">
		<li class="clearfix gf-system-status-info">
			<div class="clearfix gf-system-info">
				<div class="gf-label"><a href="#" class="button-primary gf-debug-report"><?php esc_html_e('Get System Report', 'beyot-framework') ?></a></div>
				<div class="gf-info"><?php esc_html_e('Click the button to produce a report, then copy and paste into your support ticket.', 'beyot-framework') ?></div>
			</div>
			<div class="gf-system-report">
				<textarea rows="20" id="system-report" name="system-report"></textarea>
				<a href="javascript:;" class="button-primary gf-copy-system-report"><?php esc_html_e('Copy for Support', 'beyot-framework') ?></a>
			</div>
		</li>
	</ul>
</div>
<?php foreach ($settings as $setting): ?>
	<div class="gf-box">
		<?php if (isset($setting['label']) && (!empty($setting['label']))): ?>
			<div class="gf-box-head">
				<?php echo esc_html($setting['label']) ?>
			</div>
		<?php endif; ?>
		<?php if (isset($setting['fields']) && is_array($setting['fields'])): ?>
			<ul class="gf-system-status-list clearfix">
				<?php foreach ($setting['fields'] as $field): ?>
					<?php if (isset($field['content']) && !empty($field['content'])): ?>
						<li class="clearfix">
							<?php if (isset($field['label']) && !empty($field['label'])): ?>
								<div class="gf-label"><?php echo wp_kses_post($field['label']) ?></div>
							<?php endif; ?>
							<div class="gf-info">
								<?php
								$icons = 'dashicons-editor-help';
								if (isset($field['content']['status'])) {
									if ($field['content']['status'] === false) {
										$icons = 'dashicons-dismiss';
									}
								}
								if (isset($field['content']['html'])) {
									$field['content'] = $field['content']['html'];
								}
								?>
								<?php if (isset($field['help']) && !empty($field['help'])): ?>
									<a href="#" class="gf-help gf-tooltip dashicons <?php echo esc_attr($icons) ?>" title="<?php echo esc_attr($field['help']) ?>"></a>
								<?php endif; ?>
								<?php echo wp_kses_post($field['content']); ?>
							</div>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
<?php endforeach; ?>


