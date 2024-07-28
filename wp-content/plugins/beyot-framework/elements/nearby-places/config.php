<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

class UBE_Element_Beyot_Nearby_Places extends UBE_Abstracts_Elements
{
	public function get_name()
	{
		return 'beyot-nearby-places';
	}

	public function get_ube_icon()
	{
		return 'eicon-map-pin';
	}

	public function get_title()
	{
		return esc_html__('Beyot Nearby Places', 'beyot-framework');
	}

	public function get_style_depends()
	{
		return array( GF_PLUGIN_PREFIX . 'nearby_places');
	}

	public function get_script_depends() {
		return array(GF_PLUGIN_PREFIX . 'nearby_places','google-map', GF_PLUGIN_PREFIX . 'nearby-places');
	}

	protected function register_controls()
	{
		$this->start_controls_section('setting_section', [
			'label' => esc_html__('Setting', 'beyot-framework'),
			'tab' => Controls_Manager::TAB_CONTENT,
		]);

		$this->add_control(
			'lat',
			[
				'label' => esc_html__('Latitude', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Latitude', 'beyot-framework'),
			]
		);

		$this->add_control(
			'lng',
			[
				'label' => esc_html__('Longitude', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Longitude', 'beyot-framework'),
			]
		);

		$this->add_control(
			'nearby_places_rank_by',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Rank by', 'beyot-framework'),
				'options' => array(
					'default' => esc_html__('Prominence', 'beyot-framework'),
					'distance' => esc_html__('Enable', 'beyot-framework'),
				),
				'default' => 'default',
			]
		);

		$this->add_control(
			'nearby_places_radius',
			[
				'label' => esc_html__('Radius', 'beyot-framework'),
				'type' => Controls_Manager::NUMBER,
				'default' => '5000',
				'condition' => [
					'nearby_places_rank_by' => 'default',
				],
			]
		);

		$this->add_control(
			'nearby_places_distance_in',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Near by places distance in', 'beyot-framework'),
				'options' => array(
					'm' => esc_html__('Meter', 'beyot-framework'),
					'km' => esc_html__('Km', 'beyot-framework'),
					'mi' => esc_html__('Mile', 'beyot-framework'),
				),
				'default' => 'km',
			]
		);

		$this->add_control(
			'set_map_height',
			[
				'label' => esc_html__('Set Map Height', 'beyot-framework'),
				'type' => Controls_Manager::NUMBER,
				'default' => '475',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'nearby_places_select_field_type',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__('Type Place', 'beyot-framework'),
				'options' => array(
					'accounting' => esc_html__('Accounting', 'beyot-framework'),
					'airport' => esc_html__('Airport', 'beyot-framework'),
					'amusement_park' => esc_html__('Amusement Park', 'beyot-framework'),
					'aquarium' => esc_html__('Aquarium', 'beyot-framework'),
					'atm' => esc_html__('Atm', 'beyot-framework'),
					'bakery' => esc_html__('Bakery', 'beyot-framework'),
					'bank' => esc_html__('Bank', 'beyot-framework'),
					'bar' => esc_html__('Bar', 'beyot-framework'),
					'beauty_salon' => esc_html__('Beauty Salon', 'beyot-framework'),
					'bicycle_store' => esc_html__('Bicycle Store', 'beyot-framework'),
					'book_store' => esc_html__('Book Store', 'beyot-framework'),
					'bowling_alley' => esc_html__('Bowling Alley', 'beyot-framework'),
					'bus_station' => esc_html__('Bus Station', 'beyot-framework'),
					'cafe' => esc_html__('Cafe', 'beyot-framework'),
					'campground' => esc_html__('Campground', 'beyot-framework'),
					'car_rental' => esc_html__('Car Rental', 'beyot-framework'),
					'car_repair' => esc_html__('Car Repair', 'beyot-framework'),
					'car_wash' => esc_html__('Car Wash', 'beyot-framework'),
					'casino' => esc_html__('Casino', 'beyot-framework'),
					'cemetery' => esc_html__('Cemetery', 'beyot-framework'),
					'church' => esc_html__('Church', 'beyot-framework'),
					'city_hall' => esc_html__('City Center', 'beyot-framework'),
					'clothing_store' => esc_html__('Clothing Store', 'beyot-framework'),
					'convenience_store' => esc_html__('Convenience Store', 'beyot-framework'),
					'courthouse' => esc_html__('Courthouse', 'beyot-framework'),
					'dentist' => esc_html__('Dentist', 'beyot-framework'),
					'department_store' => esc_html__('Department Store', 'beyot-framework'),
					'doctor' => esc_html__('Doctor', 'beyot-framework'),
					'electrician' => esc_html__('Electrician', 'beyot-framework'),
					'electronics_store' => esc_html__('Electronics Store', 'beyot-framework'),
					'embassy' => esc_html__('Embassy', 'beyot-framework'),
					'establishment' => esc_html__('Establishment', 'beyot-framework'),
					'finance' => esc_html__('Finance', 'beyot-framework'),
					'fire_station' => esc_html__('Fire Station', 'beyot-framework'),
					'florist' => esc_html__('Florist', 'beyot-framework'),
					'food' => esc_html__('Food', 'beyot-framework'),
					'gas_station' => esc_html__('Gas Station', 'beyot-framework'),
					'grocery_or_supermarket' => esc_html__('Grocery', 'beyot-framework'),
					'gym' => esc_html__('Gym', 'beyot-framework'),
					'hair_care' => esc_html__('Hair Care', 'beyot-framework'),
					'hardware_store' => esc_html__('Hardware Store', 'beyot-framework'),
					'health' => esc_html__('Health', 'beyot-framework'),
					'home_goods_store' => esc_html__('Home Goods Store', 'beyot-framework'),
					'hospital' => esc_html__('Hospital', 'beyot-framework'),
					'jewelry_store' => esc_html__('Jewelry Store', 'beyot-framework'),
					'laundry' => esc_html__('Laundry', 'beyot-framework'),
					'lawyer' => esc_html__('Lawyer', 'beyot-framework'),
					'library' => esc_html__('Library', 'beyot-framework'),
					'lodging' => esc_html__('Lodging', 'beyot-framework'),
					'movie_theater' => esc_html__('Movie Theater', 'beyot-framework'),
					'moving_company' => esc_html__('Moving Company', 'beyot-framework'),
					'night_club' => esc_html__('Night Club', 'beyot-framework'),
					'park' => esc_html__('Park', 'beyot-framework'),
					'pharmacy' => esc_html__('Pharmacy', 'beyot-framework'),
					'place_of_worship' => esc_html__('Place Of Worship', 'beyot-framework'),
					'plumber' => esc_html__('Plumber', 'beyot-framework'),
					'police' => esc_html__('Police', 'beyot-framework'),
					'post_office' => esc_html__('Post Office', 'beyot-framework'),
					'restaurant' => esc_html__('Restaurant', 'beyot-framework'),
					'school' => esc_html__('School', 'beyot-framework'),
					'shopping_mall' => esc_html__('Shopping Mall', 'beyot-framework'),
					'spa' => esc_html__('Spa', 'beyot-framework'),
					'stadium' => esc_html__('Stadium', 'beyot-framework'),
					'storage' => esc_html__('Storage', 'beyot-framework'),
					'store' => esc_html__('Store', 'beyot-framework'),
					'subway_station' => esc_html__('Subway Station', 'beyot-framework'),
					'synagogue' => esc_html__('Synagogue', 'beyot-framework'),
					'taxi_stand' => esc_html__('Taxi Stand', 'beyot-framework'),
					'train_station' => esc_html__('Train Station', 'beyot-framework'),
					'travel_agency' => esc_html__('Travel Agency', 'beyot-framework'),
					'university' => esc_html__('University', 'beyot-framework'),
					'veterinary_care' => esc_html__('Veterinary Care', 'beyot-framework'),
					'zoo' => esc_html__('Zoo', 'beyot-framework'),
				),
				'default' => 'school',
			]
		);

		$repeater->add_control(
			'nearby_places_field_label',
			[
				'label' => esc_html__('Label Place', 'beyot-framework'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('School', 'beyot-framework'),
			]
		);


		$repeater->add_control(
			'nearby_places_field_icon',
			[
				'label' => esc_html__('Image Icon Place:', 'beyot-framework'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'nearby_places_fields',
			[
				'label'   => '',
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'nearby_places_select_field_type'   => esc_html__('school', 'beyot-framework'),
						'nearby_places_field_label' => esc_html__('School', 'beyot-framework'),
					],
				],
				'title_field' => '{{{ nearby_places_field_label }}}',
			]
		);

		$this->end_controls_section();
	}

	public function render()
	{
		gf_get_template_element('nearby-places/template.php', array(
			'element' => $this
		));
	}
}