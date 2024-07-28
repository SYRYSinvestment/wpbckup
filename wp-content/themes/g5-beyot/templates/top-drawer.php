<?php
$top_drawer_type = g5plus_get_option('top_drawer_type', 'hide');
if ((!$top_drawer_type) || ($top_drawer_type === 'hide')) {
    return;
}

$top_drawer_sidebar = g5plus_get_option('top_drawer_sidebar', '');
if (!is_active_sidebar($top_drawer_sidebar)) {
    return;
}

$top_drawer_class = array(
    'top-drawer-wrapper',
    'top-drawer-type-' . $top_drawer_type
);

$top_drawer_hide_mobile = g5plus_get_option('top_drawer_hide_mobile', '1');
$top_drawer_wrapper_layout = g5plus_get_option('top_drawer_wrapper_layout', 'container');
if ($top_drawer_hide_mobile=='0') {
    $top_drawer_class[] = 'top-drawer-mobile-invisible';
}

$top_drawer_container_class = array('top-drawer-container');
if ($top_drawer_wrapper_layout && ($top_drawer_wrapper_layout !== 'full')) {
    $top_drawer_container_class[] = esc_attr($top_drawer_wrapper_layout);
}
?>
<div class="<?php echo join(' ', $top_drawer_class); ?>">
    <div class="<?php echo join(' ', $top_drawer_container_class); ?>">
        <div class="top-drawer-inner">
            <?php dynamic_sidebar($top_drawer_sidebar); ?>
        </div>
    </div>
    <?php if ($top_drawer_type === 'toggle'): ?>
        <span class="top-drawer-toggle"><i class="fa fa-plus"></i></span>
    <?php endif;?>
</div>
