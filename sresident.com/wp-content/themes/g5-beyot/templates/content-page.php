<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
// Start the loop.
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pages'); ?>>
    <div class="entry-content clearfix">
        <?php
        the_content();
        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:','g5-beyot') . '</span>',
            'after' => '</div>',
            'link_before' => '<span class="page-link">',
            'link_after' => '</span>',
        ));
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
?>
