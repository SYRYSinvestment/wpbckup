<?php
/**
 * The template for display single content
 *
 * @package WordPress
 * @subpackage Mowasalet
 * @since Mowasalet 1.0
 */

get_header();
	while ( have_posts() ) : the_post();
		// Include the single post content template.
		get_template_part( 'templates/content', 'single' );
	endwhile;
get_footer();