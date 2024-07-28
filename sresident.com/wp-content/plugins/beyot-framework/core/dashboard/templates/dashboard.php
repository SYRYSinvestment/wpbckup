<?php
/**
 * The template for displaying dashboard
 *
 * @package WordPress
 * @subpackage g5-beyot
 * @since g5-beyot 1.0.1
 */

/**
 * @var $current_page
 */
$current_theme = wp_get_theme();
?>
<div class="gf-dashboard wrap">
	<h2 class="screen-reader-text"><?php printf(esc_html__('%s Dashboard', 'beyot-framework'), $current_theme['Name']) ?></h2>
	<div class="gf-message-box">
		<h1 class="welcome"><?php esc_html_e('Welcome to', 'beyot-framework') ?> <span
				class="gf-theme-name"><?php echo esc_html($current_theme['Name']) ?></span> <span
				class="gf-theme-version">v<?php echo esc_html($current_theme['Version']) ?></span></h1>
		<p class="about"><?php printf(esc_html__('%s is now installed and ready to use! Get ready to build something beautiful. Read below for additional information. We hope you enjoy it!', 'beyot-framework'), $current_theme['Name']); ?></p>
	</div>
	<?php gf_get_template('core/dashboard/templates/tabs', array('current_page' => $current_page)); ?>
	<div class="gf-dashboard-content">
		<div class="<?php echo esc_attr($current_page) ?>">
			<?php gf_get_template("core/dashboard/templates/{$current_page}"); ?>
		</div>
	</div>
</div>

