<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
$index = 0;
$sidebars = GF_Widget_Areas::getInstance()->get_widget_areas();
?>
<div class="wrap gf-sidebars-wrap">
	<h1><?php echo esc_html__('Sidebars Management','beyot-framework') ?></h1>
	<div class="gf-sidebars-row">
		<div class="gf-sidebars-col-left">
			<?php GF_Widget_Areas::getInstance()->add_new_widget_area_box(); ?>
		</div>
		<div class="gf-sidebars-col-right">
			<table class="wp-list-table widefat fixed striped table-view-list">
				<thead>
					<tr>
						<th style="width: 50px">#</th>
						<th><?php echo esc_html__('Name','beyot-framework') ?></th>
						<th style="width: 100px"></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($sidebars): ?>
						<?php foreach ($sidebars as $k => $v): $index++; ?>
							<tr>
								<td><?php echo esc_html($index) ?></td>
								<td><?php echo esc_html($v) ?></td>
								<td>
									<button type="button" class="button button-small button-secondary gf-sidebars-remove-item"
									        data-id="<?php echo esc_attr($k) ?>">
										<?php echo esc_html__('Remove','beyot-framework') ?>
									</button>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="3">
								<?php echo esc_html__('No Sidebars defined','beyot-framework') ?>
							</td>
						</tr>
					<?php endif; ?>


				</tbody>
			</table>
		</div>
	</div>
</div>
