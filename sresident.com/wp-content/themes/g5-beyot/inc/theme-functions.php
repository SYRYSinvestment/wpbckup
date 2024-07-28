<?php
/**
 * GET theme option value
 * *******************************************************
 */
if (!function_exists('g5plus_get_option')) {
    function g5plus_get_option($key, $default = '')
    {
        if (function_exists('gf_get_option')) {
            return gf_get_option($key, $default);
        }
        return $default;
    }
}

/**
 * GET Meta Box Value
 * *******************************************************
 */
if (!function_exists('g5plus_get_post_meta')) {
    function g5plus_get_post_meta($key, $post_id = null)
    {
        if (function_exists('gf_get_post_meta')) {
            return gf_get_post_meta($key, $post_id);
        }
        return '';
    }
}

/**
 * GET Meta Box Image Value
 * *******************************************************
 */
if (!function_exists('g5plus_get_post_meta_image')) {
    function g5plus_get_post_meta_image($key, $post_id = null)
    {
        if (function_exists('gf_get_post_meta_image')) {
            return gf_get_post_meta_image($key, $post_id);
        }
        return '';
    }
}

/**
 * GET Current Preset ID
 * *******************************************************
 */
if (!function_exists('g5plus_get_current_preset')) {
    function g5plus_get_current_preset() {
        if (function_exists('gf_get_current_preset')) {
            return gf_get_current_preset();
        }
        return 0;
    }
}

/**
 * Get Preset Dir
 * *******************************************************
 */
if (!function_exists('g5plus_get_preset_dir')) {
    function g5plus_get_preset_dir() {
        return G5PLUS_THEME_DIR . 'assets/preset/';
    }
}

/**
 * Get Preset Url
 * *******************************************************
 */
if (!function_exists('g5plus_get_preset_url')) {
    function g5plus_get_preset_url() {
        return G5PLUS_THEME_URL . 'assets/preset/';
    }
}

/**
 * GET Category Binder
 * *******************************************************
 */
if (!function_exists('g5plus_categories_binder')) {
    function g5plus_categories_binder($categories, $parent,$class= 'search-category-dropdown', $is_anchor = false, $show_count = false) {
        $index = 0;
        $output = '';
        $parent .= '';
        foreach ($categories as $key => $term) {
            $term->parent .= '';
            if (($term->parent !== $parent)) {
                continue;
            }
            if ($index == 0) {
                $output = '<ul>';
                if ($parent == 0) {
                    $output = '<ul class="'. esc_attr($class) .'">';
                }
            }

            $output .= '<li>';
            $output .= sprintf('%s%s%s',
                $is_anchor ? '<a href="' .  get_term_link((int)$term->term_id, 'product_cat') . '" title="' . esc_attr($term->name) . '">' : '<span data-id="' . esc_attr($term->term_id) . '">',
                $show_count ? esc_html($term->name.' (' . $term->count . ')') : esc_html($term->name),
                $is_anchor ? '</a>' : '</span>'
            );
            $output .= g5plus_categories_binder($categories, $term->term_id,$class, $is_anchor,$show_count);
            $output .= '</li>';
            $index++;
        }

        if (!empty($output)) {
            $output .= '</ul>';
        }

        return $output;
    }
}

/**
 * Get template
 * *******************************************************
 */
if (!function_exists('g5plus_get_template')) {
    function g5plus_get_template($slug, $args = array())
    {
        if ($args && is_array($args)) {
            extract($args);
        }
        $located = locate_template(array("templates/{$slug}.php"));

        if (!file_exists($located)) {
            _doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $slug), '1.0');
            return;
        }
        include($located);
    }
}

////////////////////////////////////////////////////////////////////
// region Get breadcrumb items
if (!function_exists('g5plus_get_breadcrumb_items')) {
    function g5plus_get_breadcrumb_items() {
        global $wp_query;

        $item = array();
        /* Front page. */
        if (is_front_page()) {
            $item['last'] = esc_html__('Home', 'g5-beyot' );
        }


        /* Link to front page. */
        if (!is_front_page()) {
            $item[] = '<li><a href="' . home_url('/') . '" class="home">' . esc_html__('Home', 'g5-beyot' ) . '</a></li>';
        }

        /* If bbPress is installed and we're on a bbPress page. */
        if (function_exists('is_bbpress') && is_bbpress()) {
            $item = array_merge($item, g5plus_breadcrumb_get_bbpress_items());
        }
        elseif (is_home()) {
            $home_page = get_post($wp_query->get_queried_object_id());
            $item = array_merge($item, g5plus_breadcrumb_get_parents($home_page->post_parent));
            $item['last'] = get_the_title($home_page->ID);
        } /* If viewing a singular post. */
        elseif (is_singular()) {

            $post = $wp_query->get_queried_object();
            $post_id = (int)$wp_query->get_queried_object_id();
            $post_type = $post->post_type;

            $post_type_object = get_post_type_object($post_type);

            if ('post' === $wp_query->post->post_type) {
                $categories = get_the_category($post_id);
                $item = array_merge($item, g5plus_breadcrumb_get_term_parents($categories[0]->term_id, $categories[0]->taxonomy));
            }

            if ('page' !== $wp_query->post->post_type) {

                /* If there's an archive page, add it. */

                if (function_exists('get_post_type_archive_link') && !empty($post_type_object->has_archive))
                    $item[] = '<li><a href="' . get_post_type_archive_link($post_type) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . $post_type_object->labels->name . '</a></li>';

                if (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]) && is_taxonomy_hierarchical($args["singular_{$wp_query->post->post_type}_taxonomy"])) {
                    $terms = wp_get_object_terms($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"]);
                    $item = array_merge($item, g5plus_breadcrumb_get_term_parents($terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"]));
                } elseif (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]))
                    $item[] = get_the_term_list($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '');
            }

            if ((is_post_type_hierarchical($wp_query->post->post_type) || 'attachment' === $wp_query->post->post_type) && $parents = g5plus_breadcrumb_get_parents($wp_query->post->post_parent)) {
                $item = array_merge($item, $parents);
            }

            $item['last'] = get_the_title();
        } /* If viewing any type of archive. */
        else if (is_archive()) {

            if (is_category() || is_tag() || is_tax()) {

                $term = $wp_query->get_queried_object();
                //$taxonomy = get_taxonomy( $term->taxonomy );

                if ((is_taxonomy_hierarchical($term->taxonomy) && $term->parent) && $parents = g5plus_breadcrumb_get_term_parents($term->parent, $term->taxonomy))
                    $item = array_merge($item, $parents);

                $item['last'] = $term->name;
            } else if (function_exists('is_post_type_archive') && is_post_type_archive()) {
                $post_type_object = get_post_type_object(get_query_var('post_type'));
                if ($post_type_object) {
                    $item['last'] = $post_type_object->labels->name;
                }
            } else if (is_date()) {

                if (is_day())
                    $item['last'] = esc_html__('Archives for ', 'g5-beyot' ) . get_the_time('F j, Y');

                elseif (is_month())
                    $item['last'] = esc_html__('Archives for ', 'g5-beyot' ) . single_month_title(' ', false);

                elseif (is_year())
                    $item['last'] = esc_html__('Archives for ', 'g5-beyot' ) . get_the_time('Y');
            } else if (is_author())
            {
                $current_author = $wp_query->get_queried_object();
                $item['last'] = esc_html__('Author: ', 'g5-beyot' ) . get_the_author_meta('display_name', $current_author->ID);
            }


        } /* If viewing search results. */
        else if (is_search()) {
            $item['last'] = esc_html__('Search results', 'g5-beyot');
        }


        /* If viewing a 404 error page. */
        else if (is_404())
            $item['last'] = esc_html__('Page Not Found', 'g5-beyot' );


        if (isset($item['last'])) {
            $item['last'] = sprintf('<li><span>%s</span></li>', $item['last']);
        }


        return apply_filters('g5plus_framework_filter_breadcrumb_items', $item);
    }
}

