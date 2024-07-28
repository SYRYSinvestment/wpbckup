<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

/**
 * @var $element UBE_Element_Beyot_Agent_Info
 */
$atts = $element->get_settings_for_display();

$wrapper_classes = array(
	'ube-agent-info',
	'g5plus-agent-info',
);

$element->set_render_attribute('wrapper', array(
	'class' => $wrapper_classes,
));

?>
<div <?php $element->print_render_attribute_string('wrapper') ?>>
	<?php if (!empty($atts['name'])): ?>
        <h3><?php echo esc_html($atts['name']) ?></h3>
	<?php endif;
	if (!empty($atts['position'])):?>
        <p><?php echo esc_html($atts['position']) ?></p>
	<?php endif; ?>
	<?php if (!empty($atts['phone'])): ?>
        <span><i class="fa fa-phone accent-color"></i> <strong><?php esc_attr_e('Phone:', 'beyot-framework') ?></strong>
		<?php echo esc_html($atts['phone']) ?>
	</span>
	<?php endif;
	if (!empty($atts['mobile'])):?>
        <span><i class="fa fa-mobile accent-color"></i> <strong><?php esc_attr_e('Mobile:', 'beyot-framework') ?></strong>
		<?php echo esc_html($atts['mobile']) ?>
	</span>
	<?php endif;
	if (!empty($atts['fax'])):?>
        <span><i class="fa fa-fax accent-color"></i> <strong><?php esc_attr_e('Fax:', 'beyot-framework') ?></strong>
		<?php echo esc_html($atts['fax']) ?>
	</span>
	<?php endif;
	if (!empty($atts['web'])):?>
        <span><i class="fa fa-link accent-color"></i> <strong><?php esc_attr_e('Website:', 'beyot-framework') ?></strong>
		<?php echo esc_html($atts['web']) ?>
	</span>
	<?php endif;
	if (!empty($atts['email'])):?>
        <span><i class="fa fa-envelope accent-color"></i> <strong><?php esc_attr_e('Email:', 'beyot-framework') ?></strong>
		<?php echo esc_html($atts['email']) ?>
	</span>
	<?php endif; ?>
</div>
