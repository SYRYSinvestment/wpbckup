<?php
/**
 * The template for displaying post related
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
global $post;

$single_related_post_enable = g5plus_get_option('single_related_post_enable', 1);
if (!$single_related_post_enable || !isset($post->ID)) return;

$single_related_post_condition = g5plus_get_option('single_related_post_condition', array());
$related_by_category = (is_array($single_related_post_condition) && in_array('category',$single_related_post_condition)) ? true : false;
$single_related_post_total = g5plus_get_option('single_related_post_total', 6);
$single_related_post_column = g5plus_get_option('single_related_post_column', 3);

$cat_ids = wp_get_post_terms($post->ID, 'category', array('fields' => 'ids'));

$args = array(
    'numberposts'         => $single_related_post_total,
    'ignore_sticky_posts' => 1,
    'post__not_in'        => array($post->ID),
    'tax_query'           => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array('post-format-quote', 'post-format-link'),
            'operator' => 'NOT IN'
        )
    )
);
if ($related_by_category && isset($cat_ids)) {
    $args['category__in'] = $cat_ids;
}
$args = apply_filters('g5plus_related_post_args', $args);
$_posts = get_posts($args);

if (sizeof($_posts) == 0) return;

$data_plugin_options = '"margin": 30,"autoHeight" : true, "loop": false, "responsiveClass": true, "dots" : true, "nav" : false, "autoplay": false';
switch ($single_related_post_column) {
    case '2':
        $data_plugin_options .= ',"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}, "992": {"items" : 2, "margin": 30}}';
        break;
    case '3' :
        $data_plugin_options .= ',"responsive" : {"0" : {"items" : 1, "margin": 0}, "600": {"items" : 2, "margin": 30}, "992": {"items" : 3, "margin": 30}}';
        break;
}
?>
<div class="post-related-wrap pd-top-60 mg-top-20 clearfix">
    <h4 class="blog-line-title"><?php esc_html_e('Related Posts', 'g5-beyot') ?></h4>
    <div class="owl-carousel owl-dot-line" data-plugin-options='{<?php echo esc_attr($data_plugin_options); ?>}'>
        <?php foreach ($_posts as $item): setup_postdata($GLOBALS['post'] = &$item); ?>
            <?php get_template_part('templates/single/content-related'); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php wp_reset_postdata(); ?>
