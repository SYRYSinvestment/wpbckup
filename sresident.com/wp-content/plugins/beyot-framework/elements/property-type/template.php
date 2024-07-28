<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

use Elementor\Group_Control_Image_Size;

/**
 * @var $element UBE_Element_Beyot_Property_Type
 */

$atts = $element->get_settings_for_display();
$wrapper_classes = array(
	'ube-property-type',
	'ere-property-type',
);
$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes
));

$property_type = get_term_by( 'term_id', $atts['property_type'], 'property-type', 'OBJECT' );
if(!$property_type) return;
$type_name = $property_type->name;
$type_slug = $property_type->slug;
$type_count = $property_type->count;

?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<div class="property-type-inner">
		<div class="property-type-image">
			<?php if (!empty($atts['type_image'])):?>
				<a href="<?php echo esc_url( get_term_link( $type_slug, 'property-type' ) ); ?>" title="<?php echo esc_attr( $type_name ) ?>">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $atts, 'image_size', 'type_image' ); ?>
				</a>
			<?php endif;?>
		</div>
		<div class="property-type-info">
			<div class="property-title">
				<a href="<?php echo esc_url( get_term_link( $type_slug, 'property-type' ) ); ?>" title="<?php echo esc_attr( $type_name ) ?>">
					<?php echo esc_html( $type_name ); ?>
				</a>
			</div>
			<div class="property-count"><span><?php echo esc_attr( $type_count ); ?></span> <?php
				if($type_count=='1')
				{
					esc_html_e('Property','beyot-framework');
				}
				else{
					esc_html_e('Properties','beyot-framework');
				}
				?></div>
		</div>
	</div>
</div>

