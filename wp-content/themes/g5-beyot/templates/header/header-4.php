<?php
$header_class = array('header-wrapper', 'clearfix');
$header_container_layout = g5plus_get_option('header_container_layout','container');
$header_border_bottom = g5plus_get_option('header_border_bottom','none');
$header_float = g5plus_get_option('header_float', 0);
$header_sticky = g5plus_get_option('header_sticky', 0);

if ($header_border_bottom != 'none') {
    $header_class[] = $header_border_bottom;
}

if ($header_float) {
    $header_class[] = 'float-header';
}

$sticky_wrapper = array();
if ($header_sticky) {
    $sticky_wrapper[] = 'sticky-wrapper';
    $header_class[] = 'sticky-region';
}

/**
 * Get page custom menu
 */
$page_menu = g5plus_get_option('page_menu', '');
?>
<div class="<?php echo join(' ',$sticky_wrapper); ?>">
    <div class="<?php echo join(' ', $header_class); ?>">
        <div class="<?php echo esc_attr($header_container_layout); ?>">
            <div class="header-above-inner container-inner row clearfix">
                <div class="col-sm-3">
                    <?php get_template_part('templates/header/logo'); ?>
                </div>
                <div class="col-xl-6 col-lg-9">
                <?php if (has_nav_menu('primary') || $page_menu): ?>
                    <nav class="primary-menu">
                        <?php
                        $arg_menu = array(
                            'menu_id' => 'main-menu',
                            'container' => '',
                            'theme_location' => 'primary',
                            'menu_class' => 'main-menu'
                        );
                        wp_nav_menu( $arg_menu );
                        ?>
                    </nav>
                <?php endif;?>
                </div>
                <div class="col-xl-3 hidden-md">
                    <?php g5plus_get_template('header/header-customize', array('customize_location' => 'nav'));?>
                </div>

            </div>
        </div>
    </div>
</div>