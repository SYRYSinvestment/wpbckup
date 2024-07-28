<?php
function xmenu_get_transition() {
	return array(
		'none' => esc_html__('None','beyot-framework'),
		'x-animate-slide-up' => esc_html__('Slide Up','beyot-framework'),
		'x-animate-slide-down' => esc_html__('Slide Down','beyot-framework'),
		'x-animate-slide-left' => esc_html__('Slide Left','beyot-framework'),
		'x-animate-slide-right' => esc_html__('Slide Right','beyot-framework'),
		'x-animate-sign-flip' => esc_html__('Sign Flip','beyot-framework'),
	);
}

function xmenu_get_grid () {
	return array(
		'basic' => array(
			'text' => esc_html__('Basic','beyot-framework'),
			'options' => array(
				'auto' => esc_html__('Automatic','beyot-framework'),
				'x-col x-col-12-12' => esc_html__('Full Width','beyot-framework'),
			)
		),
		'halves' => array(
			'text' => esc_html__('Halves','beyot-framework'),
			'options' => array(
				'x-col x-col-6-12' => esc_html__('1/2','beyot-framework'),
			)
		),
		'thirds' => array(
			'text' => esc_html__('Thirds','beyot-framework'),
			'options' => array(
				'x-col x-col-4-12' => esc_html__('1/3','beyot-framework'),
				'x-col x-col-8-12' => esc_html__('2/3','beyot-framework'),
			)
		),
		'quarters' => array(
			'text' => esc_html__('Quarters','beyot-framework'),
			'options' => array(
				'x-col x-col-3-12' => esc_html__('1/4','beyot-framework'),
				'x-col x-col-9-12' => esc_html__('3/4','beyot-framework'),
			)
		),
		'fifths' => array(
			'text' => esc_html__('Fifths','beyot-framework'),
			'options' => array(
				'x-col x-col-2-10' => esc_html__('1/5','beyot-framework'),
				'x-col x-col-4-10' => esc_html__('2/5','beyot-framework'),
				'x-col x-col-6-10' => esc_html__('3/5','beyot-framework'),
				'x-col x-col-8-10' => esc_html__('4/5','beyot-framework'),
			)
		),
		'sixths' => array(
			'text' => esc_html__('Sixths','beyot-framework'),
			'options' => array(
				'x-col x-col-2-12' => esc_html__('1/6','beyot-framework'),
				'x-col x-col-10-12' => esc_html__('5/6','beyot-framework'),
			)
		),
		'sevenths' => array(
			'text' => esc_html__('Sevenths','beyot-framework'),
			'options' => array(
				'x-col x-col-1-7' => esc_html__('1/7','beyot-framework'),
				'x-col x-col-2-7' => esc_html__('2/7','beyot-framework'),
				'x-col x-col-3-7' => esc_html__('3/7','beyot-framework'),
				'x-col x-col-4-7' => esc_html__('4/7','beyot-framework'),
				'x-col x-col-5-7' => esc_html__('5/7','beyot-framework'),
				'x-col x-col-6-7' => esc_html__('6/7','beyot-framework'),
			)
		),
		'eighths' => array(
			'text' => esc_html__('Eighths','beyot-framework'),
			'options' => array(
				'x-col x-col-1-8' => esc_html__('1/8','beyot-framework'),
				'x-col x-col-3-8' => esc_html__('3/8','beyot-framework'),
				'x-col x-col-5-8' => esc_html__('5/8','beyot-framework'),
				'x-col x-col-7-8' => esc_html__('7/8','beyot-framework'),
			)
		),
		'ninths' => array(
			'text' => esc_html__('Ninths','beyot-framework'),
			'options' => array(
				'x-col x-col-1-9' => esc_html__('1/9','beyot-framework'),
				'x-col x-col-2-9' => esc_html__('2/9','beyot-framework'),
				'x-col x-col-4-9' => esc_html__('4/9','beyot-framework'),
				'x-col x-col-5-9' => esc_html__('5/9','beyot-framework'),
				'x-col x-col-7-9' => esc_html__('7/9','beyot-framework'),
				'x-col x-col-8-9' => esc_html__('8/9','beyot-framework'),
			)
		),
		'tenths' => array(
			'text' => esc_html__('Tenths','beyot-framework'),
			'options' => array(
				'x-col x-col-1-10' => esc_html__('1/10','beyot-framework'),
				'x-col x-col-3-10' => esc_html__('3/10','beyot-framework'),
				'x-col x-col-7-10' => esc_html__('7/10','beyot-framework'),
				'x-col x-col-9-10' => esc_html__('9/10','beyot-framework'),
			)
		),
		'elevenths' => array(
			'text' => esc_html__('Elevenths','beyot-framework'),
			'options' => array(
				'x-col x-col-1-11' => esc_html__('1/11','beyot-framework'),
				'x-col x-col-2-11' => esc_html__('2/11','beyot-framework'),
				'x-col x-col-3-11' => esc_html__('3/11','beyot-framework'),
				'x-col x-col-4-11' => esc_html__('4/11','beyot-framework'),
				'x-col x-col-5-11' => esc_html__('5/11','beyot-framework'),
				'x-col x-col-6-11' => esc_html__('6/11','beyot-framework'),
				'x-col x-col-7-11' => esc_html__('7/11','beyot-framework'),
				'x-col x-col-8-11' => esc_html__('8/11','beyot-framework'),
				'x-col x-col-9-11' => esc_html__('9/11','beyot-framework'),
				'x-col x-col-10-11' => esc_html__('10/11','beyot-framework'),
			)
		),
		'twelfths' => array(
			'text' => esc_html__('Twelfths','beyot-framework'),
			'options' => array(
				'x-col x-col-1-12' => esc_html__('1/12','beyot-framework'),
				'x-col x-col-5-12' => esc_html__('5/12','beyot-framework'),
				'x-col x-col-7-12' => esc_html__('7/12','beyot-framework'),
				'x-col x-col-11-12' => esc_html__('11/12','beyot-framework'),
			)
		),
	);
}

