<?php
/**
 * The template for displaying page title
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */

$page_title = '';
$page_sub_title = '';
$page_title_enable = 1;
$page_breadcrumbs_enable = 1;
$page_title_bg_overlay = 0;
$page_title_bg_image = '';
$page_title_class = array('page-title');

$page_title_padding = g5plus_get_option('page_title_padding', array('top' => '120', 'bottom' => '120'));
$page_title_parallax = g5plus_get_option('page_title_parallax', 1);

if (is_home()) {
	if (empty($page_title)) {
		$page_title = esc_html__("Blog", 'g5-beyot');
	}
} elseif (!is_singular() && !is_front_page()) {
	if (!have_posts() && !is_author()) {
		$page_title = esc_html__('Nothing Found', 'g5-beyot');
	} elseif (is_tag()) {
		$page_title = single_tag_title(esc_html__("Tags: ", 'g5-beyot'), false);
	} elseif (is_category() || is_tax()) {
		$page_title = single_cat_title('', false);
	} elseif (is_author()) {
		global $wp_query;
		$current_author = $wp_query->get_queried_object();
		$current_author_meta = get_user_meta($current_author->ID);
		if (empty($current_author->first_name) && empty($current_author->last_name)) {
			$page_title = $current_author->user_login;
		} else {
			$page_title = $current_author->first_name . ' ' . $current_author->last_name;
		}
	} elseif (is_day()) {
		$page_title = sprintf(esc_html__('Daily Archives: %s', 'g5-beyot'), get_the_date());
	} elseif (is_month()) {
		$page_title = sprintf(esc_html__('Monthly Archives: %s', 'g5-beyot'), get_the_date(_x('F Y', 'monthly archives date format', 'g5-beyot')));
	} elseif (is_year()) {
		$page_title = sprintf(esc_html__('Yearly Archives: %s', 'g5-beyot'), get_the_date(_x('Y', 'yearly archives date format', 'g5-beyot')));
	} elseif (is_search()) {
		$page_title = esc_html__('Search Results', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-aside')) {
		$page_title = esc_html__('Asides', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-gallery')) {
		$page_title = esc_html__('Galleries', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-image')) {
		$page_title = esc_html__('Images', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-video')) {
		$page_title = esc_html__('Videos', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-quote')) {
		$page_title = esc_html__('Quotes', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-link')) {
		$page_title = esc_html__('Links', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-status')) {
		$page_title = esc_html__('Statuses', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-audio')) {
		$page_title = esc_html__('Audios', 'g5-beyot');
	} elseif (is_tax('post_format', 'post-format-chat')) {
		$page_title = esc_html__('Chats', 'g5-beyot');
	}
}

$page_title_enable = g5plus_get_option('page_title_enable', 1);
$page_title = g5plus_get_option('page_title', $page_title);
$page_sub_title = g5plus_get_option('page_sub_title', '');
$page_breadcrumbs_enable = g5plus_get_option('breadcrumbs_enable', 1);
$page_title_bg_overlay = g5plus_get_option('page_title_bg_overlay', 0);
$page_title_bg_image = g5plus_get_option('page_title_bg_image', array('url' => G5PLUS_THEME_URL . 'assets/images/page-title.jpg'));
$page_title_bg_image = isset($page_title_bg_image['url']) ? $page_title_bg_image['url'] : '';
if (is_singular()) {
	if (is_singular('post')) {
		$page_title = esc_html__("Blog", 'g5-beyot');
	}


	if (!$page_title) {
		$page_title = get_the_title(get_the_ID());
	}
	$custom_page_title_visible = g5plus_get_post_meta('custom_page_title_visible', get_the_ID());
	if (($custom_page_title_visible !== '-1') && ($custom_page_title_visible !== '')) {
		$page_title_enable = $custom_page_title_visible;
	}
	$custom_breadcrumbs_visible = g5plus_get_post_meta('custom_breadcrumbs_visible', get_the_ID());
	if (($custom_breadcrumbs_visible !== '-1') && ($custom_breadcrumbs_visible !== '')) {
		$page_breadcrumbs_enable = $custom_breadcrumbs_visible;
	}
	$is_custom_page_title_bg_overlay = g5plus_get_post_meta('is_custom_page_title_bg_overlay', get_the_ID());
	if (($is_custom_page_title_bg_overlay !== '-1') && ($is_custom_page_title_bg_overlay !== '')) {
		$page_title_bg_overlay = $is_custom_page_title_bg_overlay;
	}
	$is_custom_page_title = g5plus_get_post_meta('is_custom_page_title', get_the_ID());
	if ($is_custom_page_title) {
		$page_title = g5plus_get_post_meta('custom_page_title', get_the_ID());
		$page_sub_title = g5plus_get_post_meta('custom_page_sub_title', get_the_ID());
	}
	$is_custom_page_title_bg = g5plus_get_post_meta('is_custom_page_title_bg', get_the_ID());
	if ($is_custom_page_title_bg) {
		$page_title_bg_image = g5plus_get_post_meta_image('custom_page_title_bg_image', get_the_ID());
	}
	$post_type = get_post_type(get_the_ID());
	if ($post_type === 'property' && function_exists('ere_get_option')) {
		$custom_property_single_header_type = ere_get_option('custom_property_single_header_type', 'map');
		if ($custom_property_single_header_type === 'image' || (isset($_GET['single-layout']) && $_GET['single-layout'] === 'image')) {
			$page_title_class[] = 'property-single-page-title';
			$page_breadcrumbs_enable = false;
			$page_sub_title = '';
		} elseif ($custom_property_single_header_type === 'map' || (isset($_GET['single-layout']) && $_GET['single-layout'] === 'map')) {
			$page_title_class[] = 'property-single-map';
			$page_breadcrumbs_enable = false;
			$page_sub_title = '';
			$page_title_padding = array('top' => '0', 'bottom' => '0');
		}
	}
} elseif (is_category() || is_tax()) {
	$cat = get_queried_object();
	if ($cat && property_exists($cat, 'term_id')) {
		$custom_page_title_enable = g5plus_get_tax_meta($cat->term_id, 'page_title_enable');
		if ($custom_page_title_enable != '' && $custom_page_title_enable != -1) {
			$page_title_enable = $custom_page_title_enable;
		}
		
		$bg_image = g5plus_get_tax_meta($cat->term_id, 'page_title_bg_image');
		if (isset($bg_image['url'])) {
			$page_title_bg_image = $bg_image['url'];
		}
		if ($cat->taxonomy != 'agencies') {
			$term_description = strip_tags(term_description());
			if ($term_description) {
				$page_sub_title = $term_description;
			}
		}
	}
}

if (!$page_title_enable) return;

if (is_post_type_archive() && !$page_title) {
	$post_type = get_post_type_object(get_post_type());
	$page_title = $post_type->label;
}
$page_title = apply_filters('g5plus_page_title', $page_title);
$page_sub_title = apply_filters('g5plus_sub_page_title', $page_sub_title);


// region Custom Styles

$custom_styles = array();
$page_title_bg_styles = array();
$page_title_bg_class = array();
if (isset($page_title_padding['top']) && !empty($page_title_padding['top']) && ($page_title_padding['top'] != 'px')) {
	$custom_styles[] = "padding-top:" . $page_title_padding['top'] . "px";
} else {

}
if (isset($page_title_padding['bottom']) && !empty($page_title_padding['bottom']) && ($page_title_padding['bottom'] != 'px')) {
	$custom_styles[] = "padding-bottom:" . $page_title_padding['bottom'] . "px";
}


$image_src = $property_status = $price = $property_address = '';
if (in_array('property-single-page-title', $page_title_class)) {
	$attach_id = get_post_thumbnail_id();
	$image_src = ere_image_resize_id($attach_id, 1920, 420, true);
	if (!empty($image_src)) {
		$page_title_bg_image = $image_src;
	}
	
	$property_status = get_the_terms(get_the_ID(), 'property-status');
	$price = get_post_meta(get_the_ID(), ERE_METABOX_PREFIX . 'property_price', true);
	$price_postfix = get_post_meta(get_the_ID(), ERE_METABOX_PREFIX . 'property_price_postfix', true);
	$price_prefix =  get_post_meta(get_the_ID(), ERE_METABOX_PREFIX . 'property_price_prefix', true);
	$price_short =get_post_meta(get_the_ID(), ERE_METABOX_PREFIX . 'property_price_short', true);
	$price_unit = get_post_meta(get_the_ID(), ERE_METABOX_PREFIX . 'property_price_unit', true);

	$property_address = get_post_meta(get_the_ID(), ERE_METABOX_PREFIX . 'property_address', true);
}

if (!empty($page_title_bg_image)) {
	$page_title_bg_styles[] = 'style="background-image: url(' . $page_title_bg_image . ')"';
	$page_title_class[] = 'page-title-background';
	$page_title_bg_class[] = 'page-title-background';
	
	if ($page_title_parallax) {
		$page_title_bg_class[] = 'page-title-parallax';
	}
}
$custom_style = '';
if ($custom_styles) {
	$custom_style = 'style="' . join(';', $custom_styles) . '"';
}
if (!empty($page_title_bg_image) && $page_title_parallax) {
	$page_title_bg_styles[] = ' data-stellar-background-ratio="0.5"';
}

// endregion
?>
<section class="<?php echo join(' ', $page_title_class); ?>" <?php echo wp_kses_post($custom_style); ?>>
	<?php if (!in_array('property-single-map', $page_title_class)): ?>
		<div class="<?php echo join(' ', $page_title_bg_class); ?>" <?php echo join(' ', $page_title_bg_styles); ?>></div>
		<?php if ($page_title_bg_overlay) { ?>
			<div class="vc_row-background-overlay" style="background-color: rgba(0,0,0,0.68)"></div>
		<?php } ?>
		<div class="container">
			<div class="page-title-inner">
				<div class="page-title-main-info">
					<?php if (in_array('property-single-page-title', $page_title_class)): ?>
						<div class="property-status">
							<?php if ($property_status) :
								foreach ($property_status as $status) :
									$status_color = get_term_meta($status->term_id, 'property_status_color', true);?>
									<span style="background-color: <?php echo esc_attr($status_color) ?>"><?php echo esc_attr($status->name); ?></span>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if (is_singular('post')): ?>
						<h2><?php echo esc_html($page_title) ?></h2>
					<?php else: ?>
						<h1><?php echo esc_html($page_title) ?></h1>
					<?php endif; ?>

					<?php if (!empty($page_sub_title)): ?>
						<p><?php echo esc_html($page_sub_title) ?></p>
					<?php endif; ?>
				</div>
				
				<?php if (in_array('property-single-page-title', $page_title_class)): ?>
					<div class="property-info">
						<?php if (!empty($price)): ?>
							<div class="property-price">
								<span>
                            <?php if (!empty($price_prefix)) {
								echo '<span class="accent-color">' . $price_prefix . ' </span>';
							} ?>
							<?php echo ere_get_format_money($price_short,$price_unit) ?>
							<?php if (!empty($price_postfix)) {
								echo '<span class="accent-color"> / ' . $price_postfix . '</span>';
							} ?>
                        </span>
							</div>
						<?php elseif (ere_get_option('empty_price_text', '') != ''): ?>
							<div class="property-price">
								<span><?php echo ere_get_option('empty_price_text', '') ?></span>
							</div>
						<?php endif; ?>
						<?php if (!empty($property_address)): ?>
							<div class="property-location" title="<?php echo esc_attr($property_address) ?>">
								<i class="fa fa-map-marker"></i>
								<span><?php echo esc_attr($property_address) ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<?php if ($page_breadcrumbs_enable) {
					get_template_part('templates/breadcrumb');
				} ?>
			</div>
		</div>
	<?php else: ?>
		<?php
		$google_map = '[ere_property_map map_style="property" property_id="' . get_the_ID() . '" map_height="420px"]';
		echo do_shortcode($google_map);
		?>
	<?php endif; ?>
</section>