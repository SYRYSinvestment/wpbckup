<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;

class UBE_Element_Beyot_Process extends UBE_Abstracts_Elements_Grid
{
	public function get_name()
	{
		return 'beyot-process';
	}

	public function get_ube_icon()
	{
		return 'eicon-navigator';
	}

	public function get_title()
	{
		return esc_html__('Beyot Process', 'beyot-framework');
	}

	public function get_ube_keywords()
	{
		return array('process', 'ube', 'g5');
	}

	public function get_script_depends() {
		return array( 'slick', 'ube-widget-slider',GF_PLUGIN_PREFIX . 'process');
	}

	public function get_style_depends()
	{
		return array('slick',GF_PLUGIN_PREFIX . 'process');
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_style_number_section_controls();
		$this->register_style_title_section_controls();
		$this->register_style_desc_section_controls();
		$this->register_items_section_controls();
		$this->register_grid_section_controls(['layout!' => 'slider']);
		$this->register_slider_section_controls([
			'name'     => 'layout',
			'operator' => '=',
			'value'    => 'slider'
		]);
	}

	public function render()
	{
		$settings = $this->get_settings_for_display();
		$wrapper_class  = 'ube-process';
		$layout = isset($settings['layout']) ? $settings['layout'] : '';
		if ($layout === 'slider') {
			$this->print_slider( $settings,$wrapper_class );
		}  else {
			$this->print_grid( $settings, $wrapper_class );
		}
	}

	protected function register_items_section_controls() {
		parent::register_items_section_controls();
		$this->update_control('items',[
			'title_field' => '{{ title }}'
		]);
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

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'beyot-framework'),
				'type' => Controls_Manager::SELECT,
				'default' => 'grid',
				'options'     => [
					'grid' => esc_html__( 'Grid', 'beyot-framework' ),
					'slider'    => esc_html__( 'Slider', 'beyot-framework' ),
				],
			]
		);


		$this->end_controls_section();
	}

	protected function register_grid_section_controls($condition = [] ) {
		parent::register_grid_section_controls($condition);
		parent::register_grid_item_style_section_controls($condition);
	}

	protected function register_slider_section_controls($condition = []) {
		parent::register_slider_section_controls($condition);
		parent::register_slider_item_style_section_controls($condition);
		$this->remove_control('slider_type');
		$this->update_control('fade_enabled',[
			'conditions'   => [
				'terms' => [
					[
						'name'     => 'slides_to_show',
						'operator' => '==',
						'value'    => '1',
					],
				],
			],
		]);
	}

	protected function add_repeater_controls(\Elementor\Repeater $repeater)
	{
		$repeater->add_control(
			'number',
			[
				'label' => esc_html__('Step Number', 'beyot-framework'),
				'type' => Controls_Manager::NUMBER,
				'placeholder' => esc_html__('Enter Number', 'beyot-framework'),
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Title', 'beyot-framework'),
			]
		);

		$repeater->add_control(
			'desc',
			[
				'label' => esc_html__('Description', 'beyot-framework'),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__('Enter Description', 'beyot-framework'),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'beyot-framework'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('Enter Link', 'beyot-framework'),
			]
		);

	}


	protected function get_repeater_defaults()
	{
		return [
			[
				'number' => '1',
				'title' => 'Start',
			],
		];
	}

	protected function print_grid_item() {
		$item          = $this->get_current_item();
		$item_key      =    $this->get_current_item_key();

		$number              = isset( $item['number'] ) ? $item['number'] : '';
		$link              = isset( $item['link'] ) ? $item['link'] : array();
		$title             = isset( $item['title'] ) ? $item['title'] : '';
		$desc             = isset( $item['desc'] ) ? $item['desc'] : '';

		gf_get_template_element('process/template.php', array(
			'number'       => $number,
			'link'      => $link,
			'title'       => $title,
			'desc'    => $desc,
			'item_key' =>  $item_key,
			'element'    => $this,
		));

	}

	protected function register_style_number_section_controls()
	{
		$this->start_controls_section(
			'section_design_number',
			[
				'label' => esc_html__('Step Number', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} span',
			]
		);


		$this->start_controls_tabs('number_tabs');

		$this->start_controls_tab('number_tab_normal',
			[
				'label' => esc_html__('Normal', 'beyot-framework'),
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(Group_Control_Background::get_type(), [
			'name' => 'number_bg',
			'selector' => '{{WRAPPER}} span',
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('number_tab_hover',
			[
				'label' => esc_html__('Hover', 'beyot-framework'),
			]
		);


		$this->add_control(
			'number_color_hover',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .g5plus-process:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(Group_Control_Background::get_type(), [
			'name' => 'number_bg_hover',
			'selector' => '{{WRAPPER}} .g5plus-process:hover span',
		]);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_title_section_controls()
	{
		$this->start_controls_section(
			'section_design_title',
			[
				'label' => esc_html__('title', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} h2',
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
					'{{WRAPPER}} h2' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();
	}

	protected function register_style_desc_section_controls()
	{
		$this->start_controls_section(
			'section_design_description',
			[
				'label' => esc_html__('Description', 'beyot-framework'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .process-desc',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'beyot-framework'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .process-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'description_spacing',
			[
				'label' => esc_html__('Spacing', 'beyot-framework'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .process-desc' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}
}