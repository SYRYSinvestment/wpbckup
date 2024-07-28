<?php
/**
 * The template for displaying the Header Mobile
 */
$stiky_wrapper = array('header-mobile-wrapper');
$stiky_region = array('header-mobile-inner');
if (g5plus_get_option('mobile_header_stick', 0)) {
	$stiky_wrapper[] = 'sticky-wrapper';
	$stiky_region[] = 'sticky-region';
}
$mobile_header_layout = g5plus_get_option('mobile_header_layout', 'header-mobile-1');
?>
<div class="<?php echo join(' ', $stiky_wrapper); ?>">
	<div class="<?php echo join(' ', $stiky_region); ?>">
		<div class="container header-mobile-container">
			<div class="header-mobile-container-inner clearfix">
				<?php get_template_part('templates/header/mobile-logo'); ?>
				<div class="toggle-icon-wrapper toggle-mobile-menu"
				     data-drop-type="<?php echo esc_attr(g5plus_get_option('mobile_header_menu_drop', 'menu-drop-fly')); ?>">
					<div class="toggle-icon"><span></span></div>
				</div>
				<?php if (g5plus_get_option('mobile_header_login', 1)): ?>
					<div class="mobile-login">
						<?php
						if (class_exists('ERE_Widget_Login_Menu')) {
							the_widget('ERE_Widget_Login_Menu');
						}
						?>
					</div>
				<?php endif; ?>
				<?php if (g5plus_get_option('mobile_header_search_box', 1) && ($mobile_header_layout !== 'header-mobile-4')): ?>
					<div class="mobile-search-button">
						<?php get_template_part('templates/header/customize-search-button'); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php get_template_part('templates/header/mobile-navigation'); ?>
		</div>
	</div>
</div>