function xmenu_get_item_settings() {
	if (isset($GLOBALS['xmenu_item_settings'])) {
		return $GLOBALS['xmenu_item_settings'];
	}
	$GLOBALS['xmenu_item_settings'] = array(
		'general' => array(
			'text' => esc_html__('General','beyot-framework'),
			'icon' => 'fa fa-cogs',
			'config' => array(
				'general-heading' => array(
					'text' => esc_html__('General','beyot-framework'),
					'type' => 'heading'
				),
				'general-url' => array(
					'text' => esc_html__('URL','beyot-framework'),
					'type' => 'text',
					'std'  => '',
				),
				'general-title' => array(
					'text' => esc_html__('Navigation Label','beyot-framework'),
					'type' => 'text',
					'std'  => '',
				),
				'general-attr-title' => array(
					'text' => esc_html__('Title Attribute','beyot-framework'),
					'type' => 'text',
					'std'  => '',
				),
				'general-target' => array(
					'text' => esc_html__('Open link in a new window/tab','beyot-framework'),
					'type' => 'checkbox',
					'std'  => '',
					'value' => '_blank',
				),
				'general-classes' => array(
					'text' => esc_html__('CSS Classes (optional)','beyot-framework'),
					'type' => 'array',
					'std'  => '',
				),
				'general-xfn' => array(
					'text' => esc_html__('Link Relationship (XFN)','beyot-framework'),
					'type' => 'text',
					'std'  => '',
				),
				'general-description' => array(
					'text' => esc_html__('Description','beyot-framework'),
					'type' => 'textarea',
					'std'  => '',
				),
				'general-other-heading' => array(
					'text' => esc_html__('Other','beyot-framework'),
					'type' => 'heading'
				),
				'other-disable-text' => array(
					'text' => esc_html__('Disable Text','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'other-disable-menu-item' => array(
					'text' => esc_html__('Disable Menu Item','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'other-disable-link' => array(
					'text' => esc_html__('Disable Link','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'other-display-header-column' => array(
					'text' => esc_html__('Display as a Sub Menu column header','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'other-feature-text' => array(
					'text' => esc_html__('Menu Feature Text','beyot-framework'),
					'type' => 'text',
					'std' => ''
				),
			)
		),
		'icon' => array(
			'text' => esc_html__('Icon','beyot-framework'),
			'icon' => 'fa fa-qrcode',
			'config' => array(
				'icon-heading' => array(
					'text' => esc_html__('Icon','beyot-framework'),
					'type' => 'heading'
				),
				'icon-value' => array(
					'text' => esc_html__('Set Icon','beyot-framework'),
					'type' => 'icon',
					'std'  => '',
				),
				'icon-position' => array(
					'text' => esc_html__('Icon Position','beyot-framework'),
					'type' => 'select',
					'std'  => 'left',
					'options' => array(
						'left' => esc_html__('Left of Menu Text','beyot-framework'),
						'right' => esc_html__('Right of Menu Text','beyot-framework'),
					)
				),
				'icon-padding' => array(
					'text' => esc_html__('Padding Icon and Text Menu','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Padding between Icon and Text Menu (px). Do not include units','beyot-framework')
				)
			)
		),
		'image' => array(
			'text' => esc_html__('Image','beyot-framework'),
			'icon' => 'fa fa-picture-o',
			'config' => array(
				'image-heading' => array(
					'text' => esc_html__('Image','beyot-framework'),
					'type' => 'heading'
				),
				'image-url' => array(
					'text' => esc_html__('Image Url','beyot-framework'),
					'type' => 'image',
					'std'  => '',
				),
				'image-size' => array(
					'text' => esc_html__('Image Size','beyot-framework'),
					'type' => 'select',
					'std'  => 'full',
					'options' => xmenu_get_image_size()
				),
				'image-dimensions' => array(
					'text' => esc_html__('Image Dimensions','beyot-framework'),
					'type' => 'select',
					'std'  => 'inherit',
					'options' => array(
						'inherit' => 'Inherit from Menu Settings',
						'custom' => 'Custom',
					)
				),
				'image-width' => array(
					'text' => esc_html__('Image Width','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Image width attribute (px). Do not include units. Only valid if "Image Dimension" is set to "Custom" above','beyot-framework')
				),
				'image-height' => array(
					'text' => esc_html__('Image Height','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Image width attribute (px). Do not include units. Only valid if "Image Dimension" is set to "Custom" above','beyot-framework')
				),
				'image-layout' => array(
					'text' => esc_html__('Image Layout','beyot-framework'),
					'type' => 'select',
					'std'  => 'image-only',
					'options' => array(
						'image-only' => esc_html__('Image Only','beyot-framework'),
						'left' => esc_html__('Image Left','beyot-framework'),
						'right' => esc_html__('Image Right','beyot-framework'),
						'above' => esc_html__('Image Above','beyot-framework'),
						'below' => esc_html__('Image Below','beyot-framework'),
					)
				),
				'image-feature' => array(
					'text' => esc_html__('Use Feature Image','beyot-framework'),
					'type' => 'checkbox',
					'std'  => '',
					'des' => 'Use Feature Image from Post/Page Menu Item',
				),
			)
		),

		'layout' => array(
			'text' => esc_html__('Layout','beyot-framework'),
			'icon' => 'fa fa-columns',
			'config' => array(
				'layout-heading' => array(
					'text' => esc_html__('Layout','beyot-framework'),
					'type' => 'heading'
				),
				'layout-width' => array(
					'text' => esc_html__('Menu Item Width','beyot-framework'),
					'type' => 'select-group',
					'std'  => 'auto',
					'options' => xmenu_get_grid()
				),
				'layout-text-align' => array(
					'text' => esc_html__('Item Content Alignment','beyot-framework'),
					'type' => 'select',
					'std'  => 'none',
					'options' => array(
						'none' => esc_html__('Default','beyot-framework'),
						'left' => esc_html__('Text Left','beyot-framework'),
						'center' => esc_html__('Text Center','beyot-framework'),
						'right' => esc_html__('Text Right','beyot-framework'),
					)
				),
				'layout-padding' => array(
					'text' => esc_html__('Padding','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Set padding for menu item. Include the units.','beyot-framework'),
				),
				'layout-margin' => array(
					'text' => esc_html__('Margin','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Set margin for menu item. Include the units.','beyot-framework'),
				),
				'layout-new-row' => array(
					'text' => esc_html__('New Row','beyot-framework'),
					'type' => 'checkbox',
					'std'  => ''
				),
			)
		),
		'submenu' => array(
			'text' => esc_html__('Sub Menu','beyot-framework'),
			'icon' => 'fa fa-list-alt',
			'config' => array(
				'submenu-heading' => array(
					'text' => esc_html__('Sub Menu','beyot-framework'),
					'type' => 'heading'
				),
				'submenu-type' => array(
					'text' => esc_html__('Sub Menu Type','beyot-framework'),
					'type' => 'select',
					'std'  => 'standard',
					'options' => array(
						'standard' => esc_html__('Standard','beyot-framework'),
						'multi-column' => esc_html__('Multi Column','beyot-framework'),
						'tab' => esc_html__('Tab','beyot-framework'),
					)
				),
				'submenu-position' => array(
					'text' => esc_html__('Sub Menu Position','beyot-framework'),
					'type' => 'select',
					'std'  => '',
					'options' => array(
						'' => esc_html__('Automatic','beyot-framework'),
						'pos-left-menu-parent' => esc_html__('Left of Menu Parent','beyot-framework'),
						'pos-right-menu-parent' => esc_html__('Right of Menu Parent','beyot-framework'),
						'pos-center-menu-parent' => esc_html__('Center of Menu Parent','beyot-framework'),
						'pos-left-menu-bar' => esc_html__('Left of Menu Bar','beyot-framework'),
						'pos-right-menu-bar' => esc_html__('Right of Menu Bar','beyot-framework'),
						'pos-full' => esc_html__('Full Size','beyot-framework'),
					)
				),
				'submenu-width-custom' => array(
					'text' => esc_html__('Sub Menu Width Custom','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Set custom Sub Menu Width. Include the units (px/em/%).','beyot-framework'),
				),
				'submenu-col-width-default' => array(
					'text' => esc_html__('Sub Menu Column Width Default','beyot-framework'),
					'type' => 'select-group',
					'std'  => 'auto',
					'options' => xmenu_get_grid()
				),
				'submenu-col-spacing-default' => array(
					'text' => esc_html__('Sub Menu Column Spacing Default','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Set sub menu column spacing default. Do not include unit.','beyot-framework'),
				),
				'submenu-list-style' => array(
					'text' => esc_html__('Sub Menu List Style','beyot-framework'),
					'type' => 'select',
					'std'  => 'none',
					'options' => array(
						'none' => esc_html__('None','beyot-framework'),
						'disc' => esc_html__('Disc','beyot-framework'),
						'square' => esc_html__('Square','beyot-framework'),
						'circle' => esc_html__('Circle','beyot-framework'),
					)
				),
				'submenu-tab-position' => array(
					'text' => esc_html__('Tab Position','beyot-framework'),
					'type' => 'select',
					'std'  => 'left',
					'des' => esc_html__('Tab Position set to "Sub Menu Type" is "TAB".','beyot-framework'),
					'options' => array(
						'left' => esc_html__('Left','beyot-framework'),
						'right' => esc_html__('Right','beyot-framework'),
					)
				),
				'submenu-animation' => array(
					'text' => esc_html__('Sub Menu Animation','beyot-framework'),
					'type' => 'select',
					'std'  => 'none',
					'options' => xmenu_get_transition()
				),
			)
		),
		'custom-content' => array(
			'text' => esc_html__('Custom Content','beyot-framework'),
			'icon' => 'fa fa-code',
			'config' => array(
				'custom-content-heading' => array(
					'text' => esc_html__('Custom Content','beyot-framework'),
					'type' => 'heading'
				),
				'custom-content-value' => array(
					'text' => esc_html__('Custom Content','beyot-framework'),
					'type' => 'textarea',
					'std'  => '',
					'des' => esc_html__('Can contain HTML and shortcodes','beyot-framework'),
					'height' => '300px'
				),
			)
		),
		'widget' => array(
			'text' => esc_html__('Widget Area','beyot-framework'),
			'icon' => 'fa-puzzle-piece',
			'config' => array(
				'widget-heading' => array(
					'text' => esc_html__('Select Widget Area','beyot-framework'),
					'type' => 'heading'
				),
				'widget-area' => array(
					'text' => esc_html__('Widget Area','beyot-framework'),
					'type' => 'sidebar',
					'std' => '-1',
					'hide-label' => 'true'
				),
			)
		),
		'customize-style' => array(
			'text' => esc_html__('Customize Style','beyot-framework'),
			'icon' => 'fa-paint-brush',
			'config' => array(
				'custom-style-menu-heading' => array(
					'text' => esc_html__('Menu Item','beyot-framework'),
					'type' => 'heading'
				),
				'custom-style-menu-bg-color' => array(
					'text' => esc_html__('Background Color','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-menu-text-color' => array(
					'text' => esc_html__('Text Color','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-menu-bg-color-active' => array(
					'text' => esc_html__('Background Color [Active]','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-menu-text-color-active' => array(
					'text' => esc_html__('Text Color [Active]','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-menu-bg-image' => array(
					'text' => esc_html__('Background Image','beyot-framework'),
					'type' => 'image',
					'std'  => '',
				),
				'custom-style-menu-bg-image-repeat' => array(
					'text' => esc_html__('Background Image Repeat','beyot-framework'),
					'type' => 'select',
					'std' => 'no-repeat',
					'hide-label' => 'true',
					'options' => array(
						'no-repeat' => 'no-repeat',
						'repeat' => 'repeat',
						'repeat-x' => 'repeat-x',
						'repeat-y' => 'repeat-y'
					)
				),
				'custom-style-menu-bg-image-attachment' => array(
					'text' => esc_html__('Background Image Attachment','beyot-framework'),
					'type' => 'select',
					'std' => 'scroll',
					'hide-label' => 'true',
					'options' => array(
						'scroll' => 'scroll',
						'fixed' => 'fixed'
					)
				),
				'custom-style-menu-bg-image-position' => array(
					'text' => esc_html__('Background Image Position','beyot-framework'),
					'type' => 'select',
					'std' => 'center',
					'hide-label' => 'true',
					'options' => array(
						'center' => 'center',
						'center left' => 'center left',
						'center right' => 'center right',
						'top left' => 'top left',
						'top center' => 'top center',
						'top right' => 'top right',
						'bottom left' => 'bottom left',
						'bottom center' => 'bottom center',
						'bottom right' => 'bottom right'
					)
				),
				'custom-style-menu-bg-image-size' => array(
					'text' => esc_html__('Background Image Size','beyot-framework'),
					'type' => 'select',
					'std' => 'auto',
					'hide-label' => 'true',
					'options' => array(
						'auto' => 'Keep original',
						'100% auto' => 'Stretch to width',
						'auto 100%' => 'Stretch to height',
						'cover' => 'Cover',
						'contain' => 'Contain'
					)
				),
				'custom-style-sub-menu-heading' => array(
					'text' => esc_html__('Sub Menu','beyot-framework'),
					'type' => 'heading'
				),
				'custom-style-sub-menu-bg-color' => array(
					'text' => esc_html__('Background Color','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-sub-menu-text-color' => array(
					'text' => esc_html__('Text Color','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-sub-menu-bg-image' => array(
					'text' => esc_html__('Background Image','beyot-framework'),
					'type' => 'image',
					'std'  => '',
				),
				'custom-style-sub-menu-bg-image-repeat' => array(
					'text' => esc_html__('Background Image Repeat','beyot-framework'),
					'type' => 'select',
					'std' => 'no-repeat',
					'hide-label' => 'true',
					'options' => array(
						'no-repeat' => 'no-repeat',
						'repeat' => 'repeat',
						'repeat-x' => 'repeat-x',
						'repeat-y' => 'repeat-y'
					)
				),
				'custom-style-sub-menu-bg-image-attachment' => array(
					'text' => esc_html__('Background Image Attachment','beyot-framework'),
					'type' => 'select',
					'std' => 'scroll',
					'hide-label' => 'true',
					'options' => array(
						'scroll' => 'scroll',
						'fixed' => 'fixed'
					)
				),
				'custom-style-sub-menu-bg-image-position' => array(
					'text' => esc_html__('Background Image Position','beyot-framework'),
					'type' => 'select',
					'std' => 'center',
					'hide-label' => 'true',
					'options' => array(
						'center' => 'center',
						'center left' => 'center left',
						'center right' => 'center right',
						'top left' => 'top left',
						'top center' => 'top center',
						'top right' => 'top right',
						'bottom left' => 'bottom left',
						'bottom center' => 'bottom center',
						'bottom right' => 'bottom right'
					)
				),
				'custom-style-sub-menu-bg-image-size' => array(
					'text' => esc_html__('Background Image Size','beyot-framework'),
					'type' => 'select',
					'std' => 'auto',
					'hide-label' => 'true',
					'options' => array(
						'auto' => 'Keep original',
						'100% auto' => 'Stretch to width',
						'auto 100%' => 'Stretch to height',
						'cover' => 'Cover',
						'contain' => 'Contain'
					)
				),
				'custom-style-col-min-width' => array(
					'text' => esc_html__('Column Min Width','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Set min-width for Sub Menu Column (px). Not include the units.','beyot-framework'),
				),
				'custom-style-padding' => array(
					'text' => esc_html__('Padding','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des' => esc_html__('Set padding for Sub Menu. Include the units.','beyot-framework'),
				),

				'custom-style-feature-menu-text-heading' => array(
					'text' => esc_html__('Menu Feature Text','beyot-framework'),
					'type' => 'heading'
				),
				'custom-style-feature-menu-text-type' => array(
					'text' => esc_html__('Feature Menu Type','beyot-framework'),
					'type' => 'select',
					'std'  => '',
					'options' => array(
						'' => esc_html__('Standard','beyot-framework'),
						'x-feature-menu-not-float' => esc_html__('Not Float','beyot-framework')
					)
				),
				'custom-style-feature-menu-text-bg-color' => array(
					'text' => esc_html__('Background Color','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-feature-menu-text-color' => array(
					'text' => esc_html__('Text Color','beyot-framework'),
					'type' => 'color',
					'std'  => '',
				),
				'custom-style-feature-menu-text-top' => array(
					'text' => esc_html__('Position Top','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des'  => 'Position Top (px) Feature Menu Text. Do not include units.',
				),
				'custom-style-feature-menu-text-left' => array(
					'text' => esc_html__('Position Left','beyot-framework'),
					'type' => 'text',
					'std'  => '',
					'des'  => 'Position Left (px) Feature Menu Text. Do not include units.',
				),
			)
		),
		'responsive' => array(
			'text' => esc_html__('Responsive','beyot-framework'),
			'icon' => 'fa-desktop',
			'config' => array(
				'responsive-heading' => array(
					'text' => esc_html__('Responsive','beyot-framework'),
					'type' => 'heading'
				),
				'responsive-hide-mobile-css' => array(
					'text' => esc_html__('Hide item on mobile via CSS','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-hide-desktop-css' => array(
					'text' => esc_html__('Hide item on desktop via CSS','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-hide-mobile-css-submenu' => array(
					'text' => esc_html__('Hide sub menu on mobile via CSS','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-remove-mobile' => array(
					'text' => esc_html__('Remove this item when mobile device is detected via wp_is_mobile()','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-remove-desktop' => array(
					'text' => esc_html__('Remove this item when desktop device is NOT detected via wp_is_mobile()','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-remove-mobile-submenu' => array(
					'text' => esc_html__('Remove sub menu when desktop device is NOT detected via wp_is_mobile()','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
			),
		),
		'responsive' => array(
			'text' => esc_html__('Responsive','beyot-framework'),
			'icon' => 'fa-desktop',
			'config' => array(
				'responsive-heading' => array(
					'text' => esc_html__('Responsive','beyot-framework'),
					'type' => 'heading'
				),
				'responsive-hide-mobile-css' => array(
					'text' => esc_html__('Hide item on mobile via CSS','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-hide-desktop-css' => array(
					'text' => esc_html__('Hide item on desktop via CSS','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-hide-mobile-css-submenu' => array(
					'text' => esc_html__('Hide sub menu on mobile via CSS','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
				'responsive-hide-desktop-css-submenu' => array(
					'text' => esc_html__('Hide sub menu on desktop via CSS','beyot-framework'),
					'type' => 'checkbox',
					'std' => ''
				),
			),
		)
	);
	return $GLOBALS['xmenu_item_settings'];
}

function xmenu_get_item_defaults() {
	$defaults = array(
		'nosave-type_label' => '',
		'nosave-type' => '',
		'nosave-change' => 0
	);
	$items_setting = xmenu_get_item_settings();
	foreach ($items_setting as $seting_key => $setting) {
		foreach ($setting['config'] as $key => $value) {
			if (isset($value['config']) && $value['config']) {

			}
			else {
				if ($value['type'] != 'heading') {
					$defaults[$key] = $value['std'];
				}
			}

		}
	}
	return $defaults;
}
function xmenu_get_image_size() {
	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array(
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
			);

		}

	}
	$image_size = array();
	$image_size ['full'] = esc_html__('Full Size','beyot-framework');
	foreach ($sizes as $key => $value) {
		$image_size[$key] = ucfirst($key) . ' (' . $value['width'] . ' x ' . $value['height'] .')' . ($value['crop'] ? '[cropped]' : '') ;
	}
	return $image_size;
}