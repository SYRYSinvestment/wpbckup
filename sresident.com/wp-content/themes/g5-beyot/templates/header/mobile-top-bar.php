<?php
/**
 * The template for displaying the TOP BAR MOBILE
 */

$top_bar_enable = g5plus_get_option('top_bar_mobile_enable', 0);
if (!$top_bar_enable){
    return;
}

$left_sidebar = g5plus_get_option('top_bar_mobile_left_sidebar', 'top_bar_left');
$right_sidebar = g5plus_get_option('top_bar_mobile_right_sidebar', 'top_bar_right');
$top_bar_border = g5plus_get_option('top_bar_mobile_border', 'none');
$top_bar_layout = g5plus_get_option('top_bar_mobile_layout', 'top-bar-1');

if (!is_active_sidebar($left_sidebar) && !is_active_sidebar($right_sidebar)) {
    return;
}

$topBar_Class = array('top-bar-wrapper', 'bar-wrapper');
if ($top_bar_border != 'none') {
    $topBar_Class[] = esc_attr($top_bar_border);
}

$topBar_layout_metrix = array(
    'top-bar-1' => array('col-xs-6', 'col-xs-6'),
    'top-bar-2' => array('col-xs-8', 'col-xs-4'),
    'top-bar-3' => array('col-xs-4', 'col-xs-8'),
    'top-bar-4' => array('col-xs-12', 'col-xs-12')
);
$col_left_sidebar = $topBar_layout_metrix[$top_bar_layout][0];
$col_right_sidebar = $topBar_layout_metrix[$top_bar_layout][1];

if ($top_bar_layout === 'top-bar-4') {
	$topBar_Class[] = 'top-bar-4';
	$right_sidebar = '';
}

if (!is_active_sidebar($left_sidebar) || !is_active_sidebar($right_sidebar)) {
    $col_right_sidebar = 'col-xs-12';
    $col_left_sidebar = 'col-xs-12';
}
?>
<div class="<?php echo join(' ', $topBar_Class); ?>">
    <div class="container">
        <div class="top-bar-inner">
            <div class="row">
                <?php if (is_active_sidebar($left_sidebar)): ?>
                    <div class="bar-left <?php echo esc_attr($col_left_sidebar); ?>">
                        <?php dynamic_sidebar( $left_sidebar );?>
                    </div>
                <?php endif;?>
                <?php if (is_active_sidebar($right_sidebar)): ?>
                    <div class="bar-right <?php echo esc_attr($col_right_sidebar); ?>">
                        <?php dynamic_sidebar( $right_sidebar );?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>