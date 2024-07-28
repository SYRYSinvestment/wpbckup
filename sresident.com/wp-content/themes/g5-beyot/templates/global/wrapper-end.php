<?php
$preset_id = g5plus_get_current_preset();

if (!$preset_id && is_404()) {
	return;
}
/**
 * The template used for displaying wrapper end
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$page_layouts = &g5plus_get_page_layout_settings();
?>
</div><!-- End Layout Inner -->
<?php get_sidebar(); ?>
<?php if (($page_layouts['has_sidebar']) && ($page_layouts['layout'] != 'full')): ?>
	</div><!-- End Row -->
<?php endif; ?>
<?php if ($page_layouts['layout'] != 'full'): ?>
	</div><!-- End Container -->
<?php endif;?>
</div><!--End Main -->
