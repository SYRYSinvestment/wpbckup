<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * @hooked - g5plus_site_loading - 5
 **/
do_action('g5plus_before_page_wrapper');
?>
	<!-- Open Wrapper -->
	<div id="wrapper">

<?php
/**
 * @hooked - g5plus_before_page_wrapper_content - 10
 * @hooked - g5plus_page_header - 15
 **/
do_action('g5plus_before_page_wrapper_content');
?>

	<!-- Open Wrapper Content -->
	<div id="wrapper-content" class="clearfix ">
<?php
/**
 *
 * @hooked - g5plus_output_content_wrapper - 1
 **/
do_action('g5plus_main_wrapper_content_start');
?>