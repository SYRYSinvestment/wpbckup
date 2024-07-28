<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property_Search extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property-search';
	}

	public function get_ube_icon()
	{
		return ' eicon-search';
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Search', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'property-search',ERE_PLUGIN_PREFIX . 'property','select2_css');
	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'property-search','select2_js',ERE_PLUGIN_PREFIX . 'search_js', ERE_PLUGIN_PREFIX . 'search_js_map','google-map','markerclusterer');
	}

	protected function register_controls()
	{
		$this->register_search_section_controls();
	}

	public function render()
	{
		gf_get_template_element('property-search/template.php', array(
			'element' => $this
		));
	}
}