if (!function_exists('g5plus_filter_breadcrumb_items')) {
    function g5plus_filter_breadcrumb_items()
    {
        $item = array();
        $shop_page_id = wc_get_page_id('shop');

        if (get_option('page_on_front') != $shop_page_id) {
            $shop_name = $shop_page_id ? get_the_title($shop_page_id) : '';
            if (!is_shop()) {
                $item[] = '<li><a href="' . get_permalink($shop_page_id) . '">' . $shop_name . '</a></li>';
            } else {
                $item['last'] = $shop_name;
            }
        }

        if (is_tax('product_cat') || is_tax('product_tag')) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

        } elseif (is_product()) {
            global $post;
            $terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'));
            if ($terms) {
                $current_term = $terms[0];
            }

        }

        if (!empty($current_term)) {
            if (is_taxonomy_hierarchical($current_term->taxonomy)) {
                $item = array_merge($item, g5plus_breadcrumb_get_term_parents($current_term->parent, $current_term->taxonomy));
            }

            if (is_tax('product_cat') || is_tax('product_tag')) {
                $item['last'] = $current_term->name;
            } else {
                $item[] = '<li><a href="' . get_term_link($current_term->term_id, $current_term->taxonomy) . '">' . $current_term->name . '</a></li>';
            }
        }

        if (is_product()) {
            $item['last'] = get_the_title();
        }

        return apply_filters('g5plus_filter_breadcrumb_items', $item);
    }
}

if (!function_exists('g5plus_breadcrumb_get_bbpress_items')) {
    function g5plus_breadcrumb_get_bbpress_items()
    {
        $item = array();
        $shop_page_id = wc_get_page_id('shop');

        if (get_option('page_on_front') != $shop_page_id) {
            $shop_name = $shop_page_id ? get_the_title($shop_page_id) : '';
            if (!is_shop()) {
                $item[] = '<li><a href="' . get_permalink($shop_page_id) . '">' . $shop_name . '</a></li>';
            } else {
                $item['last'] = $shop_name;
            }
        }

        if (is_tax('product_cat') || is_tax('product_tag')) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

        } elseif (is_product()) {
            global $post;
            $terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'));
            if ($terms) {
                $current_term = $terms[0];
            }

        }

        if (!empty($current_term)) {
            if (is_taxonomy_hierarchical($current_term->taxonomy)) {
                $item = array_merge($item, g5plus_breadcrumb_get_term_parents($current_term->parent, $current_term->taxonomy));
            }

            if (is_tax('product_cat') || is_tax('product_tag')) {
                $item['last'] = $current_term->name;
            } else {
                $item[] = '<li><a href="' . get_term_link($current_term->term_id, $current_term->taxonomy) . '">' . $current_term->name . '</a></li>';
            }
        }

        if (is_product()) {
            $item['last'] = get_the_title();
        }

        return apply_filters('g5plus_filter_breadcrumb_items', $item);
    }
}

if (!function_exists('g5plus_breadcrumb_get_parents')) {
    function g5plus_breadcrumb_get_parents($post_id = '', $separator = '/')
    {
        $parents = array();

        if ($post_id == 0) {
            return $parents;
        }

        while ($post_id) {
            $page = get_post($post_id);
            $parents[] = '<li><a href="' . get_permalink($post_id) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . get_the_title($post_id) . '</a></li>';
            $post_id = $page->post_parent;
        }

        if ($parents) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }
}

if (!function_exists('g5plus_breadcrumb_get_term_parents')) {
    function g5plus_breadcrumb_get_term_parents($parent_id = '', $taxonomy = '', $separator = '/')
    {
        $parents = array();

        if (empty($parent_id) || empty($taxonomy)) {
            return $parents;
        }

        while ($parent_id) {
            $parent = get_term($parent_id, $taxonomy);
            $parents[] = '<li><a href="' . get_term_link($parent, $taxonomy) . '" title="' . esc_attr($parent->name) . '">' . $parent->name . '</a></li>';
            $parent_id = $parent->parent;
        }

        if ($parents) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }
}

// endregion
////////////////////////////////////////////////////////////////////


/**
 * Get image src
 */
if (!function_exists('g5plus_get_image_src')) {
    function g5plus_get_image_src($image_id,$size) {
        $image_src = '';
        $image_sizes = g5plus_get_image_size($size);
        if (isset($image_sizes)) {
            $width = $image_sizes['width'];
            $height = $image_sizes['height'];
            $image_src = matthewruddy_image_resize_id($image_id,$width,$height);
        }else {
            $image_src_arr = wp_get_attachment_image_src( $image_id, $size );
            if ($image_src_arr) {
                $image_src = $image_src_arr[0];
            }
        }
        return $image_src;
    }
}

/**
 * Get post thumbnail
 * *******************************************************
 */
if (!function_exists('g5plus_get_post_thumbnail')) {
    function g5plus_get_post_thumbnail( $size, $noImage = 0, $is_single = false )
    {
        $args = array(
            'size' => $size,
            'noImage'   => $noImage,
            'is_single' => $is_single
        );
        g5plus_get_template('archive/thumbnail',$args);
    }
}

/**
 * Get post image
 * *******************************************************
 */
if (!function_exists('g5plus_get_post_image')) {
    function g5plus_get_post_image($image_id, $size, $gallery = 0, $is_single = false)
    {
        $image_src = '';
        $image_size = g5plus_get_image_size($size);
        if (isset($image_size['width']) && isset($image_size['height'])) {
            $width = $image_size['width'];
            $height = $image_size['height'];
            $image_src = matthewruddy_image_resize_id($image_id,$width,$height);
        }else {
            $image_src_arr = wp_get_attachment_image_src( $image_id, $size );
            if ($image_src_arr) {
                $image_src = $image_src_arr[0];
            }
        }

        if (!empty($image_src)) {
            g5plus_get_image_hover($image_id, $image_src, $size, get_permalink(), the_title_attribute('echo=0'), $gallery, $is_single);
        }
    }
}

/**
 * Get image hover
 * *******************************************************
 */
if (!function_exists('g5plus_get_image_hover')) {
    function g5plus_get_image_hover($image_id, $image_src, $size, $link, $title, $gallery = 0, $is_single = false)
    {
        $image_full_arr = wp_get_attachment_image_src($image_id,'full');
        $image_full_src = $image_src;
        $image_thumb = wp_get_attachment_image_src($image_id);
        $image_thumb_link = '';
        if (sizeof($image_thumb) > 0) {
            $image_thumb_link = $image_thumb['0'];
        }
        if ($image_full_arr) {
            $image_full_src = $image_full_arr[0];
        }
        $width = '';
        $height = '';
        $image_size = g5plus_get_image_size($size);
        if (isset($image_size['width']) && $image_size['height']) {
            $width = $image_size['width'];
            $height = $image_size['height'];
        } else {
            $_wp_additional_image_sizes = get_intermediate_image_sizes();
            if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
                $width = get_option( $size . '_size_w' );
                $height = get_option( $size . '_size_h' );
            } elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
                $width = $_wp_additional_image_sizes[ $size ]['width'];
                $height = $_wp_additional_image_sizes[ $size ]['height'];
            }
        }
        $args = array(
            'image_src' => $image_src,
            'image_full_src' => $image_full_src,
            'image_thumb_link' => $image_thumb_link,
            'width' => $width,
            'height' => $height,
            'link'      => $link,
            'title'     => $title,
            'galleryId' => $gallery,
            'is_single' => $is_single
        );
        g5plus_get_template('archive/image-hover',$args);
    }
}

/**
 * Get image size
 * *******************************************************
 */
if (!function_exists('g5plus_get_image_size')) {
    function g5plus_get_image_size($size) {
        $image_sizes = apply_filters('g5plus_image_size',array(
            'large-image' => array(
                'width' => 1170,
                'height' => 380
            ),
            'medium-image' => array(
                'width' => 570,
                'height' => 400
            ),
            'small-image' => array(
                'width' => 170,
                'height' => 170
            )
        ));
        if(isset($image_sizes[$size])){
            return $image_sizes[$size];
        }else{
            return null;
        }
    }
}

/**
 * Get String Limit Words
 * *******************************************************
 */
if (!function_exists('g5plus_string_limit_words')) {
    function g5plus_string_limit_words($string, $word_limit)
    {
        $words = explode(' ', $string, ($word_limit + 1));

        if(count($words) > $word_limit) {
            array_pop($words);
        }

        return implode(' ', $words);
    }
}

/**
 * Render comments
 * *******************************************************
 */
if (!function_exists('g5plus_render_comments')) {
    function g5plus_render_comments($comment, $args, $depth) {
        g5plus_get_template('single/comment',array('comment' => $comment, 'args' => $args, 'depth' => $depth));
    }
}

/**
 * Get Tax meta with key not prefix
 * *******************************************************
 */
