<?php
/**
 * The template for displaying author info
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
$profiles = $social_icons = '';
if (function_exists('gf_get_customer_meta_fields')) {
    $profiles =  gf_get_customer_meta_fields();
}
if(isset($profiles['social-profiles']['fields'])){
    $social_icons = '<ul class="author-social-profile">';
    foreach ( $profiles['social-profiles']['fields'] as $key => $field ) {
        $social_url = get_the_author_meta($key);
        if (isset($social_url) && !empty($social_url)) {
            $social_icons .= '<li><a title="'. esc_attr($field['label']) .'" href="' . esc_url( $social_url ) . '" target="_blank"><i class="'. esc_attr($field['icon']) .'"></i></a></li>' . "\n";
        }
    }
    $social_icons .= '</ul>';
}
$enable_author = get_the_author_meta('description');
if(empty($enable_author)){
    return;
}
?>
<div class="author-info mg-top-50 clearfix">
    <div class="author-info-inner">
        <div class="author-avatar">
            <?php
            /**
             * Filter the Orson author bio avatar size.
             *
             * @since Orson 1.0
             *
             * @param int $size The avatar height and width size in pixels.
             */
            $author_bio_avatar_size = apply_filters( 'g5plus_author_bio_avatar_size', 300 );
            echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
            ?>
        </div><!-- .author-avatar -->
        <div class="author-description">
            <h2 class="author-title"><?php the_author_posts_link(); ?></h2>
            <p class="author-bio">
                <?php the_author_meta( 'description' ); ?>
            </p><!-- .author-bio -->
            <?php
            if($social_icons){
                echo wp_kses_post($social_icons);
            }
            ?>
        </div><!-- .author-description -->
    </div>
</div><!-- .author-info -->