  <?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Property_Search
 */
$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-search-properties',
);
$element->set_render_attribute('wrapper', array(
	"class" => $wrapper_classes,
));
$additional_fields = ere_get_search_additional_fields();
$config = array(
	'search_styles' => $atts['search_styles'],
	'show_status_tab' => $atts['show_status_tab'],
	'status_enable' => $atts['status_enable'],
	'type_enable' => $atts['type_enable'],
	'title_enable' => $atts['title_enable'],
	'address_enable' => $atts['address_enable'],
	'keyword_enable' => $atts['keyword_enable'],
	'country_enable' => $atts['country_enable'],
	'state_enable' => $atts['state_enable'],
	'city_enable' => $atts['city_enable'],
	'neighborhood_enable' => $atts['neighborhood_enable'],
	'rooms_enable' => $atts['rooms_enable'],
	'bedrooms_enable' => $atts['bedrooms_enable'],
	'bathrooms_enable' => $atts['bathrooms_enable'],
	'price_enable' => $atts['price_enable'],
	'price_is_slider' => $atts['price_is_slider'],
	'area_enable' => $atts['area_enable'],
	'area_is_slider' => $atts['area_is_slider'],
	'land_area_enable' => $atts['land_area_enable'],
	'land_area_is_slider' => $atts['land_area_is_slider'],
	'label_enable' => $atts['label_enable'],
	'garage_enable' => $atts['garage_enable'],
	'property_identity_enable' => $atts['property_identity_enable'],
	'other_features_enable' => $atts['other_features_enable'],
	'map_search_enable' => $atts['map_search_enable'],
	'color_scheme' => $atts['color_scheme'],
);
foreach ( $additional_fields as $k => $v)  {
  if($atts["{$k}_enable"] !== '') {
	  $atts["{$k}_enable"] = 'true';
  }
  $config["{$k}_enable"] = $atts["{$k}_enable"];
}

?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php ere_get_template('shortcodes/property-search/property-search.php', array('atts' => $config)); ?>
</div>



