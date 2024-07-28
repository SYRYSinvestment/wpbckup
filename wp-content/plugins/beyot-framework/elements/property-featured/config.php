<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;

if (!class_exists('GF_Elements_Listing_Property_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-property.class.php');
}

class UBE_Element_Beyot_Property_Featured extends GF_Elements_Listing_Property_Abstract
{
	public function get_name()
	{
		return 'beyot-property-featured';
	}

	public function get_ube_icon()
	{
		return 'eicon-archive';
	}

	public function get_ube_keywords()
	{
		return array('property featured', 'ere', 'essential real estate', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	public function get_title()
	{
		return esc_html__('Beyot Property Featured', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'property-featured', ERE_PLUGIN_PREFIX . 'property');
	}

	public function get_script_depends()
	{
		return array(ERE_PLUGIN_PREFIX . 'owl_carousel', ERE_PLUGIN_PREFIX . 'property_featured', GF_PLUGIN_PREFIX . 'property-featured');
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_image_size_section_controls();
		$this->register_query_section_controls();
		$this->register_include_heading_controls();
		$this->register_style_heading_section_controls();
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__('Layout', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_layout_controls();
		$this->register_scheme_control();
		$this->register_show_heading_control();
		$this->register_post_count_control();

		$this->end_controls_section();
	}

	protected function register_image_size_section_controls()
	{
		$this->start_controls_section(
			'section_image_size',
			[
				'label' => esc_html__('Image Size', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_size1',
			[
				'label' => esc_html__('Image size', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 300x400).', 'beyot-framework'),
				'default' => '240x180',
				'condition' => [
					'post_layout' => ['property-list-two-columns'],
				],
			]
		);

		$this->add_control(
			'image_size2',
			[
				'label' => esc_html__('Image size', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 300x400).', 'beyot-framework'),
				'default' => '835x320',
				'condition' => [
					'post_layout' => ['property-cities-filter'],
				],
			]
		);

		$this->add_control(
			'image_size3',
			[
				'label' => esc_html__('Image size', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 300x400).', 'beyot-framework'),
				'default' => '570x320',
				'condition' => [
					'post_layout' => ['property-single-carousel'],
				],
			]
		);

		$this->add_control(
			'image_size4',
			[
				'label' => esc_html__('Image size', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 300x400).', 'beyot-framework'),
				'default' => '945x605',
				'condition' => [
					'post_layout' => ['property-sync-carousel'],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_scheme_control()
	{
		$this->add_control(
			'color_scheme',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Color Scheme', 'beyot-framework'),
				'options' => array(
					'color-dark' => esc_html__('Dark', 'beyot-framework'),
					'color-light' => esc_html__('Light', 'beyot-framework'),
				),
				'default' => 'color-dark',
			]
		);
	}

	protected function register_layout_controls()
	{
		parent::register_layout_controls();
		$this->update_control('post_layout', [
			'default' => 'property-sync-carousel'
		]);
	}

	protected function register_query_section_controls()
	{
		parent::register_query_section_controls();
		$this->remove_control('property_featured');
	}

	public function get_config_post_layout()
	{
		$config = apply_filters('gf_elementor_property_layout', array(
			'property-list-two-columns' => array(
				'label' => esc_html__('List Two Columns', 'beyot-framework'),
			),
			'property-cities-filter' => array(
				'label' => esc_html__('Cities Filter', 'beyot-framework'),
			),
			'property-single-carousel' => array(
				'label' => esc_html__('Single Carousel', 'beyot-framework'),
			),
			'property-sync-carousel' => array(
				'label' => esc_html__('Sync Carousel', 'beyot-framework'),
			),
		));

		$result = array();
		foreach ($config as $k => $v) {
			$result[$k] = $v['label'];
		}
		return $result;

	}

	public function render()
	{
		gf_get_template_element('property-featured/template.php', array(
			'element' => $this
		));
	}
}