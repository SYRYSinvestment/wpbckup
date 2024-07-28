<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2016
 * Time: 10:32 AM
 */




/* Site loading */
if (!function_exists('g5plus_site_loading')) {
	function g5plus_site_loading()
	{
		get_template_part('templates/site-loading');
	}

	add_action('g5plus_before_page_wrapper', 'g5plus_site_loading', 5);
}

/* Header meta */
if (!function_exists('g5plus_head_meta')) {
	function g5plus_head_meta()
	{
		get_template_part('templates/head/head-meta');
	}

	add_action('wp_head', 'g5plus_head_meta', 0);
}

/* Social meta */
if (!function_exists('g5plus_social_meta')) {
	function g5plus_social_meta()
	{
		g5plus_get_template('head/social-meta');
	}

	add_action('wp_head', 'g5plus_social_meta', 5);
}

/* Header top drawer*/
if (!function_exists('g5plus_page_top_drawer')) {
	function g5plus_page_top_drawer()
	{
		get_template_part('templates/top-drawer');
	}

	add_action('g5plus_before_page_wrapper_content', 'g5plus_page_top_drawer', 5);
}

/* Header */
if (!function_exists('g5plus_page_header')) {
	function g5plus_page_header()
	{
		if (g5plus_get_option('header_show_hide', 1)) {
			get_template_part('templates/header-desktop-template');
			get_template_part('templates/header-mobile-template');
		}
	}

	add_action('g5plus_before_page_wrapper_content', 'g5plus_page_header', 15);
}


if (!function_exists('g5plus_output_content_wrapper')) {
	function g5plus_output_content_wrapper(){
		get_template_part('templates/global/wrapper-start');
	}
	add_action('g5plus_main_wrapper_content_start','g5plus_output_content_wrapper',1);
}

if (!function_exists('g5plus_output_content_wrapper_end')) {
	function g5plus_output_content_wrapper_end(){
		get_template_part('templates/global/wrapper-end');
	}
	add_action('g5plus_main_wrapper_content_end','g5plus_output_content_wrapper_end',1);
}

// region Single post

if (!function_exists('g5plus_post_tag')) {
	function g5plus_post_tag(){
		get_template_part('templates/single/post-tag');
	}
	add_action('g5plus_after_single_post', 'g5plus_post_tag', 5);
}

if (!function_exists('g5plus_post_nav')) {
	function g5plus_post_nav()
	{
		$single_navigation_enable =  g5plus_get_option('single_navigation_enable',0);
		if ($single_navigation_enable){
			get_template_part('templates/single/post-nav');
		}
	}

	add_action('g5plus_after_single_post', 'g5plus_post_nav', 10);
}

if (!function_exists('g5plus_post_author_info')) {
	function g5plus_post_author_info()
	{
		$single_author_info_enable = g5plus_get_option('single_author_info_enable',1);
		if ($single_author_info_enable){
			get_template_part('templates/single/author-info');
		}
	}

	add_action('g5plus_after_single_post', 'g5plus_post_author_info', 15);
}

if (!function_exists('g5plus_post_comment')) {
	function g5plus_post_comment()
	{
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
	}
	add_action('g5plus_after_single_post', 'g5plus_post_comment', 20);
}

if (!function_exists('g5plus_post_related')) {
	function g5plus_post_related()
	{
		get_template_part('templates/single/related');
	}

	add_action('g5plus_after_single_post', 'g5plus_post_related', 30);
}

// endregion single post

/**
 * Footer Template
 * *******************************************************
 */
if (!function_exists('g5plus_footer_template')) {
	function g5plus_footer_template()
	{
		g5plus_get_template('footer-template');
	}

	add_action('g5plus_main_wrapper_footer', 'g5plus_footer_template');
}

//////////////////////////////////////////////////////////////////
// Page Title
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_page_title')) {
	function g5plus_page_title(){
		get_template_part('templates/page-title');
	}
	add_action('g5plus_before_main_content','g5plus_page_title',5);
}

//////////////////////////////////////////////////////////////////
// Back To Top
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_back_to_top')) {
	function g5plus_back_to_top(){
		get_template_part('templates/back-to-top');
	}
	add_action('g5plus_after_page_wrapper','g5plus_back_to_top',5);
}

if(!function_exists('g5plus_remove_action_hook'))
{
	function g5plus_remove_action_hook()
	{
		if (function_exists('ere_template_hooks')) {
			remove_action('ere_sidebar_property', array($GLOBALS['ere_template_hooks'], 'sidebar_property'));
			remove_action('ere_sidebar_agent', array($GLOBALS['ere_template_hooks'], 'sidebar_agent'));
			remove_action('ere_sidebar_invoice', array($GLOBALS['ere_template_hooks'], 'sidebar_invoice'));
		}
	}
}
add_action( 'wp_head', 'g5plus_remove_action_hook' );

if (!function_exists('g5plus_template_site_start')) {
	function g5plus_template_site_start(){
		g5plus_get_template('global/site-start');
	}
	add_action('elementor/theme/after_do_header', 'g5plus_template_site_start');
}


if (!function_exists('g5plus_template_site_end')) {
	function g5plus_template_site_end(){
		g5plus_get_template('global/site-end');
	}
	add_action('elementor/theme/before_do_footer', 'g5plus_template_site_end');
}








