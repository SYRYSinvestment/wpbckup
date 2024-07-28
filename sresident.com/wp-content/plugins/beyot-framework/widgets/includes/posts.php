<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/1/2016
 * Time: 9:15 AM
 */

class G5Plus_Widget_Posts extends G5Plus_Widget{
	public function __construct() {
		$this->widget_cssclass    = 'widget-posts';
		$this->widget_description = esc_html__( "Display list posts", 'beyot-framework' );
		$this->widget_id          = 'g5plus-post';
		$this->widget_name        = esc_html__( 'G5Plus: Posts', 'beyot-framework' );
		$this->settings = array(
			'title' => array(
				'type' => 'text',
				'std' => '',
				'label' => esc_html__('Title','beyot-framework')
			),
			'source'  => array(
				'type'    => 'select',
				'std'     => 'recent',
				'label'   => esc_html__( 'Source', 'beyot-framework' ),
				'options' => array(
					'random' => esc_html__('Random','beyot-framework'),
					'popular' => esc_html__('Popular','beyot-framework'),
					'recent'  => esc_html__( 'Recent', 'beyot-framework' ),
					'oldest' => esc_html__('Oldest','beyot-framework')
				)
			),
			'number' => array(
				'type'  => 'number',
				'std'   => '5',
				'label' => esc_html__( 'Number of posts to show', 'beyot-framework' ),
			)
		);
		parent::__construct();
	}
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$source = ( ! empty( $instance['source'] ) ) ? $instance['source'] : 'recent';
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$query_args = array(
			'posts_per_page' => $number,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post_type' => 'post',
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
					'operator' => 'NOT IN'
				)
			)
		);
		$query_order_args = array();
		switch ($source) {
			case 'random' :
				$query_order_args = array(
					'orderby' => 'rand',
					'order' => 'DESC',
				);
				break;
			case 'popular':
				$query_order_args = array(
					'orderby' => 'comment_count',
					'order' => 'DESC',
				);
				break;
			case 'recent':
				$query_order_args = array(
					'orderby' => 'post_date',
					'order' => 'DESC',
				);
				break;
			case 'oldest':
				$query_order_args = array(
					'orderby' => 'post_date',
				);
				break;
		}
		$query_args = array_merge($query_args,$query_order_args);
		$r = new WP_Query( $query_args);
		if ($r->have_posts()) :
		?>
			<?php echo wp_kses_post($args['before_widget']); ?>
			<?php if ( $title ) {
				echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
			} ?>
			<ul>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<li class="clearfix">
					<?php if (function_exists('g5plus_get_post_thumbnail')){
						g5plus_get_post_thumbnail('small-image');
					} ?>
					<div class="entry-content-wrap">
						<?php $title_post = get_the_title();
						if(!empty($title_post)):?>
							<h3 class="entry-post-title"><a title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="entry-meta-date"><?php date_i18n(the_time(get_option('date_format'))); ?></div>
						<?php else:?>
							<div class="entry-meta-date"><a href="<?php echo get_permalink(); ?>"><?php date_i18n(the_time(get_option('date_format'))); ?></a></div>
						<?php endif;?>
					</div>
				</li>
			<?php endwhile; ?>
			</ul>
			<?php echo wp_kses_post($args['after_widget']); ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		endif;
	}
}