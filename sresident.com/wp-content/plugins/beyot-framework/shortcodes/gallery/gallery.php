<?php
if (!defined('ABSPATH')) {
	die('-1');
}
class WPBakeryShortCode_G5Plus_Gallery extends G5Plus_ShortCode {
	public function __construct($settings) {
		add_filter('g5plus_image_size',array($this,'register_image_size'));

		parent::__construct($settings);
	}

	function register_image_size($image_sizes){
		$sizes = array(
			'gallery-size-sm' => array(
				'width'  => 270,
				'height' => 160
			),
			'gallery-size-md' => array(
				'width'  => 430,
				'height' => 430
			)
		);
		return array_merge($image_sizes,$sizes);
	}
}