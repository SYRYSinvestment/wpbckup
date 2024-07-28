<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
/**
 * @hooked - g5plus_output_content_wrapper_end - 1
 **/
do_action('g5plus_main_wrapper_content_end');
?>
</div>
<!-- Close Wrapper Content -->
<?php
/**
 * Footer
 */
$footer_parallax = g5plus_get_option('footer_parallax', 0);
$collapse_footer = g5plus_get_option('collapse_footer', 0);
$set_footer_custom = g5plus_get_option('set_footer_custom', 0);
$footer_css_class = g5plus_get_option('footer_css_class', '');
$main_footer_class = array('main-footer-wrapper',$footer_css_class);
if ($footer_parallax) {
	$main_footer_class[] = 'enable-parallax';
}
if ($collapse_footer && !$set_footer_custom) {
	$main_footer_class[] = 'footer-collapse-able';
}
?>
<footer class="<?php echo join(' ', $main_footer_class) ?>">
	<div id="wrapper-footer">
		<?php
		/**
		 * @hooked - g5plus_footer_template - 10
		 **/
		do_action('g5plus_main_wrapper_footer');
		?>
	</div>
</footer>
</div>
<!-- Close Wrapper -->
<?php
/**
 * @hooked - g5plus_back_to_top - 5
 **/
do_action('g5plus_after_page_wrapper');