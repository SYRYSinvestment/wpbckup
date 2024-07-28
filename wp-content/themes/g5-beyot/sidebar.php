<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
$page_layouts = &g5plus_get_page_layout_settings();
if (!$page_layouts['has_sidebar']) return;
$sidebar_class = array('primary-sidebar', 'sidebar');
$sidebar_inner_class = array('primary-sidebar-inner');
if (is_active_sidebar($page_layouts['sidebar']) && ($page_layouts['sidebar_layout'] != 'none')) {
	$sidebar_col = 3;
	if ($page_layouts['sidebar_width'] == 'large') {
		$sidebar_col = 4;
	}
	//$sidebar_class[] = 'col-md-'.$sidebar_col;
	$sidebar_class[] = 'col-lg-'.$sidebar_col;
	/*if ($page_layouts['sidebar_layout'] == 'left') {
		$sidebar_class[] = 'col-md-pull-'.(12-$sidebar_col);
	}*/

	if ($page_layouts['sidebar_mobile_enable'] == 0) {
		//$sidebar_class[] = 'hidden-sm hidden-xs';
		$sidebar_class[] = 'sidebar-mobile-hidden';
	} else if ($page_layouts['sidebar_mobile_canvas']) {
		$sidebar_class[] = 'sidebar-mobile-canvas';
	}
}
$sidebar_sticky_enable = g5plus_get_option('sidebar_sticky_enable', 1);
if($sidebar_sticky_enable==1)
{
	wp_enqueue_script('hc-sticky');
	$sidebar_inner_class[] = 'gf-sticky';
}
?>
<?php if ($page_layouts['sidebar_mobile_enable'] && $page_layouts['sidebar_mobile_canvas']) : ?>
	<div class="sidebar-mobile-canvas-icon" title="<?php esc_attr_e('Click to show Canvas Sidebar', 'g5-beyot' ) ?>">
		<i class="fa fa-sliders"></i>
	</div>
<?php endif; ?>
<div class="<?php echo esc_attr(join(' ', $sidebar_class)); ?>">
	<div class="<?php echo esc_attr(join(' ', $sidebar_inner_class)); ?>">
		<?php dynamic_sidebar($page_layouts['sidebar']); ?>
	</div>
</div>
