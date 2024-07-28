<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2016
 * Time: 11:00 AM
 */
if (!class_exists('G5plus_FrameWork_ShortCodes_Auto_Complete')) {
	class G5plus_FrameWork_ShortCodes_Auto_Complete{
		public function __construct() {
			add_action( 'vc_after_mapping', array($this,'define_filter') );
		}

		public function define_filter(){
			// menu_food
			add_filter( 'vc_autocomplete_g5plus_menu_food_names_callback', array( $this, 'menuFoodSlugAutocompleteSuggester' ), 10, 1 );
			add_filter( 'vc_autocomplete_g5plus_menu_food_names_render', array( &$this, 'menuFoodSlugAutocompleteRender', ), 10, 1 ); // Render exact product. Must return an array (label,value)
		}

		public function menuFoodSlugAutocompleteSuggester($query){
			global $wpdb;
			$post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.ID as ID, a.post_title AS title, a.post_name AS slug
			FROM {$wpdb->posts} as a
			WHERE (a.post_type = 'menu-food')
			AND (a.post_status = 'publish')
			AND (a.post_title LIKE '%%%s%%')",stripslashes( $query )),ARRAY_A);
			$results = array();
			if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
				foreach ( $post_meta_infos as $value ) {
					$data = array();
					$data['value'] = $value['slug'];
					$data['label'] = ( strlen( $value['title'] ) > 0 ) ? $value['title'] : '' ;
					$results[] = $data;
				}
			}
			return $results;
		}

		public function menuFoodSlugAutocompleteRender( $query ) {
			$query = trim( $query['value'] ); // get value from requested
			if ( ! empty( $query ) ) {
				$menu_food_id = gf_get_menu_food_id_by_slug($query);

				// get menu food
				$menu_food_object = get_post($menu_food_id);
				if ( is_object( $menu_food_object ) ) {
					$menu_food_title = $menu_food_object->post_title;
					$menu_food_title_display = '';
					if ( ! empty( $menu_food_title ) ) {
						$menu_food_title_display = $menu_food_title;
					}
					$data = array();
					$data['value'] = $query;
					$data['label'] = $menu_food_title_display;
					return ! empty( $data ) ? $data : false;
				}
				return false;
			}
			return false;
		}
	}
	new G5plus_FrameWork_ShortCodes_Auto_Complete();
}