<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if (is_sticky() && is_home() && !is_paged()) : ?>
            <span class="sticky-post"><?php esc_html_e('Featured', 'g5-beyot'); ?></span>
        <?php endif; ?>

        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
    </header><!-- .entry-header -->

    <?php echo 'excerpt'; //twentysixteen_excerpt(); ?>

    <?php echo 'post_thumbnail';//twentysixteen_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        /* translators: %s: Name of current post */
        the_content(sprintf(
            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'g5-beyot'),
            get_the_title()
        ));

        wp_link_pages(array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'g5-beyot') . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'g5-beyot') . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo 'entry_meta';// twentysixteen_entry_meta(); ?>
        <?php
        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                __('Edit<span class="screen-reader-text"> "%s"</span>', 'g5-beyot'),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
