<?php
/**
 * The template for displaying bottom-bar
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */

if (!g5plus_get_option('bottom_bar_visible', 1)) {
	return;
}

$left_sidebar = g5plus_get_option('bottom_bar_left_sidebar', 'bottom_bar_left');
$right_sidebar = g5plus_get_option('bottom_bar_right_sidebar', 'bottom_bar_right');
$bottom_bar_layout = g5plus_get_option('bottom_bar_layout', 'bottom-bar-1');
if ('bottom-bar-4' === $bottom_bar_layout) {
	$right_sidebar = '';
}

$bottom_bar_matrix = array(
	'bottom-bar-1' => array('col-lg-6', 'col-lg-6'),
	'bottom-bar-2' => array('col-lg-8', 'col-lg-4'),
	'bottom-bar-3' => array('col-lg-4', 'col-lg-8'),
	'bottom-bar-4' => array('col-md-12', 'col-md-12'),
);

$col_left_sidebar = $bottom_bar_matrix[$bottom_bar_layout][0];
$col_right_sidebar = $bottom_bar_matrix[$bottom_bar_layout][1];

if (!is_active_sidebar($left_sidebar) || !is_active_sidebar($right_sidebar)) {
	$col_left_sidebar = 'col-md-12';
	$col_right_sidebar = 'col-md-12';
}
$bottom_bar_class = array('bottom-bar-wrapper', 'bar-wrapper');
if ($bottom_bar_layout === 'bottom-bar-4') {
	$bottom_bar_class[] = 'text-center';
	$col_right_sidebar = '';
}
$bottom_bar_border_top = g5plus_get_option('bottom_bar_border_top', 'none');
if ($bottom_bar_border_top !== 'none') {
	$bottom_bar_class[] = $bottom_bar_border_top;
}
$footer_container_layout = g5plus_get_option('footer_container_layout', 'container');
$exists_bottom_bar = is_active_sidebar($left_sidebar) || is_active_sidebar($right_sidebar);
?>
<?php if ($exists_bottom_bar): ?>
	<div class="<?php echo join(' ', $bottom_bar_class); ?>">
		<div class="<?php echo esc_attr($footer_container_layout); ?>">
			<div class="bottom-bar-inner">
				<div class="row">
					<?php if (is_active_sidebar($left_sidebar)): ?>
						<div class="bottom-bar-left bar-left <?php echo esc_attr($col_left_sidebar); ?>">
							<?php dynamic_sidebar( $left_sidebar );?>
						</div>
					<?php endif;?>
					<?php if (is_active_sidebar($right_sidebar)): ?>
						<div class="bottom-bar-right bar-right <?php echo esc_attr($col_right_sidebar); ?>">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
<?php endif;?>