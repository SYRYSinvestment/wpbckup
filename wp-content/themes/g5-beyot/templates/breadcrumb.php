<?php
/**
 * The template for displaying breadcrumb
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
?>
<?php if (!is_front_page()) :
    $items = g5plus_get_breadcrumb_items();
    ?>
    <ul class="breadcrumbs">
        <?php echo join("", $items); ?>
    </ul>
<?php else: ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo esc_url(home_url('/')) ?>" class="home"><?php esc_html_e('Home', 'g5-beyot'); ?></a></li>
        <li><span><?php esc_html_e('Blog', 'g5-beyot'); ?></span></li>
    </ul>
<?php endif; ?>
