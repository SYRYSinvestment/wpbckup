<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Property_Advanced_Search_Page
 */

$wrapper_classes = array(
	'ube-property-advanced-search-page',
);
$element->set_render_attribute('wrapper', array(
	"class" => $wrapper_classes,
));
?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php ere_get_template('property/advanced-search.php'); ?>
</div>



