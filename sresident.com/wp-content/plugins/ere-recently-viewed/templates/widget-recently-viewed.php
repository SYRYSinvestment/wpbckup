<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
/**
 * @var $the_query WP_Query
 * @var $width
 * @var $height
 */
$wrapper_classes = array(
    'ere-property',
    'ere-recently-viewed-properties'
);

$no_image_src = ERE_PLUGIN_URL . 'public/assets/images/no-image.jpg';
$default_image = ere_get_option('default_property_image', '');


$wrapper_class = implode(' ', $wrapper_classes);
?>
<div class="<?php echo esc_attr($wrapper_class) ?>">
    <?php while ($the_query->have_posts()): ?>
        <?php
            $the_query->the_post();
            $property_id = get_the_ID();
            $attach_id = get_post_thumbnail_id($property_id);
            $image_src = ere_image_resize_id($attach_id, $width, $height, true);
            if ($default_image != '') {
                if (is_array($default_image) && $default_image['url'] != '') {
                    $resize = ere_image_resize_url($default_image['url'], $width, $height, true);
                    if ($resize != null && is_array($resize)) {
                        $no_image_src = $resize['url'];
                    }
                }
            }

        $property_link = get_the_permalink();
        $property_label = get_the_terms($property_id, 'property-label');
        $price = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_price', true);
        $price_short = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_price_short', true);
        $price_unit = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_price_unit', true);
        $price_prefix = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_price_prefix', true);
        $price_postfix = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_price_postfix', true);
        $property_address = get_post_meta($property_id, ERE_METABOX_PREFIX . 'property_address', true);
        ?>
        <div class="property-item">
            <div class="property-inner">
                <div class="property-image">
                    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>"
                         src="<?php echo esc_url($image_src) ?>"
                         onerror="this.src = '<?php echo esc_url($no_image_src) ?>';"
                         alt="<?php the_title(); ?>"
                         title="<?php the_title(); ?>">
                    <div class="property-action block-center">
                        <div class="block-center-inner">
                            <?php
                            /**
                             * ere_property_action hook.
                             *
                             * @hooked property_social_share - 5
                             * @hooked property_favorite - 10
                             * @hooked property_compare - 15
                             */
                            do_action('ere_property_action'); ?>
                        </div>
                        <a class="property-link" href="<?php echo esc_url($property_link); ?>"
                           title="<?php the_title(); ?>"></a>
                    </div>
                    <?php if ($property_label): ?>
                        <div class="property-label">
                            <?php foreach ($property_label as $label_item): ?>
                                <p class="label-item">
                                    <span><?php echo esc_attr($label_item->name) ?></span>
                                </p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="property-item-content">
                    <h4 class="property-title fs-18">
                        <a href="<?php echo esc_url($property_link); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
                    </h4>
                    <?php if (!empty($price)): ?>
                        <div class="property-price">
                                    <span>
                                        <?php if (!empty($price_prefix)) {
                                            echo '<span class="property-price-prefix fs-12 accent-color">' . $price_prefix . ' </span>';
                                        } ?>
                                        <?php echo ere_get_format_money($price_short, $price_unit) ?>
                                        <?php if (!empty($price_postfix)) {
                                            echo '<span class="property-price-postfix fs-12 accent-color"> / ' . $price_postfix . '</span>';
                                        } ?>
                                    </span>
                        </div>
                    <?php elseif (ere_get_option('empty_price_text', '') != ''): ?>
                        <div class="property-price">
                            <span><?php echo ere_get_option('empty_price_text', '') ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($property_address)): ?>
                        <?php
                        $property_location = get_post_meta(get_the_ID(), ERE_METABOX_PREFIX . 'property_location', true);
                        if ($property_location) {
                            $google_map_address_url = "http://maps.google.com/?q=" . $property_location['address'];
                        } else {
                            $google_map_address_url = "http://maps.google.com/?q=" . $property_address;
                        }
                        ?>
                        <div class="property-location"
                             title="<?php echo esc_attr($property_address) ?>">
                            <i class="fa fa-map-marker accent-color"></i>
                            <a target="_blank"
                               href="<?php echo esc_url($google_map_address_url); ?>"><span><?php echo esc_html($property_address) ?></span></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

