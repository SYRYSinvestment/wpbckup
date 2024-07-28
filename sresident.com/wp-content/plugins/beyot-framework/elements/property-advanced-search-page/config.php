<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

class UBE_Element_Beyot_Property_Advanced_Search_Page extends UBE_Abstracts_Elements
{
	public function get_name()
	{
		return 'beyot-property-advanced-search-page';
	}

	public function get_ube_icon()
	{
		return 'eicon-search';
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Advanced Search Page', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'archive-property');
	}

	public function get_script_depends()
	{
		return array('select2_js');
	}

	protected function register_controls() {}

	public function render()
	{
		gf_get_template_element('property-advanced-search-page/template.php', array(
			'element' => $this
		));
	}
}