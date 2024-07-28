<?php
// Do not allow directly accessing this file.
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

if (!class_exists('GF_Elements_Listing_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing.class.php');
}

abstract class GF_Elements_Listing_Property_Abstract extends GF_Elements_Listing_Abstract
{
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
		$this->register_columns_gutter_controls(array('post_layout' => ['property-grid', 'property-carousel']));
		$this->register_show_heading_control();
		$this->register_post_paging_controls();
		$this->register_post_count_control();
		$this->register_post_view_all_link_controls();

		$this->end_controls_section();
	}

	protected function register_query_section_controls()
	{
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__('Query', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_property_featured_controls();
		$this->register_property_type_controls();
		$this->register_property_status_controls();
		$this->register_property_feature_controls();
		$this->register_property_city_controls();
		$this->register_property_state_controls();
		$this->register_property_neighborhood_controls();
		$this->register_property_label_controls();

		$this->end_controls_section();
	}

	protected function register_search_section_controls()
	{
		$this->start_controls_section(
			'section_search',
			[
				'label' => esc_html__('Property Search', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_layout_search_controls();
		$this->register_property_search_show_controls();
		$this->register_search_show_map_controls();
		$this->register_color_scheme_controls();

		$this->end_controls_section();
	}

	protected function register_layout_search_controls()
	{
		$this->add_control(
			'search_styles',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Search Form Style', 'beyot-framework'),
				'description' => esc_html__('Select one in styles below for search form. Almost, you should use layout full-width for search form to can display it best', 'beyot-framework'),
				'options' => $this->get_config_property_search_layout(),
				'default' => 'style-default',
			]
		);
	}

	public function get_config_property_search_layout()
	{
		$config = apply_filters('beyot_elementor_property_search__layout', array(
			'style-default' => array(
				'label' => esc_html__('Form Default', 'beyot-framework'),
				'priority' => 10,
			),
			'style-default-small' => array(
				'label' => esc_html__('Form Default Small', 'beyot-framework'),
				'priority' => 20,
			),
			'style-mini-line' => array(
				'label' => esc_html__('Mini Inline', 'beyot-framework'),
				'priority' => 30,
			),
			'style-absolute' => array(
				'label' => esc_html__('Form Absolute Map', 'beyot-framework'),
				'priority' => 40,
			),
			'style-vertical' => array(
				'label' => esc_html__('Map Vertical', 'beyot-framework'),
				'priority' => 50,
			),
		));
		$result = array();
		foreach ($config as $k => $v) {
			$result[$k] = $v['label'];
		}
		return $result;
	}

	protected function register_property_search_show_controls()
	{
		$this->add_control(
			'show_status_tab',
			[
				'label' => esc_html__('Show status tab', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'description' => esc_html__('Select property status field like tab', 'beyot-framework'),
				'default' => 'true',
				'condition' => [
					'search_styles!' => 'style-mini-line',
				],
			]
		);

		$this->add_control(
			'status_enable',
			[
				'label' => esc_html__('Status', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
			'type_enable',
			[
				'label' => esc_html__('Type', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
			'title_enable',
			[
				'label' => esc_html__('Title', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
			'address_enable',
			[
				'label' => esc_html__('Address', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
			'keyword_enable',
			[
				'label' => esc_html__('Keyword', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'country_enable',
			[
				'label' => esc_html__('Country', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'state_enable',
			[
				'label' => esc_html__('Province / State', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'city_enable',
			[
				'label' => esc_html__('City / Town', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'neighborhood_enable',
			[
				'label' => esc_html__('Neighborhood', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);
		$this->add_control(
			'rooms_enable',
			[
				'label' => esc_html__('Rooms', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'bedrooms_enable',
			[
				'label' => esc_html__('Bedrooms', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'bathrooms_enable',
			[
				'label' => esc_html__('Bathrooms', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'price_enable',
			[
				'label' => esc_html__('Price', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
			'price_is_slider',
			[
				'label' => esc_html__('Show Slider for Price?', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
				'condition' => [
					'price_enable' => 'true',
				],
			]
		);

		$this->add_control(
			'area_enable',
			[
				'label' => esc_html__('Size', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'area_is_slider',
			[
				'label' => esc_html__('Show Slider for Size?', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
				'condition' => [
					'area_enable' => 'true',
				],
			]
		);

		$this->add_control(
			'land_area_enable',
			[
				'label' => esc_html__('Land Area', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'land_area_is_slider',
			[
				'label' => esc_html__('Show Slider for Land Area?', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
				'condition' => [
					'land_area_enable' => 'true',
				],
			]
		);

		$this->add_control(
			'label_enable',
			[
				'label' => esc_html__('Label', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'garage_enable',
			[
				'label' => esc_html__('Garage', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'property_identity_enable',
			[
				'label' => esc_html__('Property ID', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->add_control(
			'other_features_enable',
			[
				'label' => esc_html__('Other Features', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);

		$this->register_map_add_additions_search_form_fields();
	}

	protected function register_map_add_additions_search_form_fields()
	{
		$additional_fields = ere_get_search_additional_fields();
		foreach ($additional_fields as $k => $v) {
			$this->add_control(
				"{$k}_enable",
				[
					'label' => $v,
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Show', 'beyot-framework'),
					'label_off' => esc_html__('Hide', 'beyot-framework'),
					'return_value' => 'true',
					'default' => '',
				]
			);
		}
	}

	protected function register_search_show_button_controls()
	{
		$this->add_control(
			'show_advanced_search_btn',
			[
				'label' => esc_html__('Show Advanced Search Button', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
	}

	protected function register_search_show_map_controls()
	{
		$this->add_control(
			'map_search_enable',
			[
				'label' => esc_html__('Map Search  Enable', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'beyot-framework'),
				'label_off' => esc_html__('Hide', 'beyot-framework'),
				'return_value' => 'true',
				'description' => esc_html__('Show map and search properties with form and show result by map', 'beyot-framework'),
				'default' => '',
				'condition' => [
					'search_styles' => array('style-mini-line', 'style-default', 'style-default-small'),
				],
			]
		);
	}

	protected function register_color_scheme_controls()
	{
		$this->add_control(
			'color_scheme',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Color Scheme', 'beyot-framework'),
				'description' => esc_html__('Select color scheme for form search', 'beyot-framework'),
				'options' => array(
					'color-dark' => esc_html__('Dark', 'beyot-framework'),
					'color-light' => esc_html__('Light', 'beyot-framework'),
				),
				'default' => 'color-light',
			]
		);
	}

	protected function register_move_nav_control($condition)
	{
		$this->add_control('move_nav',
			[
				'label' => esc_html__('Move Navigation Par With Top title', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'beyot-framework'),
				'label_off' => esc_html__('Disable', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'post_layout',
							'operator' => 'in',
							'value' => $condition['post_layout']
						],
						[
							'name' => 'nav',
							'operator' => '=',
							'value' => 'true'
						],
					]
				],
			]);
	}

	protected function register_nav_property_position_control($condition)
	{
		$this->add_control(
			'nav_position',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Navigation Position', 'beyot-framework'),
				'options' => $this->get_nav_position(),
				'default' => '',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'post_layout',
							'operator' => 'in',
							'value' => $condition['post_layout']
						],
						[
							'name' => 'nav',
							'operator' => '=',
							'value' => 'true'
						],
						[
							'name' => 'move_nav',
							'operator' => '=',
							'value' => ''
						]
					]
				],
			]
		);
	}

	protected function register_property_type_controls()
	{
		$this->add_control(
			'property_type',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-type'
				),
				'label' => esc_html__('Narrow Property Type', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter property type by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_property_status_controls()
	{
		$this->add_control(
			'property_status',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-status'
				),
				'label' => esc_html__('Narrow Property Status', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter property status by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_property_feature_controls()
	{
		$this->add_control(
			'property_feature',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-feature'
				),
				'label' => esc_html__('Narrow Property Feature', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter property feature by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_property_label_controls()
	{
		$this->add_control(
			'property_label',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-label'
				),
				'label' => esc_html__('Narrow Property Label', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter property label by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_property_state_controls()
	{
		$this->add_control(
			'property_state',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-state'
				),
				'label' => esc_html__('Narrow Province / State', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter province / state by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_property_city_controls()
	{
		$this->add_control(
			'property_city',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-city'
				),
				'label' => esc_html__('Narrow City', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter city by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_property_neighborhood_controls()
	{
		$this->add_control(
			'property_neighborhood',
			[
				'type' => UBE_Controls_Manager::AUTOCOMPLETE,
				'multiple' => true,
				'select_type' => 'term',
				'data_args' => array(
					'taxonomy' => 'property-neighborhood'
				),
				'label' => esc_html__('Narrow Neighborhood', 'beyot-framework'),
				'label_block' => true,
				'description' => esc_html__('Enter neighborhood by names to narrow output.', 'beyot-framework'),
				'default' => '',
			]
		);
	}

	protected function register_property_featured_controls()
	{
		$this->add_control(
			'property_featured',
			[
				'label' => esc_html__('Property Featured', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'beyot-framework'),
				'label_off' => esc_html__('Disable', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
			]
		);
	}

	protected function register_post_paging_controls()
	{
		$this->add_control(
			'post_paging',
			[
				'label' => esc_html__('Post Paging', 'beyot-framework'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Enable', 'beyot-framework'),
				'label_off' => esc_html__('Disable', 'beyot-framework'),
				'return_value' => 'true',
				'default' => '',
				'condition' => [
					'post_layout!' => 'property-carousel',
				],
			]
		);
	}

	protected function register_post_view_all_link_controls()
	{
		$this->add_control(
			'view_all_link',
			[
				'label' => esc_html__('View All Link', 'beyot-framework'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('Enter Link', 'beyot-framework'),
			]
		);
	}

	protected function register_columns_responsive_section_controls($condition)
	{
		parent::register_columns_responsive_section_controls($condition);
		$this->update_control('columns', [
			'mobile_breakpoint' => '479'
		]);
	}

	protected function register_style_title_section_controls()
	{
		$this->start_controls_section(
			'section_design_title',
			[
				'label' => esc_html__('Title', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .property-item-content .property-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .property-item-content .property-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs('title_color_tabs');

		$this->start_controls_tab('title_color_normal',
			[
				'label' => esc_html__('Normal', 'beyot-framework'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .property-item-content .property-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('title_color_hover',
			[
				'label' => esc_html__('Hover', 'beyot-framework'),
			]
		);


		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .property-item-content .property-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_price_section_controls()
	{
		$this->start_controls_section(
			'section_design_price',
			[
				'label' => esc_html__('Price', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .property-item-content .property-price',
			]
		);

		$this->add_control(
			'price_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .property-item-content .property-price' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .property-item-content .property-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_prefix_color',
			[
				'label' => esc_html__('Color Prefix', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .property-item-content .property-price-postfix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_excerpt_section_controls()
	{
		$this->start_controls_section(
			'section_design_excerpt',
			[
				'label' => esc_html__('Excerpt', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .property-excerpt',
			]
		);

		$this->add_control(
			'excerpt_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .property-excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .property-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_meta_section_controls()
	{
		$this->start_controls_section(
			'section_design_meta',
			[
				'label' => esc_html__('Meta', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .property-location a,{{WRAPPER}} .property-element-inline a',
			]
		);

		$this->add_control(
			'meta_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .property-location' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->start_controls_tabs('meta_color_tabs');

		$this->start_controls_tab('meta_color_normal',
			[
				'label' => esc_html__('Normal', 'beyot-framework'),
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .property-location a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .property-element-inline a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('meta_color_hover',
			[
				'label' => esc_html__('Hover', 'beyot-framework'),
			]
		);


		$this->add_control(
			'meta_hover_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .property-location a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .property-element-inline a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_image_size_section_controls()
	{
		parent::register_image_size_section_controls();
		$this->update_control('image_size', [
			'default' => '330x180',
		]);
	}

	public function get_config_post_layout()
	{
		$config = apply_filters('gf_elementor_property_layout', array(
			'property-grid' => array(
				'label' => esc_html__('Grid', 'beyot-framework'),
			),
			'property-list' => array(
				'label' => esc_html__('List', 'beyot-framework'),
			),
			'property-zigzac' => array(
				'label' => esc_html__('Zigzac', 'beyot-framework'),
			),
			'property-carousel' => array(
				'label' => esc_html__('Carousel', 'beyot-framework'),
			),
		));

		$result = array();
		foreach ($config as $k => $v) {
			$result[$k] = $v['label'];
		}
		return $result;

	}

	public function get_nav_position()
	{
		return apply_filters('gf_elementor_nav_position', array(
			'' => esc_html__('Middle Center', 'beyot-framework'),
			'top-right' => esc_html__('Top Right', 'beyot-framework'),
			'bottom-center' => esc_html__('Bottom Center', 'beyot-framework'),
		));
	}

	public function get_ere_columns($columns = array())
	{
		$config = array();
		$default = array(
			'xl' => '3',
			'lg' => '2',
			'md' => '2',
			'sm' => '1',
			'xs' => '1',
		);
		$columns = wp_parse_args($columns, $default);
		$config['columns'] = absint($columns['xl']);
		$config['items_md'] = $columns['lg'] == '' ? $config['columns'] : absint($columns['lg']);
		$config['items_sm'] = $columns['md'] == '' ? $config['items_md'] : absint($columns['md']);
		$config['items_xs'] = $columns['sm'] == '' ? $config['items_sm'] : absint($columns['sm']);
		$config['items_mb'] = $columns['xs'] == '' ? $config['items_xs'] : absint($columns['xs']);
		return $config;

	}
}