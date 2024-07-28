<?php
function gf_lean_map() {
	$lean_maps = array(
		'g5plus_blog',
		'g5plus_button',
		'g5plus_counter',
		'g5plus_google_map',
		'g5plus_heading',
		'g5plus_space',
		'g5plus_testimonials',
		'g5plus_video',
		'g5plus_process',
		'g5plus_icon_box',
		'g5plus_countdown',
		'g5plus_clients',
		'g5plus_pricing',
		'g5plus_nearby_places',
		'g5plus_text_info',
		'g5plus_property_info',
		'g5plus_agent_info',
		'g5plus_gallery'
	);
	foreach ($lean_maps as $key){
		$directory = preg_replace('/^g5plus_/', '', $key);
		vc_lean_map( $key, null, GF_PLUGIN_DIR . 'shortcodes/' . str_replace('_', '-', $directory) . '/config.php' );
	}
}
add_action('vc_before_mapping', 'gf_lean_map');