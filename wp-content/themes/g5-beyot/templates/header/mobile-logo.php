<?php
$logo_class = array('logo-mobile');
$data_retina = '';
$mobile_logo = g5plus_get_option('mobile_logo', array('url' => G5PLUS_THEME_URL . 'assets/images/logo.png'));
$mobile_logo = isset($mobile_logo['url']) ? $mobile_logo['url'] : '';

$mobile_logo_retina = g5plus_get_option('mobile_logo_retina', array('url' => ''));
$mobile_logo_retina = isset($mobile_logo_retina['url']) ? $mobile_logo_retina['url'] : '';

if (!$mobile_logo_retina && ($mobile_logo_retina != $mobile_logo)) {
	$data_retina = sprintf(' data-no-retina="%s" data-retina="%s"', esc_url($mobile_logo), esc_url($mobile_logo_retina));
}
$logo_title = esc_attr( get_bloginfo( 'name', 'display' ) ) . '-' . get_bloginfo( 'description', 'display' );
?>
<div class="logo-mobile-wrapper">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr($logo_title); ?>">
		<img src="<?php echo esc_url($mobile_logo); ?>"<?php echo sprintf('%s', $data_retina); ?> alt="<?php echo esc_attr($logo_title); ?>"/>
	</a>
</div>