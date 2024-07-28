<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
/**
 * @var $current_page
 */
$pages_settings = gfDashboard()->get_config_pages();
?>
<div class="gf-dashboard-tab-wrapper">
	<ul class="gf-dashboard-tab">
		<?php foreach ($pages_settings as $key => $value): ?>
			<?php if (!isset($value['link'])) {
				$value['link'] = admin_url("admin.php?page=gf-{$key}");
			} ?>
			<li class="<?php echo (($current_page === $key) ? 'active' : '') ?>">
				<a href="<?php echo esc_url($value['link']) ?>"><?php echo esc_html($value['menu_title']) ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
