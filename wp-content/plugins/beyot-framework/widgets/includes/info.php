<?php
//==============================================================================
// LOGO WIDGET
//==============================================================================
if (!class_exists('G5Plus_Widget_Info')) {
    class G5Plus_Widget_Info extends G5Plus_Widget
    {
        public function __construct()
        {
            $this->widget_cssclass = 'widget-info';
            $this->widget_description = esc_html__("Info widget", 'beyot-framework');
            $this->widget_id = 'g5plus_info';
            $this->widget_name = esc_html__('G5Plus - Info', 'beyot-framework');
            $this->settings = array(
                'types' => array(
                    'type'    => 'multi-select',
                    'label'   => esc_html__('Select info type', 'beyot-framework'),
                    'std'     => '',
                    'options' => array(
                        'address' => esc_html__('Address', 'beyot-framework'),
                        'phone'  => esc_html__('Phone', 'beyot-framework'),
                        'email'  => esc_html__('Email', 'beyot-framework')
                    )
                ),
                'address' => array(
                    'type'  => 'text',
                    'std'   => '',
                    'label' => esc_html__('Address', 'beyot-framework')
                ),
                'phone' => array(
                    'type'  => 'text',
                    'std'   => '',
                    'label' => esc_html__('Phone', 'beyot-framework')
                ),
                'email' => array(
                    'type'  => 'text',
                    'std'   => '',
                    'label' => esc_html__('Email', 'beyot-framework')
                )
            );
            parent::__construct();
        }

        function widget($args, $instance)
        {
            if ( $this->get_cached_widget( $args ) )
                return;
            extract( $args, EXTR_SKIP );
            $types   = (!empty($instance['types'])) ? $instance['types'] : '';
            $address   = (!empty($instance['address'])) ? $instance['address'] : '';
            $phone   = (!empty($instance['phone'])) ? $instance['phone'] : '';
            $email   = (!empty($instance['email'])) ? $instance['email'] : '';
            ob_start();
            echo wp_kses_post($args['before_widget']);
            echo '<div class="row">';
            if(isset($types) && $types!='') {
                if ( strpos( $types, 'address' ) !== false && ! empty( $address ) ) { ?>
                    <div class="col-md-4 info-item">
                        <span class="fa fa-map-marker text-color-accent"></span>
                        <span><?php echo wp_kses_post( $address ) ?></span>
                    </div>
                <?php }
                if ( strpos( $types, 'phone' ) !== false && ! empty( $phone ) ) { ?>
                    <div class="col-md-4 info-item">
                        <span class="fa fa-phone text-color-accent"></span>
                        <span><?php echo wp_kses_post( $phone ) ?></span>
                    </div>
                <?php }
                if ( strpos( $types, 'email' ) !== false && ! empty( $email ) ) { ?>
                    <div class="col-md-4 info-item">
                        <span class="icon-envelope-in-black-paper-with-a-white-letter-sheet-inside text-color-accent"></span>
                        <span><?php echo wp_kses_post( $email ) ?></span>
                    </div>
                <?php }
            }
            echo '</div>';
            echo wp_kses_post($args['after_widget']);
            $content =  ob_get_clean();
            echo wp_kses_post($content);
            $this->cache_widget( $args, $content );
        }
    }
}