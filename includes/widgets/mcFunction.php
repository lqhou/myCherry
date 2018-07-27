<?php
/**
*
* 功能
* author: Hou Lunqing
*
*/

class mc_Function extends WP_Widget {

	//construct
  	function mc_Function() {
    	parent::WP_Widget('mc_function', '功能', array('description' =>  '功能(By myCherry)') );
    }

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Meta' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
			?>
			<div class="funbox">
                <div class="sideio">
			        <?php wp_register(); ?>
			        <li><?php wp_loginout(); ?></li>
                    <div class="clear"></div>
                </div>
                <div class="siderss">
			        <li><a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
			        <li><a href="<?php echo esc_url( get_bloginfo( 'comments_rss2_url' ) ); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
                    <div class="clear"></div>
                </div>
			</div>
			<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = sanitize_text_field( $instance['title'] );
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}

add_action( 'widgets_init', 'register_mc_widget_fun' );

function register_mc_widget_fun() {
    register_widget( 'mc_Function' );
}