<?php
//==============================================================================
// SOCIAL PROFILE WIDGET
//==============================================================================
if (!class_exists('G5Plus_Widget_Social_Profile')) {
	class G5Plus_Widget_Social_Profile extends G5Plus_Widget
	{
		public function __construct()
		{
			$this->widget_cssclass = 'widget-social-profile';
			$this->widget_description = esc_html__("Social profile widget", 'beyot-framework');
			$this->widget_id = 'g5plus_social_profile';
			$this->widget_name = esc_html__('G5Plus - Social Profile', 'beyot-framework');
			$this->settings = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__('Title', 'beyot-framework')
				),
				'icons' => array(
					'type'    => 'multi-select',
					'label'   => esc_html__('Select social profiles', 'beyot-framework'),
					'std'     => '',
					'options' => $this->get_profiles()
				),
				'icon_size' => array(
					'type'    => 'select',
					'label'   => esc_html__('Icon Size', 'beyot-framework'),
					'std'     => 'icon-small',
					'options' => array(
						'icon-small' => esc_html__('Small', 'beyot-framework'),
						'icon-large'  => esc_html__('Large', 'beyot-framework'),
					)
				),
				'style' => array(
					'type'    => 'select',
					'label'   => esc_html__('Style', 'beyot-framework'),
					'std'     => 'default',
					'options' => array(
						'default' => esc_html__('Default', 'beyot-framework'),
						'circle'  => esc_html__('Circle', 'beyot-framework'),
					)
				),
				'color_scheme' => array(
					'type'    => 'select',
					'label'   => esc_html__('Color Scheme', 'beyot-framework'),
					'std'     => 'light',
					'options' => array(
						'light' => esc_html__('Light', 'beyot-framework'),
						'dark'  => esc_html__('Dark', 'beyot-framework'),
					)
				)
			);
			parent::__construct();
		}

		function widget($args, $instance)
		{
			if ( $this->get_cached_widget( $args ) ) {
				return;
			}
			extract($args, EXTR_SKIP);
			$title = (!empty($instance['title'])) ? $instance['title'] : '';
			$icons = (!empty($instance['icons'])) ? $instance['icons'] : '';
			$icon_size = (!empty($instance['icon_size'])) ? $instance['icon_size'] : 'icon-small';
			$style = (!empty($instance['style'])) ? $instance['style'] : 'default';
			$color_scheme = (!empty($instance['color_scheme'])) ? $instance['color_scheme'] : 'light';
			$social_profiles = array();
			if (function_exists('gf_get_social_profiles')) {
				$profiles = gf_get_social_profiles();
				foreach ($profiles as $value) {
					$social_profiles[$value['id']] = array(
						'title' => $value['title'],
						'icon' => $value['icon'],
						'type' => $value['type']
					);
				}
			}
			$arr_icons = array();
			if (!empty($icons)) {
				$arr_icons = explode(',', $icons);
			}
			ob_start();
			echo wp_kses_post($args['before_widget']);
			if ($title) {
				echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
			}
			$class_wrap = array('social-profiles', esc_attr($style), esc_attr($color_scheme), esc_attr($icon_size));
			if (count($arr_icons) > 0):
				?>
				<div class="<?php echo join(' ', $class_wrap) ?>">
					<?php foreach ($arr_icons as $key):
						if (!isset($social_profiles[$key])) {
							continue;
						}
						$title = $social_profiles[$key]['title'];
						$icon = $social_profiles[$key]['icon'];
						$link = '#';
						if (function_exists('gf_get_option')) {
							$link = gf_get_option($key, '#');
						}

						$link = empty($link) ? '#' : $link;
						if($icon === "fa fa-skype"):?>
							<a target="_blank" title="<?php echo esc_attr($title) ?>"
							   href="skype:<?php echo esc_attr($link); ?>?chat"><i
									class="<?php echo esc_attr($icon); ?>"></i></a>
						<?php else:?>
							<a target="_blank" title="<?php echo esc_attr($title) ?>"
						   		href="<?php echo($social_profiles[$key]['type'] == 'email' ? esc_attr($link) : esc_url($link)); ?>"><i
									class="<?php echo esc_attr($icon); ?>"></i></a>
						<?php endif;?>
					<?php endforeach; ?>
					<div class="clearfix"></div>
				</div>
				<?php
			endif;
			echo wp_kses_post($args['after_widget']);

			$content =  ob_get_clean();
			echo ($content);
			$this->cache_widget( $args, $content );
		}

		private function get_profiles()
		{
			$ret = array();
			if (function_exists('gf_get_social_profiles')) {
				$profiles = gf_get_social_profiles();
				foreach ($profiles as $profile) {
					$ret[$profile['id']] = $profile['title'];
				}
			}
			return $ret;
		}
	}
}