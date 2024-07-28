<?php
$header_class = array('header-wrapper', 'clearfix');
$header_container_layout = g5plus_get_option('header_container_layout', 'container');
$header_border_bottom = g5plus_get_option('header_border_bottom', 'none');
$header_float = g5plus_get_option('header_float', 0);
$header_sticky = g5plus_get_option('header_sticky', 0);

if ($header_border_bottom != 'none') {
    $header_class[] = $header_border_bottom;
}

if ($header_float) {
    $header_class[] = 'float-header';
}
$sticky_wrapper = array();
$sticky_region_class = array();
if ($header_sticky) {
    $sticky_wrapper[] = 'sticky-wrapper';
    $sticky_region_class[] = 'sticky-region';
}

/**
 * Get page custom menu
 */
$page_menu = g5plus_get_option('page_menu', '');
?>
<div class="<?php echo join(' ', $sticky_wrapper); ?>">
    <div class="<?php echo join(' ', $header_class); ?>">
        <div class="<?php echo join(' ', $sticky_wrapper); ?>">
            <div class="header-nav-wrapper <?php echo join(' ', $sticky_region_class); ?>">
                <div class="<?php echo esc_attr($header_container_layout); ?>">
                    <?php if (has_nav_menu('primary') || $page_menu): ?>
                        <nav class="<?php echo esc_attr($header_container_layout); ?> primary-menu clearfix">
                            <?php
                            $arg_menu = array(
                                'menu_id' => 'main-menu',
                                'container' => '',
                                'theme_location' => 'primary',
                                'menu_class' => 'main-menu'
                            );
                            wp_nav_menu($arg_menu);
                            g5plus_get_template('header/header-customize', array('customize_location' => 'nav'));
                            ?>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="<?php echo esc_attr($header_container_layout); ?> header-above-inner container-inner clearfix">
            <?php get_template_part('templates/header/logo'); ?>
            <?php g5plus_get_template('header/header-customize', array('customize_location' => 'right')); ?>
        </div>
    </div>
</div>