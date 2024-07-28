<?php

$header_layout = g5plus_get_option('header_layout', 'header-1');
$logo = g5plus_get_option('logo', array('url' => G5PLUS_THEME_URL . 'assets/images/logo.png'));
$logo = isset($logo['url']) ? $logo['url'] : '';

$logo_retina = g5plus_get_option('logo_retina', array('url', ''));
$logo_retina = isset($logo_retina['url']) ? $logo_retina['url'] : '';

$sticky_logo = g5plus_get_option('sticky_logo', array('url' => G5PLUS_THEME_URL . 'assets/images/logo.png'));
$sticky_logo = isset($sticky_logo['url']) ? $sticky_logo['url'] : '';

$sticky_logo_retina = g5plus_get_option('sticky_logo_retina', array('url', ''));
$sticky_logo_retina = isset($sticky_logo_retina['url']) ? $sticky_logo_retina['url'] : '';

$header_logo_sticky_layout = array('header-1', 'header-3');
$logo_class = array('logo-header');

if (in_array($header_layout, $header_logo_sticky_layout) && ($sticky_logo) && ($logo != $sticky_logo)) {
	$logo_class[] = 'has-logo-sticky';
}
$data_retina = '';
if (!$logo_retina && ($logo_retina != $logo_retina)) {
	$data_retina = sprintf(' data-no-retina="%s" data-retina="%s"', esc_url($logo), esc_url($logo_retina));
}

$data_sticky_retina = '';
if ($sticky_logo_retina && ($sticky_logo_retina != $sticky_logo)) {
	$data_sticky_retina = sprintf(' data-no-retina="%s" data-retina="%s"', esc_url($sticky_logo), esc_url($sticky_logo_retina));
}

$logo_title = esc_attr(get_bloginfo('name', 'display')) . '-' . get_bloginfo('description', 'display');
?>
<div class="<?php echo join(' ', $logo_class); ?>">
	<a class="no-sticky" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($logo_title); ?>">
		<img src="<?php echo esc_url($logo); ?>"<?php echo sprintf('%s', $data_retina); ?>
		     alt="<?php echo esc_attr($logo_title); ?>"/>
	</a>
	<?php if (in_array($header_layout, $header_logo_sticky_layout) && ($sticky_logo) && ($sticky_logo != $logo)): ?>
		<a class="logo-sticky" href="<?php echo esc_url(home_url('/')); ?>"
		   title="<?php echo esc_attr($logo_title); ?>">
			<img src="<?php echo esc_url($sticky_logo); ?>"<?php echo sprintf('%s', $data_sticky_retina); ?>
			     alt="<?php echo esc_attr($logo_title); ?>"/>
		</a>
	<?php endif; ?>
</div>