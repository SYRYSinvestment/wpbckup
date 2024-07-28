<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if (!class_exists('GF_Elements_Listing_Blog_Abstract', false)) {
	GSF()->loadFile(GF_PLUGIN_DIR . 'inc/abstracts/elementor-listing-blog.class.php');
}

class UBE_Element_Beyot_Posts extends GF_Elements_Listing_Blog_Abstract
{
	public function get_name()
	{
		return 'beyot-posts';
	}

	public function get_ube_icon()
	{
		return 'eicon-posts-grid';
	}

	public function get_title()
	{
		return esc_html__('Beyot Posts', 'beyot-framework');
	}

	public function get_script_depends()
	{
		return array(GF_PLUGIN_PREFIX . 'post');
	}

	public function get_ube_keywords()
	{
		return array('posts','blog', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type', 'ube', 'g5');
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_query_section_controls();
		$this->register_columns_responsive_section_controls(array('post_layout' => ['masonry', 'grid']));
		$this->register_style_section_controls();
	}

	public function render()
	{
		gf_get_template_element('posts/template.php', array(
			'element' => $this
		));
	}
}