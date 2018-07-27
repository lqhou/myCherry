<?php
/**
*
* 最新文章
* author: Hou Lunqing
*
*/

class recent_Posts extends WP_Widget {

    //construct
  	function recent_Posts() {
    	parent::WP_Widget('recent_posts', '最新文章', array('description' =>  '最新文章(By myCherry)') );
    }

    public function widget( $args, $instance ) {
        if (isset($instance['title'])) :
            $title = apply_filters( 'widget_title', $instance['title'] );
        $no_of_posts = apply_filters( 'no_of_posts', $instance['no_of_posts'] );
        else :
            $title = __('Latest Posts');
        $no_of_posts = 5;
        endif;				
        echo $args['before_widget'];		

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];		
        // WP_Query arguments
        $qa = array (
            'post_type'              => 'post',
            'posts_per_page'		 => $no_of_posts,
            'offset'				 => 0,
            'ignore_sticky_posts'    => 1
        );		

        // The Query
        $recent_articles = new WP_Query( $qa );
        if($recent_articles->have_posts()) : ?>
         <ul>

    <?php
        while($recent_articles->have_posts()) : 
            $recent_articles->the_post();
    ?>        		 

    <li class='recentp-item'>
        <div><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><img src="<?php echo catch_first_image() ?>" ></a></div>
        <div class='recentp-title'><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php if(strlen(get_the_title())>50):{echo mb_substr(get_the_title(), 0, 22, 'utf-8').' [...]'; }else:{ echo get_the_title(); } endif;?></a></div>
        <div class='recentp-date'><i class="fa fa-calendar-check-o"></i><?php the_time('Y-m-j'); ?></div>
    </li>

    <?php endwhile; else: ?>
      Oops, there are no recent posts.
    <?php endif; ?>
    </ul>

    <?php		
        echo $args['after_widget']; }

        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }
            else {
              $title = __( '最新文章' );
            }

            if ( isset( $instance[ 'no_of_posts' ] ) ) {
                $no_of_posts = $instance[ 'no_of_posts' ];
            }
            else {
                $no_of_posts = __( '6');
            }
    ?>

    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( '栏目标题:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>		
    <p>
        <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( '文章条数:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" type="text" value="<?php echo esc_attr( $no_of_posts ); ?>" />
    </p>
 
    <?php 
        }	
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['no_of_posts'] = ( ! empty( $new_instance['no_of_posts'] ) ) ? strip_tags( $new_instance['no_of_posts'] ) : '5';
        if ( is_numeric($new_instance['no_of_posts']) == false ) {
            $instance['no_of_posts'] = $old_instance['no_of_posts'];
        }
        return $instance;
    }
}

add_action( 'widgets_init', 'register_mc_widget' );

function register_mc_widget() {
    register_widget( 'recent_Posts' );
}