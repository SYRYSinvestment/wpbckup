<?php
//==============================================================================
// LOGO WIDGET
//==============================================================================
if (!class_exists('G5Plus_Widget_Logo')) {
    class G5Plus_Widget_Logo extends G5Plus_Widget
    {
        public function __construct()
        {
            $this->widget_cssclass = 'widget-logo';
            $this->widget_description = esc_html__("Logo widget", 'beyot-framework');
            $this->widget_id = 'g5plus_logo';
            $this->widget_name = esc_html__('G5Plus - Logo', 'beyot-framework');
            $this->settings = array(
                'image' => array(
                    'type' => 'image',
                    'std' => '',
                    'label' => esc_html__('Image','beyot-framework')
                ),
                'alt' => array(
                    'type' => 'text',
                    'std' => '',
                    'label' => esc_html__('Image Alt','beyot-framework')
                ),
            );
            parent::__construct();
        }

        function widget($args, $instance)
        {
            if ( $this->get_cached_widget( $args ) )
                return;
            extract( $args, EXTR_SKIP );
            $image   = empty( $instance['image'] ) ? '' : apply_filters( 'widget_image', $instance['image'] );
            $alt   = empty( $instance['alt'] ) ? '' : apply_filters( 'widget_alt', $instance['alt'] );
            ob_start();
            echo wp_kses_post($args['before_widget']);
            if(isset($image) && $image!='') { ?>
                <a href="<?php echo get_home_url() ?>"><img class="widget-logo" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($alt); ?>" /></a>
            <?php }
            echo wp_kses_post($args['after_widget']);
            $content =  ob_get_clean();
            echo wp_kses_post($content);
            $this->cache_widget( $args, $content );
        }
    }
}