if ( !function_exists( 'g5plus_get_tax_meta') ) {
    function g5plus_get_tax_meta($term_id,$key,$multi = false) {
        if(defined('GF_METABOX_PREFIX')){
            if ( function_exists('get_term_meta')){
                return get_term_meta($term_id, GF_METABOX_PREFIX . $key, !$multi );
            }else{
                return get_tax_meta( $term_id, GF_METABOX_PREFIX . $key, !$multi  );
            }
        }else{
            return '';
        }

    }
}

//////////////////////////////////////////////////////////////////
// Get Page Layout Settings
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_page_layout_settings')) {
    function &g5plus_get_page_layout_settings(){
        $key_page_layout_settings = 'g5plus_page_layout_settings';
        if (isset($GLOBALS[$key_page_layout_settings]) && is_array($GLOBALS[$key_page_layout_settings])) {
            return $GLOBALS[$key_page_layout_settings];
        }
        $GLOBALS[$key_page_layout_settings] = array(
            'layout'                 => g5plus_get_option( 'layout','container' ),
            'sidebar_layout'         => g5plus_get_option( 'sidebar_layout','right' ),
            'sidebar'                => g5plus_get_option( 'sidebar','main-sidebar' ),
            'sidebar_width'          => g5plus_get_option( 'sidebar_width','small' ),
            'sidebar_mobile_enable'  => g5plus_get_option( 'sidebar_mobile_enable',1 ),
            'sidebar_mobile_canvas'  => g5plus_get_option( 'sidebar_mobile_canvas',1 ),
            'padding'                => g5plus_get_option( 'content_padding',array('top' => '70', 'bottom' => '70') ),
            'padding_mobile'         => g5plus_get_option( 'content_padding_mobile',array('top' => '30', 'bottom' => '30') ),
            'remove_content_padding' => 0,
            'has_sidebar' => 1
        );
        return $GLOBALS[$key_page_layout_settings];
    }
}

//////////////////////////////////////////////////////////////////
// Get Post Layout Settings
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_post_layout_settings')){
    function &g5plus_get_post_layout_settings(){
        $key_post_layout_settings = 'g5plus_post_layout_settings';
        if (isset($GLOBALS[$key_post_layout_settings]) && is_array($GLOBALS[$key_post_layout_settings])) {
            return $GLOBALS[$key_post_layout_settings];
        }

        $GLOBALS[$key_post_layout_settings] = array(
            'layout'      => g5plus_get_option('post_layout','large-image'),
            'columns' => g5plus_get_option('post_column',3),
            'paging'      => g5plus_get_option('post_paging','navigation'),
            'slider'      => false
        );

        return $GLOBALS[$key_post_layout_settings];
    }
}

//////////////////////////////////////////////////////////////////
// Social share
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_the_social_share')){
    function g5plus_the_social_share(){
        get_template_part('templates/social-share');
    }
}
/**
 * Get Fonts Awesome Array
 * *******************************************************
 */
