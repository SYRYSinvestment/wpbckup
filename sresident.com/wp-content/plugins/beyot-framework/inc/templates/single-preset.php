<?php get_header();?>
<div class="gf-preset-content-wrapper">
	<?php while ( have_posts() ) : the_post();
		the_title();
	endwhile;; ?>
</div>
<?php
get_footer();