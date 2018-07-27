<?php
/**
*
* 站内搜索
* author: Hou Lunqing
*
*/

class mc_Search extends WP_Widget {

	//construct
  	function mc_Search() {
    	parent::WP_Widget('mc_Search', '搜索', array('description' =>  '搜索(By myCherry)') );
    }

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>

		<form role="search" method="get" id="searchform" class="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        	<div class="mc_search">
        		<input type="text" name="s" id="s" onblur="if(this.value == '')this.value='Search...';" onclick="if(this.value == 'Search...')this.value='';" value="Search..." />
        		<input type="submit" id="searchsubmit" value="" />
        	</div>
        </form>

		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', 'register_mc_widget_search' );

function register_mc_widget_search() {
    register_widget( 'mc_Search' );
}