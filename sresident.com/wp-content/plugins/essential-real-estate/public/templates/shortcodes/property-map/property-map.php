<?php
/**
 * Shortcode attributes
 * @var $atts
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$map_style = $icon = $property_id = $lat = $lng = $map_height = $el_class = '';
extract(shortcode_atts(array(
    'map_style'   => 'property',
    'icon'        => '',
    'property_id' => '',
    'lat'         => '',
    'lng'         => '',
    'map_height'  => '500px',
    'el_class'    => ''
), $atts));

$wrapper_styles = array();
if ($map_height != '') {
    $wrapper_styles['style'] = "height: {$map_height};";
}

$min_suffix = ere_get_option('enable_min_css', 0) == 1 ? '.min' : '';
wp_enqueue_style( ERE_PLUGIN_PREFIX . 'google-map-property');

$google_map_style = ere_get_option('googlemap_style', '');
$googlemap_zoom_level = ere_get_option('googlemap_zoom_level', '12');
wp_enqueue_script('google-map');

//wp_enqueue_script('infobox');
/*Set variable javascript property*/
wp_localize_script(ERE_PLUGIN_PREFIX . 'main', 'ere_property_map_vars',
    array(
        'google_map_style' => $google_map_style
    )
);
$title = $icon_url = $img_src = $property_address = $link = $share_social = '';
$icon = isset($icon) ? $icon : '';
$width=$height=100;
$html_content='';
if ($map_style == 'property') {
    $lat = $lng = '';
    $property_id = isset($property_id) ? $property_id : '';
    if (!empty($property_id)) {
        $attach_id = get_post_thumbnail_id($property_id);
        $img_src = ere_image_resize_id($attach_id, $width, $height, true);
        $title = get_the_title($property_id);
        $link = get_the_permalink($property_id);
        $share_social = '';
        $location = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_location', true);
        if (!empty($location) && !empty($location['location'])) {
            list($lat, $lng) = explode(',', $location['location']);
        }
        $property_address = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_address', true);
        if (empty($icon)) {
            $property_type = get_the_terms($property_id, 'property-type');
            if ($property_type) {
                $property_type_id = $property_type[0]->term_id;
                $property_type_icon = get_term_meta($property_type_id, 'property_type_icon', true);
                if (is_array($property_type_icon) && count($property_type_icon) > 0) {
                    $icon = $property_type_icon['id'];
                }
            }
        }
        ob_start();?>
        <div class = "marker-content">
            <div class = "marker-content-item">
                <?php if($img_src != '') :?>
                    <div class = "item-thumb"><a href="<?php echo esc_url($link) ?>"><img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($img_src) ?>" alt="<?php echo esc_attr($title) ?>"></a></div>
                <?php endif;?>
                <div class="item-body"><a href="<?php echo esc_url($link) ?>" class="title-marker"><?php echo esc_attr($title) ?></a>
	                <div class="price-marker"><?php ere_template_loop_property_price($property_id); ?></div>
                    <div class="address-marker" title="<?php echo esc_attr($property_address) ?>"><i class="fa fa-map-marker"></i><?php echo esc_html($property_address) ?></div>
                </div>
            </div>
        </div>
        <?php
        $html_content= ob_get_clean();
        $html_content = str_replace(PHP_EOL, ' ', $html_content);
        $html_content = preg_replace('/[\r\n]+/', "\n", $html_content);
        $html_content = preg_replace('/[ \t]+/', ' ', $html_content);
        $html_content = preg_replace('/\s+/', ' ', $html_content);
    }
}
if (!empty($icon)) {
    $icon = wp_get_attachment_image_src($icon, 'full');
    $icon_url = $icon[0];
}
?>
<div data-lat="<?php echo esc_attr($lat) ?>"
     data-lng="<?php echo esc_attr($lng) ?>"
     data-title="<?php echo esc_attr($title) ?>"
     data-icon="<?php echo esc_attr($icon_url) ?>"
     data-map-style="<?php echo esc_attr($map_style) ?>"
     data-zoom-level="<?php echo esc_attr($googlemap_zoom_level) ?>"
     data-property-marker="<?php echo esc_attr($html_content) ?>"
     data-no-location-text="<?php echo esc_attr__('No Location!', 'essential-real-estate') ?>"
     class="ere-property-map text-center" <?php ere_render_html_attr($wrapper_styles); ?>>
</div>
