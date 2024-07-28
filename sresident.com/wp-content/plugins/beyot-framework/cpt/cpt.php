<?php
if (!class_exists('GF_FrameWork_CPT')) {
    class GF_FrameWork_CPT{
        public function __construct(){
            $this->includes();

        }

        private function includes(){
            /**
             * Include post type
             */
        }

        public static function get_cpt_template($template, $template_args = array()){
            $template = ltrim( $template, '/\\' );
            $plugins = '/theme-plugins/'.GF_PLUGIN_NAME.'/cpt/';
            $path = get_stylesheet_directory().$plugins.'/'.$template;
            if(!file_exists($path)){
                $path = G5PLUS_THEME_DIR.$template;
            }
            if(!file_exists($path)){
                $path = GF_PLUGIN_DIR.'cpt/'.$template;
            }
            if(file_exists($path)){
                include $path;
            }else{
                esc_html_e('Could not find template','beyot-framework');
            }
        }

        public static function get_shortcode_template($template, $atts = array()){
            $template = ltrim( $template, '/\\' ).'.php';
            $plugins = '/theme-plugins/'.GF_PLUGIN_NAME.'/shortcodes/';
            $path = get_stylesheet_directory().$plugins.'/'.$template;
            if(!file_exists($path)){
                $path = G5PLUS_THEME_DIR.$template;
            }
            if(!file_exists($path)){
                $path = GF_PLUGIN_DIR.'/shortcodes/'.$template;
            }
            if(file_exists($path)){
                include $path;
            }else{
                esc_html_e('Could not find template','beyot-framework');
            }
        }
    }
    new GF_FrameWork_CPT();
}


