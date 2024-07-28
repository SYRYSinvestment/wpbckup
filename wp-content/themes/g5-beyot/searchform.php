<?php
/**
 * Template for displaying search forms in Orson
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" placeholder="<?php echo esc_attr_x( 'ENTER YOUR  KEYWORD', 'placeholder', 'g5-beyot' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit"><i class="fa fa-search"></i></button>
</form>
