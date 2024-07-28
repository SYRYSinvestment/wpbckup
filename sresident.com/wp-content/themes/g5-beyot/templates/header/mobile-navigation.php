<?php
/**
 * Header Mobile Navigation
 */
$theme_location = 'primary';
if (has_nav_menu( 'mobile' )) {
	$theme_location = 'mobile';
}

$header_mobile_class = array('header-mobile-nav');
$header_mobile_class[] = esc_attr(g5plus_get_option('mobile_header_menu_drop', 'menu-drop-fly'));

/**
 * Get page custom menu
 */

$page_menu_mobile = g5plus_get_option('page_menu_mobile', '');
$page_menu = g5plus_get_option('page_menu', '');
if (!$page_menu_mobile) {
	$page_menu_mobile = $page_menu;
}
?>
<div class="<?php echo join(' ', $header_mobile_class) ?>">
	<?php echo apply_filters('g5plus_before_menu_mobile_filter',''); ?>
	<?php if (has_nav_menu($theme_location) || $page_menu_mobile): ?>
		<?php
		$arg_menu = array(
			'container' => 'header-mobile-nav-inner',
			'theme_location' => $theme_location,
			'menu_class' => 'nav-menu-mobile',
			'is_mobile_menu' => true,
		);
		wp_nav_menu( $arg_menu );
		?>
	<?php endif;?>
	<?php echo apply_filters('g5plus_after_menu_mobile_filter',''); ?>
</div>