<?php
/**
 * Header Mobile
 */
$header_class = 'header-mobile ' . g5plus_get_option('mobile_header_layout', '');
$mobile_header_layout = g5plus_get_option('mobile_header_layout', '');
?>
<header class="<?php echo esc_attr($header_class); ?>">
    <?php get_template_part('templates/header/mobile-top-bar'); ?>
    <?php get_template_part('templates/header/mobile-header'); ?>
    <?php if ($mobile_header_layout === 'header-mobile-4'): ?>
        <div class="mobile-header-search-box">
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</header>