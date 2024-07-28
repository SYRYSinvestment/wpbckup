<?php
get_header();
/*$title_404 = g5plus_get_option('404_title');*/
$sub_title_404 = g5plus_get_option('404_sub_title');
$description = g5plus_get_option('404_description');
$bg_image_404 = g5plus_get_option('404_bg_image', array());
$return_text_link = g5plus_get_option('404_return_text_link');
$return_link = g5plus_get_option('404_return_link');
$bg_image_404 = isset($bg_image_404['url']) ? $bg_image_404['url'] : '';
$style = '';
$bg_404_css = array();
if (!empty($bg_image_404)) {
    $bg_404_css[] = 'background-image:url(' . $bg_image_404 . ');';
    $bg_404_css[] = 'background-size: cover;';
    $bg_404_css[] = 'background-position: top center;';
    $bg_404_css[] = 'background-repeat: repeat;';
    $style = 'style="' . join( ' ', $bg_404_css ) . '"';
}
?>
    <div class="page404" <?php echo wp_kses_post($style ); ?>>
        <div class="page404-content container">
            <h3 class="subtitle"><?php echo wp_kses_post($sub_title_404); ?></h3>
            <h2 class="title">4<span>0</span>4</h2>
            <div class="description"><?php echo wp_kses_post($description); ?>
                <?php if (empty($return_link)): ?>
                    <span class="return-text"><?php esc_html_e('Or back to ','g5-beyot') ?></span>
                    <a href="<?php echo esc_url(home_url('/')) ?>">
                        <?php echo wp_kses_post($return_text_link); ?>
                    </a>
                <?php else: ?>
                    <span class="return-text"><?php esc_html_e('Or back to ','g5-beyot') ?></span>
                    <a href="<?php echo esc_url($return_link) ?>">
                        <?php echo wp_kses_post($return_text_link); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="search-form-wrapper">
                <div class="search-form">
                    <?php get_search_form() ?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();