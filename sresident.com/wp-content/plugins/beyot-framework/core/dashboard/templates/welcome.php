<?php
/**
 * The template for displaying welcome.php
 *
 * @package WordPress
 * @subpackage g5-beyot
 * @since g5-beyot 1.0.1
 */
$current_theme = wp_get_theme();
?>
<h1 class="gf-wc-title"><?php printf(esc_html__('Welcome to %s', 'beyot-framework'),$current_theme['Name']) ?> <span>v<?php echo esc_html($current_theme['Version']) ?></span></h1>
<p class="gf-wc-description"><?php echo wp_kses_post($current_theme['Description']) ?></p>
<hr>