if (!function_exists('g5plus_get_font_awesome')) {
    function &g5plus_get_font_awesome() {
        if (isset($GLOBALS['g5plus_font_awesome']) && is_array($GLOBALS['g5plus_font_awesome'])) {
            return $GLOBALS['g5plus_font_awesome'];
        }
        $GLOBALS['g5plus_font_awesome'] = apply_filters('g5plus_font_awesome', array(
            array('fa fa-500px' => 'fa-500px'), array('fa fa-adjust' => 'fa-adjust'), array('fa fa-adn' => 'fa-adn'), array('fa fa-align-center' => 'fa-align-center'), array('fa fa-align-justify' => 'fa-align-justify'), array('fa fa-align-left' => 'fa-align-left'), array('fa fa-align-right' => 'fa-align-right'), array('fa fa-amazon' => 'fa-amazon'), array('fa fa-ambulance' => 'fa-ambulance'), array('fa fa-anchor' => 'fa-anchor'), array('fa fa-android' => 'fa-android'), array('fa fa-angellist' => 'fa-angellist'), array('fa fa-angle-double-down' => 'fa-angle-double-down'), array('fa fa-angle-double-left' => 'fa-angle-double-left'), array('fa fa-angle-double-right' => 'fa-angle-double-right'), array('fa fa-angle-double-up' => 'fa-angle-double-up'), array('fa fa-angle-down' => 'fa-angle-down'), array('fa fa-angle-left' => 'fa-angle-left'), array('fa fa-angle-right' => 'fa-angle-right'), array('fa fa-angle-up' => 'fa-angle-up'), array('fa fa-apple' => 'fa-apple'), array('fa fa-archive' => 'fa-archive'), array('fa fa-area-chart' => 'fa-area-chart'), array('fa fa-arrow-circle-down' => 'fa-arrow-circle-down'), array('fa fa-arrow-circle-left' => 'fa-arrow-circle-left'), array('fa fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down'), array('fa fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left'), array('fa fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right'), array('fa fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up'), array('fa fa-arrow-circle-right' => 'fa-arrow-circle-right'), array('fa fa-arrow-circle-up' => 'fa-arrow-circle-up'), array('fa fa-arrow-down' => 'fa-arrow-down'), array('fa fa-arrow-left' => 'fa-arrow-left'), array('fa fa-arrow-right' => 'fa-arrow-right'), array('fa fa-arrow-up' => 'fa-arrow-up'), array('fa fa-arrows' => 'fa-arrows'), array('fa fa-arrows-alt' => 'fa-arrows-alt'), array('fa fa-arrows-h' => 'fa-arrows-h'), array('fa fa-arrows-v' => 'fa-arrows-v'), array('fa fa-asterisk' => 'fa-asterisk'), array('fa fa-at' => 'fa-at'), array('fa fa-automobile' => 'fa-automobile'), array('fa fa-backward' => 'fa-backward'), array('fa fa-balance-scale' => 'fa-balance-scale'), array('fa fa-ban' => 'fa-ban'), array('fa fa-bank' => 'fa-bank'), array('fa fa-bar-chart' => 'fa-bar-chart'), array('fa fa-bar-chart-o' => 'fa-bar-chart-o'), array('fa fa-barcode' => 'fa-barcode'), array('fa fa-bars' => 'fa-bars'), array('fa fa-battery-0' => 'fa-battery-0'), array('fa fa-battery-1' => 'fa-battery-1'), array('fa fa-battery-2' => 'fa-battery-2'), array('fa fa-battery-3' => 'fa-battery-3'), array('fa fa-battery-4' => 'fa-battery-4'), array('fa fa-battery-empty' => 'fa-battery-empty'), array('fa fa-battery-full' => 'fa-battery-full'), array('fa fa-battery-half' => 'fa-battery-half'), array('fa fa-battery-quarter' => 'fa-battery-quarter'), array('fa fa-battery-three-quarters' => 'fa-battery-three-quarters'), array('fa fa-bed' => 'fa-bed'), array('fa fa-beer' => 'fa-beer'), array('fa fa-behance' => 'fa-behance'), array('fa fa-behance-square' => 'fa-behance-square'), array('fa fa-bell' => 'fa-bell'), array('fa fa-bell-o' => 'fa-bell-o'), array('fa fa-bell-slash' => 'fa-bell-slash'), array('fa fa-bell-slash-o' => 'fa-bell-slash-o'), array('fa fa-bicycle' => 'fa-bicycle'), array('fa fa-binoculars' => 'fa-binoculars'), array('fa fa-birthday-cake' => 'fa-birthday-cake'), array('fa fa-bitbucket' => 'fa-bitbucket'), array('fa fa-bitbucket-square' => 'fa-bitbucket-square'), array('fa fa-bitcoin' => 'fa-bitcoin'), array('fa fa-black-tie' => 'fa-black-tie'), array('fa fa-bluetooth' => 'fa-bluetooth'), array('fa fa-bluetooth-b' => 'fa-bluetooth-b'), array('fa fa-bold' => 'fa-bold'), array('fa fa-bolt' => 'fa-bolt'), array('fa fa-bomb' => 'fa-bomb'), array('fa fa-book' => 'fa-book'), array('fa fa-bookmark' => 'fa-bookmark'), array('fa fa-bookmark-o' => 'fa-bookmark-o'), array('fa fa-briefcase' => 'fa-briefcase'), array('fa fa-btc' => 'fa-btc'), array('fa fa-bug' => 'fa-bug'), array('fa fa-building' => 'fa-building'), array('fa fa-building-o' => 'fa-building-o'), array('fa fa-bullhorn' => 'fa-bullhorn'), array('fa fa-bullseye' => 'fa-bullseye'), array('fa fa-bus' => 'fa-bus'), array('fa fa-buysellads' => 'fa-buysellads'), array('fa fa-cab' => 'fa-cab'), array('fa fa-calculator' => 'fa-calculator'), array('fa fa-calendar' => 'fa-calendar'), array('fa fa-calendar-check-o' => 'fa-calendar-check-o'), array('fa fa-calendar-minus-o' => 'fa-calendar-minus-o'), array('fa fa-calendar-o' => 'fa-calendar-o'), array('fa fa-calendar-plus-o' => 'fa-calendar-plus-o'), array('fa fa-calendar-times-o' => 'fa-calendar-times-o'), array('fa fa-camera' => 'fa-camera'), array('fa fa-camera-retro' => 'fa-camera-retro'), array('fa fa-car' => 'fa-car'), array('fa fa-caret-down' => 'fa-caret-down'), array('fa fa-caret-left' => 'fa-caret-left'), array('fa fa-caret-right' => 'fa-caret-right'), array('fa fa-caret-square-o-down' => 'fa-caret-square-o-down'), array('fa fa-caret-square-o-left' => 'fa-caret-square-o-left'), array('fa fa-caret-square-o-right' => 'fa-caret-square-o-right'), array('fa fa-caret-square-o-up' => 'fa-caret-square-o-up'), array('fa fa-caret-up' => 'fa-caret-up'), array('fa fa-cart-arrow-down' => 'fa-cart-arrow-down'), array('fa fa-cart-plus' => 'fa-cart-plus'), array('fa fa-cc' => 'fa-cc'), array('fa fa-cc-amex' => 'fa-cc-amex'), array('fa fa-cc-diners-club' => 'fa-cc-diners-club'), array('fa fa-cc-discover' => 'fa-cc-discover'), array('fa fa-cc-jcb' => 'fa-cc-jcb'), array('fa fa-cc-mastercard' => 'fa-cc-mastercard'), array('fa fa-cc-paypal' => 'fa-cc-paypal'), array('fa fa-cc-stripe' => 'fa-cc-stripe'), array('fa fa-cc-visa' => 'fa-cc-visa'), array('fa fa-certificate' => 'fa-certificate'), array('fa fa-chain' => 'fa-chain'), array('fa fa-chain-broken' => 'fa-chain-broken'), array('fa fa-check' => 'fa-check'), array('fa fa-check-circle' => 'fa-check-circle'), array('fa fa-check-circle-o' => 'fa-check-circle-o'), array('fa fa-check-square' => 'fa-check-square'), array('fa fa-check-square-o' => 'fa-check-square-o'), array('fa fa-chevron-circle-down' => 'fa-chevron-circle-down'), array('fa fa-chevron-circle-left' => 'fa-chevron-circle-left'), array('fa fa-chevron-circle-right' => 'fa-chevron-circle-right'), array('fa fa-chevron-circle-up' => 'fa-chevron-circle-up'), array('fa fa-chevron-down' => 'fa-chevron-down'), array('fa fa-chevron-left' => 'fa-chevron-left'), array('fa fa-chevron-right' => 'fa-chevron-right'), array('fa fa-chevron-up' => 'fa-chevron-up'), array('fa fa-child' => 'fa-child'), array('fa fa-chrome' => 'fa-chrome'), array('fa fa-circle' => 'fa-circle'), array('fa fa-circle-o' => 'fa-circle-o'), array('fa fa-circle-o-notch' => 'fa-circle-o-notch'), array('fa fa-circle-thin' => 'fa-circle-thin'), array('fa fa-clipboard' => 'fa-clipboard'), array('fa fa-clock-o' => 'fa-clock-o'), array('fa fa-clone' => 'fa-clone'), array('fa fa-close' => 'fa-close'), array('fa fa-cloud' => 'fa-cloud'), array('fa fa-cloud-download' => 'fa-cloud-download'), array('fa fa-cloud-upload' => 'fa-cloud-upload'), array('fa fa-cny' => 'fa-cny'), array('fa fa-code' => 'fa-code'), array('fa fa-code-fork' => 'fa-code-fork'), array('fa fa-codepen' => 'fa-codepen'), array('fa fa-codiepie' => 'fa-codiepie'), array('fa fa-coffee' => 'fa-coffee'), array('fa fa-cog' => 'fa-cog'), array('fa fa-cogs' => 'fa-cogs'), array('fa fa-columns' => 'fa-columns'), array('fa fa-comment' => 'fa-comment'), array('fa fa-comment-o' => 'fa-comment-o'), array('fa fa-commenting' => 'fa-commenting'), array('fa fa-commenting-o' => 'fa-commenting-o'), array('fa fa-comments' => 'fa-comments'), array('fa fa-comments-o' => 'fa-comments-o'), array('fa fa-compass' => 'fa-compass'), array('fa fa-compress' => 'fa-compress'), array('fa fa-connectdevelop' => 'fa-connectdevelop'), array('fa fa-contao' => 'fa-contao'), array('fa fa-copy' => 'fa-copy'), array('fa fa-copyright' => 'fa-copyright'), array('fa fa-creative-commons' => 'fa-creative-commons'), array('fa fa-credit-card' => 'fa-credit-card'), array('fa fa-credit-card-alt' => 'fa-credit-card-alt'), array('fa fa-crop' => 'fa-crop'), array('fa fa-crosshairs' => 'fa-crosshairs'), array('fa fa-css3' => 'fa-css3'), array('fa fa-cube' => 'fa-cube'), array('fa fa-cubes' => 'fa-cubes'), array('fa fa-cut' => 'fa-cut'), array('fa fa-cutlery' => 'fa-cutlery'), array('fa fa-dashboard' => 'fa-dashboard'), array('fa fa-dashcube' => 'fa-dashcube'), array('fa fa-database' => 'fa-database'), array('fa fa-dedent' => 'fa-dedent'), array('fa fa-delicious' => 'fa-delicious'), array('fa fa-desktop' => 'fa-desktop'), array('fa fa-deviantart' => 'fa-deviantart'), array('fa fa-diamond' => 'fa-diamond'), array('fa fa-digg' => 'fa-digg'), array('fa fa-dollar' => 'fa-dollar'), array('fa fa-dot-circle-o' => 'fa-dot-circle-o'), array('fa fa-download' => 'fa-download'), array('fa fa-dribbble' => 'fa-dribbble'), array('fa fa-dropbox' => 'fa-dropbox'), array('fa fa-drupal' => 'fa-drupal'), array('fa fa-edge' => 'fa-edge'), array('fa fa-edit' => 'fa-edit'), array('fa fa-eject' => 'fa-eject'), array('fa fa-ellipsis-h' => 'fa-ellipsis-h'), array('fa fa-ellipsis-v' => 'fa-ellipsis-v'), array('fa fa-empire' => 'fa-empire'), array('fa fa-envelope' => 'fa-envelope'), array('fa fa-envelope-o' => 'fa-envelope-o'), array('fa fa-envelope-square' => 'fa-envelope-square'), array('fa fa-eraser' => 'fa-eraser'), array('fa fa-eur' => 'fa-eur'), array('fa fa-euro' => 'fa-euro'), array('fa fa-exchange' => 'fa-exchange'), array('fa fa-exclamation' => 'fa-exclamation'), array('fa fa-exclamation-circle' => 'fa-exclamation-circle'), array('fa fa-exclamation-triangle' => 'fa-exclamation-triangle'), array('fa fa-expand' => 'fa-expand'), array('fa fa-expeditedssl' => 'fa-expeditedssl'), array('fa fa-external-link' => 'fa-external-link'), array('fa fa-external-link-square' => 'fa-external-link-square'), array('fa fa-eye' => 'fa-eye'), array('fa fa-eye-slash' => 'fa-eye-slash'), array('fa fa-eyedropper' => 'fa-eyedropper'), array('fa fa-facebook' => 'fa-facebook'), array('fa fa-facebook-f' => 'fa-facebook-f'), array('fa fa-facebook-official' => 'fa-facebook-official'), array('fa fa-facebook-square' => 'fa-facebook-square'), array('fa fa-fast-backward' => 'fa-fast-backward'), array('fa fa-fast-forward' => 'fa-fast-forward'), array('fa fa-fax' => 'fa-fax'), array('fa fa-feed' => 'fa-feed'), array('fa fa-female' => 'fa-female'), array('fa fa-fighter-jet' => 'fa-fighter-jet'), array('fa fa-file' => 'fa-file'), array('fa fa-file-archive-o' => 'fa-file-archive-o'), array('fa fa-file-audio-o' => 'fa-file-audio-o'), array('fa fa-file-code-o' => 'fa-file-code-o'), array('fa fa-file-excel-o' => 'fa-file-excel-o'), array('fa fa-file-image-o' => 'fa-file-image-o'), array('fa fa-file-movie-o' => 'fa-file-movie-o'), array('fa fa-file-o' => 'fa-file-o'), array('fa fa-file-pdf-o' => 'fa-file-pdf-o'), array('fa fa-file-photo-o' => 'fa-file-photo-o'), array('fa fa-file-picture-o' => 'fa-file-picture-o'), array('fa fa-file-powerpoint-o' => 'fa-file-powerpoint-o'), array('fa fa-file-sound-o' => 'fa-file-sound-o'), array('fa fa-file-text' => 'fa-file-text'), array('fa fa-file-text-o' => 'fa-file-text-o'), array('fa fa-file-video-o' => 'fa-file-video-o'), array('fa fa-file-word-o' => 'fa-file-word-o'), array('fa fa-file-zip-o' => 'fa-file-zip-o'), array('fa fa-files-o' => 'fa-files-o'), array('fa fa-film' => 'fa-film'), array('fa fa-filter' => 'fa-filter'), array('fa fa-fire' => 'fa-fire'), array('fa fa-fire-extinguisher' => 'fa-fire-extinguisher'), array('fa fa-firefox' => 'fa-firefox'), array('fa fa-flag' => 'fa-flag'), array('fa fa-flag-checkered' => 'fa-flag-checkered'), array('fa fa-flag-o' => 'fa-flag-o'), array('fa fa-flash' => 'fa-flash'), array('fa fa-flask' => 'fa-flask'), array('fa fa-flickr' => 'fa-flickr'), array('fa fa-floppy-o' => 'fa-floppy-o'), array('fa fa-folder' => 'fa-folder'), array('fa fa-folder-o' => 'fa-folder-o'), array('fa fa-folder-open' => 'fa-folder-open'), array('fa fa-folder-open-o' => 'fa-folder-open-o'), array('fa fa-font' => 'fa-font'), array('fa fa-fonticons' => 'fa-fonticons'), array('fa fa-fort-awesome' => 'fa-fort-awesome'), array('fa fa-forumbee' => 'fa-forumbee'), array('fa fa-forward' => 'fa-forward'), array('fa fa-foursquare' => 'fa-foursquare'), array('fa fa-frown-o' => 'fa-frown-o'), array('fa fa-futbol-o' => 'fa-futbol-o'), array('fa fa-gamepad' => 'fa-gamepad'), array('fa fa-gavel' => 'fa-gavel'), array('fa fa-gbp' => 'fa-gbp'), array('fa fa-ge' => 'fa-ge'), array('fa fa-gear' => 'fa-gear'), array('fa fa-gears' => 'fa-gears'), array('fa fa-genderless' => 'fa-genderless'), array('fa fa-get-pocket' => 'fa-get-pocket'), array('fa fa-gg' => 'fa-gg'), array('fa fa-gg-circle' => 'fa-gg-circle'), array('fa fa-gift' => 'fa-gift'), array('fa fa-git' => 'fa-git'), array('fa fa-git-square' => 'fa-git-square'), array('fa fa-github' => 'fa-github'), array('fa fa-github-alt' => 'fa-github-alt'), array('fa fa-github-square' => 'fa-github-square'), array('fa fa-gittip' => 'fa-gittip'), array('fa fa-glass' => 'fa-glass'), array('fa fa-globe' => 'fa-globe'), array('fa fa-google' => 'fa-google'), array('fa fa-google-plus' => 'fa-google-plus'), array('fa fa-google-plus-square' => 'fa-google-plus-square'), array('fa fa-google-wallet' => 'fa-google-wallet'), array('fa fa-graduation-cap' => 'fa-graduation-cap'), array('fa fa-gratipay' => 'fa-gratipay'), array('fa fa-group' => 'fa-group'), array('fa fa-h-square' => 'fa-h-square'), array('fa fa-hacker-news' => 'fa-hacker-news'), array('fa fa-hand-grab-o' => 'fa-hand-grab-o'), array('fa fa-hand-lizard-o' => 'fa-hand-lizard-o'), array('fa fa-hand-o-down' => 'fa-hand-o-down'), array('fa fa-hand-o-left' => 'fa-hand-o-left'), array('fa fa-hand-o-right' => 'fa-hand-o-right'), array('fa fa-hand-o-up' => 'fa-hand-o-up'), array('fa fa-hand-paper-o' => 'fa-hand-paper-o'), array('fa fa-hand-peace-o' => 'fa-hand-peace-o'), array('fa fa-hand-pointer-o' => 'fa-hand-pointer-o'), array('fa fa-hand-rock-o' => 'fa-hand-rock-o'), array('fa fa-hand-scissors-o' => 'fa-hand-scissors-o'), array('fa fa-hand-spock-o' => 'fa-hand-spock-o'), array('fa fa-hand-stop-o' => 'fa-hand-stop-o'), array('fa fa-hashtag' => 'fa-hashtag'), array('fa fa-hdd-o' => 'fa-hdd-o'), array('fa fa-header' => 'fa-header'), array('fa fa-headphones' => 'fa-headphones'), array('fa fa-heart' => 'fa-heart'), array('fa fa-heart-o' => 'fa-heart-o'), array('fa fa-heartbeat' => 'fa-heartbeat'), array('fa fa-history' => 'fa-history'), array('fa fa-home' => 'fa-home'), array('fa fa-hospital-o' => 'fa-hospital-o'), array('fa fa-hotel' => 'fa-hotel'), array('fa fa-hourglass' => 'fa-hourglass'), array('fa fa-hourglass-1' => 'fa-hourglass-1'), array('fa fa-hourglass-2' => 'fa-hourglass-2'), array('fa fa-hourglass-3' => 'fa-hourglass-3'), array('fa fa-hourglass-end' => 'fa-hourglass-end'), array('fa fa-hourglass-half' => 'fa-hourglass-half'), array('fa fa-hourglass-o' => 'fa-hourglass-o'), array('fa fa-hourglass-start' => 'fa-hourglass-start'), array('fa fa-houzz' => 'fa-houzz'), array('fa fa-html5' => 'fa-html5'), array('fa fa-i-cursor' => 'fa-i-cursor'), array('fa fa-ils' => 'fa-ils'), array('fa fa-image' => 'fa-image'), array('fa fa-inbox' => 'fa-inbox'), array('fa fa-indent' => 'fa-indent'), array('fa fa-industry' => 'fa-industry'), array('fa fa-info' => 'fa-info'), array('fa fa-info-circle' => 'fa-info-circle'), array('fa fa-inr' => 'fa-inr'), array('fa fa-instagram' => 'fa-instagram'), array('fa fa-institution' => 'fa-institution'), array('fa fa-internet-explorer' => 'fa-internet-explorer'), array('fa fa-intersex' => 'fa-intersex'), array('fa fa-ioxhost' => 'fa-ioxhost'), array('fa fa-italic' => 'fa-italic'), array('fa fa-joomla' => 'fa-joomla'), array('fa fa-jpy' => 'fa-jpy'), array('fa fa-jsfiddle' => 'fa-jsfiddle'), array('fa fa-key' => 'fa-key'), array('fa fa-keyboard-o' => 'fa-keyboard-o'), array('fa fa-krw' => 'fa-krw'), array('fa fa-language' => 'fa-language'), array('fa fa-laptop' => 'fa-laptop'), array('fa fa-lastfm' => 'fa-lastfm'), array('fa fa-lastfm-square' => 'fa-lastfm-square'), array('fa fa-leaf' => 'fa-leaf'), array('fa fa-leanpub' => 'fa-leanpub'), array('fa fa-legal' => 'fa-legal'), array('fa fa-lemon-o' => 'fa-lemon-o'), array('fa fa-level-down' => 'fa-level-down'), array('fa fa-level-up' => 'fa-level-up'), array('fa fa-life-bouy' => 'fa-life-bouy'), array('fa fa-life-buoy' => 'fa-life-buoy'), array('fa fa-life-ring' => 'fa-life-ring'), array('fa fa-life-saver' => 'fa-life-saver'), array('fa fa-lightbulb-o' => 'fa-lightbulb-o'), array('fa fa-line-chart' => 'fa-line-chart'), array('fa fa-link' => 'fa-link'), array('fa fa-linkedin' => 'fa-linkedin'), array('fa fa-linkedin-square' => 'fa-linkedin-square'), array('fa fa-linux' => 'fa-linux'), array('fa fa-list' => 'fa-list'), array('fa fa-list-alt' => 'fa-list-alt'), array('fa fa-list-ol' => 'fa-list-ol'), array('fa fa-list-ul' => 'fa-list-ul'), array('fa fa-location-arrow' => 'fa-location-arrow'), array('fa fa-lock' => 'fa-lock'), array('fa fa-long-arrow-down' => 'fa-long-arrow-down'), array('fa fa-long-arrow-left' => 'fa-long-arrow-left'), array('fa fa-long-arrow-right' => 'fa-long-arrow-right'), array('fa fa-long-arrow-up' => 'fa-long-arrow-up'), array('fa fa-magic' => 'fa-magic'), array('fa fa-magnet' => 'fa-magnet'), array('fa fa-mail-forward' => 'fa-mail-forward'), array('fa fa-mail-reply' => 'fa-mail-reply'), array('fa fa-mail-reply-all' => 'fa-mail-reply-all'), array('fa fa-male' => 'fa-male'), array('fa fa-map' => 'fa-map'), array('fa fa-map-marker' => 'fa-map-marker'), array('fa fa-map-o' => 'fa-map-o'), array('fa fa-map-pin' => 'fa-map-pin'), array('fa fa-map-signs' => 'fa-map-signs'), array('fa fa-mars' => 'fa-mars'), array('fa fa-mars-double' => 'fa-mars-double'), array('fa fa-mars-stroke' => 'fa-mars-stroke'), array('fa fa-mars-stroke-h' => 'fa-mars-stroke-h'), array('fa fa-mars-stroke-v' => 'fa-mars-stroke-v'), array('fa fa-maxcdn' => 'fa-maxcdn'), array('fa fa-meanpath' => 'fa-meanpath'), array('fa fa-medium' => 'fa-medium'), array('fa fa-medkit' => 'fa-medkit'), array('fa fa-meh-o' => 'fa-meh-o'), array('fa fa-mercury' => 'fa-mercury'), array('fa fa-microphone' => 'fa-microphone'), array('fa fa-microphone-slash' => 'fa-microphone-slash'), array('fa fa-minus' => 'fa-minus'), array('fa fa-minus-circle' => 'fa-minus-circle'), array('fa fa-minus-square' => 'fa-minus-square'), array('fa fa-minus-square-o' => 'fa-minus-square-o'), array('fa fa-mixcloud' => 'fa-mixcloud'), array('fa fa-mobile' => 'fa-mobile'), array('fa fa-mobile-phone' => 'fa-mobile-phone'), array('fa fa-modx' => 'fa-modx'), array('fa fa-money' => 'fa-money'), array('fa fa-moon-o' => 'fa-moon-o'), array('fa fa-mortar-board' => 'fa-mortar-board'), array('fa fa-motorcycle' => 'fa-motorcycle'), array('fa fa-mouse-pointer' => 'fa-mouse-pointer'), array('fa fa-music' => 'fa-music'), array('fa fa-navicon' => 'fa-navicon'), array('fa fa-neuter' => 'fa-neuter'), array('fa fa-newspaper-o' => 'fa-newspaper-o'), array('fa fa-object-group' => 'fa-object-group'), array('fa fa-object-ungroup' => 'fa-object-ungroup'), array('fa fa-odnoklassniki' => 'fa-odnoklassniki'), array('fa fa-odnoklassniki-square' => 'fa-odnoklassniki-square'), array('fa fa-opencart' => 'fa-opencart'), array('fa fa-openid' => 'fa-openid'), array('fa fa-opera' => 'fa-opera'), array('fa fa-optin-monster' => 'fa-optin-monster'), array('fa fa-outdent' => 'fa-outdent'), array('fa fa-pagelines' => 'fa-pagelines'), array('fa fa-paint-brush' => 'fa-paint-brush'), array('fa fa-paper-plane' => 'fa-paper-plane'), array('fa fa-paper-plane-o' => 'fa-paper-plane-o'), array('fa fa-paperclip' => 'fa-paperclip'), array('fa fa-paragraph' => 'fa-paragraph'), array('fa fa-paste' => 'fa-paste'), array('fa fa-pause' => 'fa-pause'), array('fa fa-pause-circle' => 'fa-pause-circle'), array('fa fa-pause-circle-o' => 'fa-pause-circle-o'), array('fa fa-paw' => 'fa-paw'), array('fa fa-paypal' => 'fa-paypal'), array('fa fa-pencil' => 'fa-pencil'), array('fa fa-pencil-square' => 'fa-pencil-square'), array('fa fa-pencil-square-o' => 'fa-pencil-square-o'), array('fa fa-percent' => 'fa-percent'), array('fa fa-phone' => 'fa-phone'), array('fa fa-phone-square' => 'fa-phone-square'), array('fa fa-photo' => 'fa-photo'), array('fa fa-picture-o' => 'fa-picture-o'), array('fa fa-pie-chart' => 'fa-pie-chart'), array('fa fa-pied-piper' => 'fa-pied-piper'), array('fa fa-pied-piper-alt' => 'fa-pied-piper-alt'), array('fa fa-pinterest' => 'fa-pinterest'), array('fa fa-pinterest-p' => 'fa-pinterest-p'), array('fa fa-pinterest-square' => 'fa-pinterest-square'), array('fa fa-plane' => 'fa-plane'), array('fa fa-play' => 'fa-play'), array('fa fa-play-circle' => 'fa-play-circle'), array('fa fa-play-circle-o' => 'fa-play-circle-o'), array('fa fa-plug' => 'fa-plug'), array('fa fa-plus' => 'fa-plus'), array('fa fa-plus-circle' => 'fa-plus-circle'), array('fa fa-plus-square' => 'fa-plus-square'), array('fa fa-plus-square-o' => 'fa-plus-square-o'), array('fa fa-power-off' => 'fa-power-off'), array('fa fa-print' => 'fa-print'), array('fa fa-product-hunt' => 'fa-product-hunt'), array('fa fa-puzzle-piece' => 'fa-puzzle-piece'), array('fa fa-qq' => 'fa-qq'), array('fa fa-qrcode' => 'fa-qrcode'), array('fa fa-question' => 'fa-question'), array('fa fa-question-circle' => 'fa-question-circle'), array('fa fa-quote-left' => 'fa-quote-left'), array('fa fa-quote-right' => 'fa-quote-right'), array('fa fa-ra' => 'fa-ra'), array('fa fa-random' => 'fa-random'), array('fa fa-rebel' => 'fa-rebel'), array('fa fa-recycle' => 'fa-recycle'), array('fa fa-reddit' => 'fa-reddit'), array('fa fa-reddit-alien' => 'fa-reddit-alien'), array('fa fa-reddit-square' => 'fa-reddit-square'), array('fa fa-refresh' => 'fa-refresh'), array('fa fa-registered' => 'fa-registered'), array('fa fa-remove' => 'fa-remove'), array('fa fa-renren' => 'fa-renren'), array('fa fa-reorder' => 'fa-reorder'), array('fa fa-repeat' => 'fa-repeat'), array('fa fa-reply' => 'fa-reply'), array('fa fa-reply-all' => 'fa-reply-all'), array('fa fa-retweet' => 'fa-retweet'), array('fa fa-rmb' => 'fa-rmb'), array('fa fa-road' => 'fa-road'), array('fa fa-rocket' => 'fa-rocket'), array('fa fa-rotate-left' => 'fa-rotate-left'), array('fa fa-rotate-right' => 'fa-rotate-right'), array('fa fa-rouble' => 'fa-rouble'), array('fa fa-rss' => 'fa-rss'), array('fa fa-rss-square' => 'fa-rss-square'), array('fa fa-rub' => 'fa-rub'), array('fa fa-ruble' => 'fa-ruble'), array('fa fa-rupee' => 'fa-rupee'), array('fa fa-safari' => 'fa-safari'), array('fa fa-save' => 'fa-save'), array('fa fa-scissors' => 'fa-scissors'), array('fa fa-scribd' => 'fa-scribd'), array('fa fa-search' => 'fa-search'), array('fa fa-search-minus' => 'fa-search-minus'), array('fa fa-search-plus' => 'fa-search-plus'), array('fa fa-sellsy' => 'fa-sellsy'), array('fa fa-send' => 'fa-send'), array('fa fa-send-o' => 'fa-send-o'), array('fa fa-server' => 'fa-server'), array('fa fa-share' => 'fa-share'), array('fa fa-share-alt' => 'fa-share-alt'), array('fa fa-share-alt-square' => 'fa-share-alt-square'), array('fa fa-share-square' => 'fa-share-square'), array('fa fa-share-square-o' => 'fa-share-square-o'), array('fa fa-shekel' => 'fa-shekel'), array('fa fa-sheqel' => 'fa-sheqel'), array('fa fa-shield' => 'fa-shield'), array('fa fa-ship' => 'fa-ship'), array('fa fa-shirtsinbulk' => 'fa-shirtsinbulk'), array('fa fa-shopping-bag' => 'fa-shopping-bag'), array('fa fa-shopping-basket' => 'fa-shopping-basket'), array('fa fa-shopping-cart' => 'fa-shopping-cart'), array('fa fa-sign-in' => 'fa-sign-in'), array('fa fa-sign-out' => 'fa-sign-out'), array('fa fa-signal' => 'fa-signal'), array('fa fa-simplybuilt' => 'fa-simplybuilt'), array('fa fa-sitemap' => 'fa-sitemap'), array('fa fa-skyatlas' => 'fa-skyatlas'), array('fa fa-skype' => 'fa-skype'), array('fa fa-slack' => 'fa-slack'), array('fa fa-sliders' => 'fa-sliders'), array('fa fa-slideshare' => 'fa-slideshare'), array('fa fa-smile-o' => 'fa-smile-o'), array('fa fa-soccer-ball-o' => 'fa-soccer-ball-o'), array('fa fa-sort' => 'fa-sort'), array('fa fa-sort-alpha-asc' => 'fa-sort-alpha-asc'), array('fa fa-sort-alpha-desc' => 'fa-sort-alpha-desc'), array('fa fa-sort-amount-asc' => 'fa-sort-amount-asc'), array('fa fa-sort-amount-desc' => 'fa-sort-amount-desc'), array('fa fa-sort-asc' => 'fa-sort-asc'), array('fa fa-sort-desc' => 'fa-sort-desc'), array('fa fa-sort-down' => 'fa-sort-down'), array('fa fa-sort-numeric-asc' => 'fa-sort-numeric-asc'), array('fa fa-sort-numeric-desc' => 'fa-sort-numeric-desc'), array('fa fa-sort-up' => 'fa-sort-up'), array('fa fa-soundcloud' => 'fa-soundcloud'), array('fa fa-space-shuttle' => 'fa-space-shuttle'), array('fa fa-spinner' => 'fa-spinner'), array('fa fa-spoon' => 'fa-spoon'), array('fa fa-spotify' => 'fa-spotify'), array('fa fa-square' => 'fa-square'), array('fa fa-square-o' => 'fa-square-o'), array('fa fa-stack-exchange' => 'fa-stack-exchange'), array('fa fa-stack-overflow' => 'fa-stack-overflow'), array('fa fa-star' => 'fa-star'), array('fa fa-star-half' => 'fa-star-half'), array('fa fa-star-half-empty' => 'fa-star-half-empty'), array('fa fa-star-half-full' => 'fa-star-half-full'), array('fa fa-star-half-o' => 'fa-star-half-o'), array('fa fa-star-o' => 'fa-star-o'), array('fa fa-steam' => 'fa-steam'), array('fa fa-steam-square' => 'fa-steam-square'), array('fa fa-step-backward' => 'fa-step-backward'), array('fa fa-step-forward' => 'fa-step-forward'), array('fa fa-stethoscope' => 'fa-stethoscope'), array('fa fa-sticky-note' => 'fa-sticky-note'), array('fa fa-sticky-note-o' => 'fa-sticky-note-o'), array('fa fa-stop' => 'fa-stop'), array('fa fa-stop-circle' => 'fa-stop-circle'), array('fa fa-stop-circle-o' => 'fa-stop-circle-o'), array('fa fa-street-view' => 'fa-street-view'), array('fa fa-strikethrough' => 'fa-strikethrough'), array('fa fa-stumbleupon' => 'fa-stumbleupon'), array('fa fa-stumbleupon-circle' => 'fa-stumbleupon-circle'), array('fa fa-subscript' => 'fa-subscript'), array('fa fa-subway' => 'fa-subway'), array('fa fa-suitcase' => 'fa-suitcase'), array('fa fa-sun-o' => 'fa-sun-o'), array('fa fa-superscript' => 'fa-superscript'), array('fa fa-support' => 'fa-support'), array('fa fa-table' => 'fa-table'), array('fa fa-tablet' => 'fa-tablet'), array('fa fa-tachometer' => 'fa-tachometer'), array('fa fa-tag' => 'fa-tag'), array('fa fa-tags' => 'fa-tags'), array('fa fa-tasks' => 'fa-tasks'), array('fa fa-taxi' => 'fa-taxi'), array('fa fa-television' => 'fa-television'), array('fa fa-tencent-weibo' => 'fa-tencent-weibo'), array('fa fa-terminal' => 'fa-terminal'), array('fa fa-text-height' => 'fa-text-height'), array('fa fa-text-width' => 'fa-text-width'), array('fa fa-th' => 'fa-th'), array('fa fa-th-large' => 'fa-th-large'), array('fa fa-th-list' => 'fa-th-list'), array('fa fa-thumb-tack' => 'fa-thumb-tack'), array('fa fa-thumbs-down' => 'fa-thumbs-down'), array('fa fa-thumbs-o-down' => 'fa-thumbs-o-down'), array('fa fa-thumbs-o-up' => 'fa-thumbs-o-up'), array('fa fa-thumbs-up' => 'fa-thumbs-up'), array('fa fa-ticket' => 'fa-ticket'), array('fa fa-times' => 'fa-times'), array('fa fa-times-circle' => 'fa-times-circle'), array('fa fa-times-circle-o' => 'fa-times-circle-o'), array('fa fa-tint' => 'fa-tint'), array('fa fa-toggle-down' => 'fa-toggle-down'), array('fa fa-toggle-left' => 'fa-toggle-left'), array('fa fa-toggle-off' => 'fa-toggle-off'), array('fa fa-toggle-on' => 'fa-toggle-on'), array('fa fa-toggle-right' => 'fa-toggle-right'), array('fa fa-toggle-up' => 'fa-toggle-up'), array('fa fa-trademark' => 'fa-trademark'), array('fa fa-train' => 'fa-train'), array('fa fa-transgender' => 'fa-transgender'), array('fa fa-transgender-alt' => 'fa-transgender-alt'), array('fa fa-trash' => 'fa-trash'), array('fa fa-trash-o' => 'fa-trash-o'), array('fa fa-tree' => 'fa-tree'), array('fa fa-trello' => 'fa-trello'), array('fa fa-tripadvisor' => 'fa-tripadvisor'), array('fa fa-trophy' => 'fa-trophy'), array('fa fa-truck' => 'fa-truck'), array('fa fa-try' => 'fa-try'), array('fa fa-tty' => 'fa-tty'), array('fa fa-tumblr' => 'fa-tumblr'), array('fa fa-tumblr-square' => 'fa-tumblr-square'), array('fa fa-turkish-lira' => 'fa-turkish-lira'), array('fa fa-tv' => 'fa-tv'), array('fa fa-twitch' => 'fa-twitch'), array('fa fa-twitter' => 'fa-twitter'), array('fa fa-twitter-square' => 'fa-twitter-square'), array('fa fa-umbrella' => 'fa-umbrella'), array('fa fa-underline' => 'fa-underline'), array('fa fa-undo' => 'fa-undo'), array('fa fa-university' => 'fa-university'), array('fa fa-unlink' => 'fa-unlink'), array('fa fa-unlock' => 'fa-unlock'), array('fa fa-unlock-alt' => 'fa-unlock-alt'), array('fa fa-unsorted' => 'fa-unsorted'), array('fa fa-upload' => 'fa-upload'), array('fa fa-usb' => 'fa-usb'), array('fa fa-usd' => 'fa-usd'), array('fa fa-user' => 'fa-user'), array('fa fa-user-md' => 'fa-user-md'), array('fa fa-user-plus' => 'fa-user-plus'), array('fa fa-user-secret' => 'fa-user-secret'), array('fa fa-user-times' => 'fa-user-times'), array('fa fa-users' => 'fa-users'), array('fa fa-venus' => 'fa-venus'), array('fa fa-venus-double' => 'fa-venus-double'), array('fa fa-venus-mars' => 'fa-venus-mars'), array('fa fa-viacoin' => 'fa-viacoin'), array('fa fa-video-camera' => 'fa-video-camera'), array('fa fa-vimeo' => 'fa-vimeo'), array('fa fa-vimeo-square' => 'fa-vimeo-square'), array('fa fa-vine' => 'fa-vine'), array('fa fa-vk' => 'fa-vk'), array('fa fa-volume-down' => 'fa-volume-down'), array('fa fa-volume-off' => 'fa-volume-off'), array('fa fa-volume-up' => 'fa-volume-up'), array('fa fa-warning' => 'fa-warning'), array('fa fa-wechat' => 'fa-wechat'), array('fa fa-weibo' => 'fa-weibo'), array('fa fa-weixin' => 'fa-weixin'), array('fa fa-whatsapp' => 'fa-whatsapp'), array('fa fa-wheelchair' => 'fa-wheelchair'), array('fa fa-wifi' => 'fa-wifi'), array('fa fa-wikipedia-w' => 'fa-wikipedia-w'), array('fa fa-windows' => 'fa-windows'), array('fa fa-won' => 'fa-won'), array('fa fa-wordpress' => 'fa-wordpress'), array('fa fa-wrench' => 'fa-wrench'), array('fa fa-xing' => 'fa-xing'), array('fa fa-xing-square' => 'fa-xing-square'), array('fa fa-y-combinator' => 'fa-y-combinator'), array('fa fa-y-combinator-square' => 'fa-y-combinator-square'), array('fa fa-yahoo' => 'fa-yahoo'), array('fa fa-yc' => 'fa-yc'), array('fa fa-yc-square' => 'fa-yc-square'), array('fa fa-yelp' => 'fa-yelp'), array('fa fa-yen' => 'fa-yen'), array('fa fa-youtube' => 'fa-youtube'), array('fa fa-youtube-play' => 'fa-youtube-play'), array('fa fa-youtube-square' => 'fa-youtube-square')
        ));

        return $GLOBALS['g5plus_font_awesome'];
    }
}

