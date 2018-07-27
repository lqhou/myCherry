<?php
/**
*
* 热门文章
* author: Hou Lunqing
* 注：该小工具显示的文章按评论数降序排，没有评论的文章不显示
*/

class hot_Posts extends WP_Widget {

    //construct
  	function hot_Posts() {
    	parent::WP_Widget('hot_posts', '热门文章', array('description' =>  '热门文章(By myCherry)') );
    }

    public function most_comm_posts($days=300, $nums=5) {
      global $wpdb;
      $today = date("Y-m-d H:i:s"); 
      $daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) ); 
      $result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' ORDER BY comment_count DESC LIMIT 0 , $nums");
      $output = '';
      if(empty($result)) {
		$output = '<li>None data.</li>';
      } else {
        $num = 0;
		foreach ($result as $topten) {
          $postid = $topten->ID;
          $title = $topten->post_title;
          $commentcount = $topten->comment_count;
          $post_type =get_post_type($postid);
          if ($commentcount != 0 &&$post_type!='page') {
            $num++;
            if($num==1)$style_c='style="color: red;"';
            else if($num==2)$style_c='style="color: green;"';
            else if($num==3)$style_c='style="color: orange;"';
            else $style_c='style="color: #999;"';
            $output .= '<li><i '.$style_c.'>'.$num.'</i><a  target="_blank" href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a></li>';
          }
		}
      }
      echo $output;
	}

    public function widget( $args, $instance ) {
        if (isset($instance['title'])) :
            $title = apply_filters( 'widget_title', $instance['title'] );
            $no_of_posts = apply_filters( 'no_of_posts', $instance['no_of_posts'] );
            $date_of_posts = apply_filters( 'date_of_posts', $instance['date_of_posts'] );
        else :
            $title = __('Hot Posts');
            $no_of_posts = 6;
            $date_of_posts = 5;
        endif;				
        echo $args['before_widget'];		

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];		
    ?>
        <div class="hot_p">
            <ul>
                <?php self::most_comm_posts($date_of_posts*60 , $no_of_posts); ?> 
            </ul>
        </div>

    <?php		
        echo $args['after_widget']; }

        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
              $title = __( '热门文章' );
            }

            if ( isset( $instance[ 'no_of_posts' ] ) ) {
                $no_of_posts = $instance[ 'no_of_posts' ];
            }
            else {
                $no_of_posts = __( '6');
            }

            if ( isset( $instance[ 'date_of_posts' ] ) ) {
                $date_of_posts = $instance[ 'date_of_posts' ];
            }
            else {
                $date_of_posts = __( '5');
            }
    ?>

    <p>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( '栏目标题:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>	
        <p><label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( '文章条数:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" type="text" value="<?php echo esc_attr( $no_of_posts ); ?>" /></p>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'date_of_posts' ); ?>"><?php _e( '显示近几个月的热评文章:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'date_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'date_of_posts' ); ?>" type="text" value="<?php echo esc_attr( $date_of_posts ); ?>" />
    </p>
 
    <?php 
        }	
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['no_of_posts'] = ( ! empty( $new_instance['no_of_posts'] ) ) ? strip_tags( $new_instance['no_of_posts'] ) : '5';
         $instance['date_of_posts'] = ( ! empty( $new_instance['date_of_posts'] ) ) ? strip_tags( $new_instance['date_of_posts'] ) : '5';
        if ( is_numeric($new_instance['no_of_posts']) == false ) {
            $instance['no_of_posts'] = $old_instance['no_of_posts'];
        }
        if ( is_numeric($new_instance['date_of_posts']) == false ) {
            $instance['date_of_posts'] = $old_instance['date_of_posts'];
        }
        return $instance;
    }
}

add_action( 'widgets_init', 'register_mc_widget_hp' );

function register_mc_widget_hp() {
    register_widget( 'hot_Posts' );
}