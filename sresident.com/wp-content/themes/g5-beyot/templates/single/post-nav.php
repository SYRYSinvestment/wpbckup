<?php
/**
 * The template for displaying navigation on single post
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
if(get_next_post() || get_previous_post()):
?>
<nav class="post-navigation mg-top-15 clearfix" role="navigation">
	<div class="nav-links">
		<?php
		previous_post_link('<div class="nav-previous">%link</div>', _x('<div class="post-navigation-content"><div class="post-navigation-label">Previous Post</div> <div class="post-navigation-title">%title </div> </div> ', 'Previous post link', 'g5-beyot'));
		next_post_link('<div class="nav-next">%link</div>', _x('<div class="post-navigation-content"><div class="post-navigation-label">Next Post</div> <div class="post-navigation-title">%title</div></div> ', 'Next post link', 'g5-beyot'));
		?>
	</div>
	<!-- .nav-links -->
</nav><!-- .navigation -->
<?php endif;?>