/**
 * Get Theme Font Icon
 * *******************************************************
 */
if (!function_exists('g5plus_get_theme_font')) {
    function &g5plus_get_theme_font() {
        if (isset($GLOBALS['g5plus_icomoon']) && is_array($GLOBALS['g5plus_icomoon'])) {
            return $GLOBALS['g5plus_icomoon'];
        }
        $GLOBALS['g5plus_icomoon'] = apply_filters('g5plus_icomoon', array(
            array('icon-phone-hang-up'=>'icon-phone-hang-up'),array('icon-barcode'=>'icon-barcode'),array('icon-office'=>'icon-office'), array('icon-users2'=>'icon-users2'),array('icon-mail-envelope-open2'=>'icon-mail-envelope-open2'),array('icon-mail-envelope-open'=>'icon-mail-envelope-open'),array('icon-location22'=>'icon-location22'),array('icon-clipboard-checked'=>'icon-clipboard-checked'), array('icon-clipboard-checked2'=>'icon-clipboard-checked2'), array('icon-bathtube'=>'icon-bathtube'),array('icon-bed'=>'icon-bed'),array('icon-bath'=>'icon-bath'),array('icon-blueprint'=>'icon-blueprint'),array('icon-garage'=>'icon-garage'),array('icon-room-bed'=>'icon-room-bed'),array('icon-square'=>'icon-square'),array('icon-bedroom'=>'icon-bedroom'),array('icon-airplane22'=>'icon-airplane22'),array('icon-carrier'=>'icon-carrier'),array('icon-hand'=>'icon-hand'),array('icon-security'=>'icon-security'),array('icon-ship'=>'icon-ship'),array('icon-truck22'=>'icon-truck22'),array('icon-truck222'=>'icon-truck222'),array('icon-warehouse'=>'icon-warehouse'),array('icon-audio-mixer-controls'=>'icon-audio-mixer-controls'),array('icon-connection12'=>'icon-connection12'),array('icon-connection3'=>'icon-connection3'),array('icon-database3'=>'icon-database3'),array('icon-domain'=>'icon-domain'),array('icon-envelope-in-black-paper-with-a-white-letter-sheet-inside'=>'icon-envelope-in-black-paper-with-a-white-letter-sheet-inside'),array('icon-ftp-file-transfer-protocol'=>'icon-ftp-file-transfer-protocol'),array('icon-hosting'=>'icon-hosting'),array('icon-line53'=>'icon-line53'),array('icon-link3'=>'icon-link3'),array('icon-prize3'=>'icon-prize3'),array('icon-rack-servers'=>'icon-rack-servers'),array('icon-shield3'=>'icon-shield3'),array('icon-database22'=>'icon-database22'),array('icon-internet-server'=>'icon-internet-server'),array('icon-database-with-right-arrow'=>'icon-database-with-right-arrow'),array('icon-connection1'=>'icon-connection1'),array('icon-connection22'=>'icon-connection22'),array('icon-shield22'=>'icon-shield22'),array('icon-link22'=>'icon-link22'),array('icon-internet2'=>'icon-internet2'),array('icon-internet1'=>'icon-internet1'),array('icon-internet'=>'icon-internet'),array('icon-tool'=>'icon-tool'),array('icon-archive-files-upload-to-internet'=>'icon-archive-files-upload-to-internet'),array('icon-pc-synchronization-with-cloud-data1'=>'icon-pc-synchronization-with-cloud-data1'),array('icon-data-transference-by-internet'=>'icon-data-transference-by-internet'),array('icon-hosting-download'=>'icon-hosting-download'),array('icon-internet-configuration-settings1'=>'icon-internet-configuration-settings1'),array('icon-pc-synchronization-with-cloud-data'=>'icon-pc-synchronization-with-cloud-data'),array('icon-updated-security-for-protection-on-internet1'=>'icon-updated-security-for-protection-on-internet1'),array('icon-updated-security-for-protection-on-internet'=>'icon-updated-security-for-protection-on-internet'),array('icon-locked-internet-security-padlock'=>'icon-locked-internet-security-padlock'),array('icon-internet-configuration-settings'=>'icon-internet-configuration-settings')
        ));
        return $GLOBALS['g5plus_icomoon'];
    }
}

/**
 * get the_post_thumbnail()
 * *******************************************************
 */
if (!function_exists('g5plus_the_post_thumbnail()')) {
    function g5plus_the_post_thumbnail($size = 'post-thumbnail', $attr = '') {
        the_post_thumbnail($size, $attr);
    }
}

/*Custom Place Input Comment Form*/
if(!function_exists('g5plus_reorder_comment_fields')){
    function g5plus_reorder_comment_fields($comment_fields){
        $comment_fields_reorder = $comment_fields;
        if(isset($comment_fields_reorder['comment'])){
            unset($comment_fields_reorder['comment']);
        }
        $comment_fields_reorder['comment'] = $comment_fields['comment'];
        return $comment_fields_reorder;
    }
    add_filter('comment_form_fields','g5plus_reorder_comment_fields');
}


/*Custom Categories Count*/
if (!function_exists('g5plus_add_span_cat_count')) {
    function g5plus_add_span_cat_count($links)
    {
        $links = str_replace('</a> (', '<span class="count">(', $links);
        $links = str_replace(')', ')</span></a>', $links);
        return $links;
    }

    add_filter('wp_list_categories', 'g5plus_add_span_cat_count');
    add_filter('get_archives_link', 'g5plus_add_span_cat_count');
}

if (!function_exists('g5plus_archive_count_span')) {
    function g5plus_archive_count_span($links) {
        $links = str_replace('</a>&nbsp;(', ' <span class="count">(', $links);
        $links = str_replace(')', ')</span></a>', $links);
        return $links;
    }
    add_filter('get_archives_link', 'g5plus_archive_count_span');
}
