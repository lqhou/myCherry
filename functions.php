<?php define('THEMEVER', '2.0'); # Define the Theme's Version

/* Remove wordpress version meta */
function remove_wordpress_version() { return ''; } add_filter('the_generator', 'remove_wordpress_version');

/* Remove Wordpress Admin bar */
if (!function_exists('mc_disable_admin_bar')) {
    function mc_disable_admin_bar() {
        // for the admin page
        remove_action('admin_footer', 'wp_admin_bar_render', 1000);
        // for the front-end
        remove_action('wp_footer', 'wp_admin_bar_render', 1000);
        // css override for the admin page
        function remove_admin_bar_style_backend() {
            echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';
        }
        add_filter('admin_head','remove_admin_bar_style_backend');
        // css override for the frontend
        function remove_admin_bar_style_frontend() {
            echo '<style type="text/css" media="screen">
            html { margin-top: 0px !important; }
            * html body { margin-top: 0px !important; }
            </style>';
        }
        add_filter('wp_head','remove_admin_bar_style_frontend', 99);
      }
}
show_admin_bar(false);
add_action('init','mc_disable_admin_bar');

/* MyCherry setup */
if (!function_exists( 'myCherry_setup' )) :
function myCherry_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => 'Primary Menu',
        'pages' => 'Page Menu',
	) );

	/**
	 * Enable support for Post Formats
	 */
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link' ) );
    add_theme_support( 'post-formats', array( 'aside' ) );
	
}
endif;
add_action( 'after_setup_theme', 'myCherry_setup' );

/* Load Scripts and Styles */
function myCherry_load() {

	// Enqueue Styles
	wp_enqueue_style( 'style', get_stylesheet_uri() , array(), THEMEVER, false);

	// Enqueue Custom skin color Styles
	$skinName = 'skin-green'; //default
	if (get_option('mycherry_skincolor')!='')
		$skinName = get_option('mycherry_skincolor');
	wp_enqueue_style('skincolor', get_template_directory_uri() . '/css/skins/'.$skinName.'.css', array(), THEMEVER, false);

	// Enqueue Wp-MediaElement Scripts
    wp_enqueue_script('jQuery');
	
	// Enqueue Wp-MediaElement Styles
    wp_enqueue_style('wp-mediaelement');
	
	// Enqueue Wp-MediaElement Scripts
    wp_enqueue_script('wp-mediaelement');

	//comments JS
	wp_enqueue_script( 'comments-js', get_template_directory_uri() . '/comments_ajax.js', false, false , true );
	
}
add_action( 'wp_enqueue_scripts', 'myCherry_load' );

/* Adding Scripts and Styles To The WordPress Admin Area */  
function myCherry_AdminStyles() { 
    wp_register_style( 'mcpanel', get_template_directory_uri() . '/css/mc-panel.css',  array(), '', 'all' );
    wp_enqueue_style( 'mcpanel' );
}  
add_action( 'admin_enqueue_scripts', 'myCherry_AdminStyles' );

/* myCherry Theme-setting */
include('includes/admin/mc_init.php');

/* Custom Sidebar */
function wp_sidebar() {
	register_sidebar(array(
		'id'=>'mycherry_sidebar',
		'name'=>'全站侧边栏',
		'class'=>'box-content',
		'before_widget' => '<div id="%1$s" class="sidebox %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));

    unregister_widget("WP_Widget_Pages");
    //unregister_widget("WP_Widget_Calendar");
    unregister_widget("WP_Widget_Archives");
    unregister_widget("WP_Widget_Links");
    unregister_widget("WP_Widget_Meta");
    unregister_widget("WP_Widget_Search");
    //unregister_widget("WP_Widget_Text");
    unregister_widget("WP_Widget_Categories");
    unregister_widget("WP_Widget_Recent_Posts");
    unregister_widget("WP_Widget_Recent_Comments");
    unregister_widget("WP_Widget_RSS");
    unregister_widget("WP_Widget_Tag_Cloud");
    unregister_widget("WP_Nav_Menu_Widget");
	unregister_widget("WP_Widget_Media_Audio");
	unregister_widget("WP_Widget_Media_Video");
	unregister_widget("WP_Widget_Media_Image");
}
add_action('widgets_init','wp_sidebar');

/* Weather for Aside */
function get_weather() {
	return array(
		'sunny'=>'晴',
		'night'=>'夜',
		'partly-cloudy'=>'少云',
		'cloudy'=>'多云',
		'night-cloudy'=>'夜间多云',
		'cloudy-day'=>'阴天',
		'shower'=>'阵雨',
		'rain'=>'雨',
		'heavy-rain'=>'暴雨',
		'thunder-shower'=>'雷阵雨',
		'snow'=>'雪',
		'sleet'=>'雨夹雪',
		'ice-rain'=>'雨夹雪',
		'heavy-snow'=>'大雪',
		'haze'=>'阴霾',
		'fog'=>'多雾'
	);
}

/* Custom Post Meta*/
$new_meta_boxes =      
	array(      
      /*"music_url" => array(      
			"name" => "music_url",      
			"std" => "音乐",      
			"title" => "音乐地址："),
		"video_url" => array(
			"name"=> "video_url",
			"std"=> "视频",
			"title"=> "视频地址："
            ),*/
		"weather" => array(      
			"name" => "weather",      
			"std" => "天气（仅适用于日志）",      
			"title" => "选择天气：")
		
	);
function new_meta_boxes() {      
	global $post, $new_meta_boxes;      
	foreach($new_meta_boxes as $meta_box) {      
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);          
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';      
		echo'<h4>'.$meta_box['std'].'</h4>';      
		if ($meta_box['name']=='weather') {
		?>
                    <select name="<?=($meta_box['name'].'_value')?>">
                    <?php
					$weather = get_weather();
					foreach($weather as $key=>$val) {
					?>
                    	<option <?php if ($key==$meta_box_value) echo "selected"; ?> value="<?=($key)?>"><?=($val)?></option>
                    <?php
					}
					?>
                    </select>
                    <?php
		} else {
			echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
		}
	}      
}
//create meta box
function create_meta_box() {      
	global $theme_name;      
	if ( function_exists('add_meta_box') ) {      
		add_meta_box( 'new-meta-boxes', 'myCherry主题自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );      
	}      
}
//save post meta data
function save_postdata( $post_id ) {      
	global $post, $new_meta_boxes;      
	foreach($new_meta_boxes as $meta_box) {      
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {      
			return $post_id;      
		}      
		if ( 'page' == $_POST['post_type'] ) {      
			if ( !current_user_can( 'edit_page', $post_id ))      
				return $post_id;      
		}       
		else
		{      
			if ( !current_user_can( 'edit_post', $post_id ))      
				return $post_id;      
		}      
		$data = $_POST[$meta_box['name'].'_value'];      
         
		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")      
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);      
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))      
			update_post_meta($post_id, $meta_box['name'].'_value', $data);      
		elseif($data == "")      
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));      
	}      
}
add_action('admin_menu', 'create_meta_box');      
add_action('save_post', 'save_postdata');

/* Get Article Category ID */
function get_article_category_ID() {
    $category=get_the_category();
    return $category[0]->cat_ID;
}

/* Get Category Root ID */
function get_category_root_id($cat) {
	$this_category = get_category($cat);   // get current category
	while($this_category->category_parent) // if has parent, continue
	{
		$this_category = get_category($this_category->category_parent); // change the parent as current
	}
	return $this_category->term_id; // return root id
}

function mc_test($e) {
    return stripslashes(get_option($e));
}

/* Register Sidebar Widgets */
require get_template_directory() . '/includes/widgets/recentPosts.php';
require get_template_directory() . '/includes/widgets/hotTags.php';
require get_template_directory() . '/includes/widgets/hotPosts.php';
require get_template_directory() . '/includes/widgets/recentComments.php';
require get_template_directory() . '/includes/widgets/mcFunction.php';
require get_template_directory() . '/includes/widgets/search.php';

/* Set the largest length of excerpt */
function set_excerpt_length( $length ) {
    return 180;
}
add_filter( 'excerpt_length', 'set_excerpt_length', 999 );

/* Get the first image in article, else get a random image */
function catch_first_image() {
	global $post, $posts;$first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if(empty($first_img)){
    	$random = mt_rand(1, 20);
    	echo get_bloginfo ( 'stylesheet_directory' );
    	echo '/images/random/'.$random.'.jpg';
    }
    return $first_img;
}

/* Custom the time of comments*/
function time_since($older_date,$comment_date = false) {
	$chunks = array(
		array(86400 , '天前'),
		array(3600 , '小时前'),
		array(60 , '分钟前'),
		array(1 , '秒前'),
	);
	$newer_date = time();
	$since = abs($newer_date - $older_date);
	if($since < 2592000){
		for ($i = 0, $j = count($chunks); $i < $j; $i++){
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			if (($count = floor($since / $seconds)) != 0) break;
		}
		$output = $count.$name;
	}else{
		$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
	}
	return $output;
}
/* Custom Comment Output */
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;
   if(!$commentcount) {
	   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
	   $cpp=get_option('comments_per_page');
	   $commentcount = $cpp * $page;
	}
?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-body">
		<div class="comment-author"><?php echo get_avatar( $comment, $size = '32'); ?></div>
		<div class="comment-head">
			<span class="name"><?php printf(__('%s'), get_comment_author_link()) ?></span>
			<span class="num"> <?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);} ?></span>
			<p> <?php comment_text() ?> </p>
			<div class="post-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></div>
			<div class="date"><?php echo time_since(abs(strtotime($comment->comment_date_gmt . "GMT")), true);?></div>
		</div>
    </div>
<?php
}

/* Page Navigation */
function pagenavi() {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'show_all' => false,
		'end_size'=>'1',   
        'mid_size'=>'5',
        'type' => 'plain',
        'prev_next' => false
    );
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
	previous_posts_link('&laquo;','');
    echo paginate_links($pagination);
	next_posts_link('&raquo;','');
	if( $pagination['total']>1 ){
	}
}

/* 文章访问计数 */
function record_visitors() {
	if (is_singular()) {
	   global $post;
	   $post_ID = $post->ID;
	   if($post_ID) {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	   }
	}
}
add_action('wp_head', 'record_visitors');
/* 取得文章的浏览次数 */
function post_views($after = ' 次浏览', $echo = 1) {
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo number_format($views)." ".$after;
    else return $views;
}

/* 文章点赞数 */
add_action('wp_ajax_nopriv_mc_like', 'mc_like');
add_action('wp_ajax_mc_like', 'mc_like');
function mc_like() {
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'like') {
        $mc_raters = get_post_meta($id,'mc_likes',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        setcookie('mc_likes_'.$id,$id,$expire,'/',$domain,false);
        if (!$mc_raters || !is_numeric($mc_raters)) {
            update_post_meta($id, 'mc_likes', 1);
        } 
        else {
            update_post_meta($id, 'mc_likes', ($mc_raters + 1));
        }
        echo get_post_meta($id,'mc_likes',true);
    };
    die;
}

/* 自定义游客头像 */
function my_gravatar ($avatar_defaults) {  
    $myavatar = get_bloginfo('template_url') . '/images/avatar.jpg';  
    $avatar_defaults[$myavatar] = "MyCherry默认头像";  
    return $avatar_defaults;  
}
add_filter( 'avatar_defaults', 'my_gravatar' );

/* 标签页面 */
function mc_getfirstchar($s0){
	$fchar = ord($s0{0});
	if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
	$s1 = iconv("UTF-8","gb2312", $s0);
	$s2 = iconv("gb2312","UTF-8", $s1);
	if($s2 == $s0){$s = $s1;}else{$s = $s0;}
	$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
	if($asc >= -20319 and $asc <= -20284) return "A";
	if($asc >= -20283 and $asc <= -19776) return "B";
	if($asc >= -19775 and $asc <= -19219) return "C";
	if($asc >= -19218 and $asc <= -18711) return "D";
	if($asc >= -18710 and $asc <= -18527) return "E";
	if($asc >= -18526 and $asc <= -18240) return "F";
	if($asc >= -18239 and $asc <= -17923) return "G";
	if($asc >= -17922 and $asc <= -17418) return "H";
	if($asc >= -17417 and $asc <= -16475) return "J";
	if($asc >= -16474 and $asc <= -16213) return "K";
	if($asc >= -16212 and $asc <= -15641) return "L";
	if($asc >= -15640 and $asc <= -15166) return "M";
	if($asc >= -15165 and $asc <= -14923) return "N";
	if($asc >= -14922 and $asc <= -14915) return "O";
	if($asc >= -14914 and $asc <= -14631) return "P";
	if($asc >= -14630 and $asc <= -14150) return "Q";
	if($asc >= -14149 and $asc <= -14091) return "R";
	if($asc >= -14090 and $asc <= -13319) return "S";
	if($asc >= -13318 and $asc <= -12839) return "T";
	if($asc >= -12838 and $asc <= -12557) return "W";
	if($asc >= -12556 and $asc <= -11848) return "X";
	if($asc >= -11847 and $asc <= -11056) return "Y";
	if($asc >= -11055 and $asc <= -10247) return "Z";
	return null;
}
function mc_pinyin($zh){
	$ret = "";
	$s1 = iconv("UTF-8","gb2312", $zh);
	$s2 = iconv("gb2312","UTF-8", $s1);
	if($s2 == $zh){$zh = $s1;}
	$s1 = substr($zh,$i,1);
	$p = ord($s1);
	if($p > 160){
		$s2 = substr($zh,$i++,2);
		$ret .= mc_getfirstchar($s2);
	}else{
		$ret .= $s1;
	}
	return strtoupper($ret);
}
/*  标签页面 */
function mc_show_tags() {
	if(!$output = get_option('mc_tags_list')){
		$categories = get_terms( 'post_tag', array(
			'orderby' => 'count',
			'hide_empty' => 1
			) );
		foreach($categories as $v){
			for($i = 65; $i <= 90; $i++){
				if(mc_pinyin($v->name) == chr($i)){
					$r[chr($i)][] = $v;
				}
			}
			for($i=48;$i<=57;$i++){
				if(mc_pinyin($v->name) == chr($i)){
					$r[chr($i)][] = $v;
				}
			}
		}
		ksort($r);
		$output = "<ul class='list-inline' id='tag_letter'>";
		for($i=65;$i<=90;$i++){
			$tagi = $r[chr($i)];
			if(is_array($tagi)){
				$output .= "<li><a href='#".chr($i)."'>".chr($i)."</a></li>";
			}else{
				/*$output .= "<li>".chr($i)."</li>";*/
			}
		}
		$output .= "</ul>";
		$output .= "<ul id='all_tags' class='list-unstyled'>";
		for($i=65;$i<=90;$i++){
			$tagi = $r[chr($i)];
			if(is_array($tagi)){
				$output .= "<li id='".chr($i)."'><h4 class='tag_name'>".chr($i)."</h4>";
				foreach($tagi as $tag){
					$output .= "<a href='".get_tag_link($tag->term_id)."'>".$tag->name."(".$tag->count.")</a>";
				}
			}
		}
		$output .= "</ul>";
		update_option('mc_tags_list', $output);
	}
	echo $output;
}
function clear_tags_cache() {
update_option('mc_tags_list', '');
}
add_action('save_post', 'clear_tags_cache');

 function mc_archives_list() {
     if( !$output = get_option('mc_archives_list') ){
         $output = '<div id="mc_archives"><p>[<a id="al_expand_collapse" href="#">全部展开/收缩</a>]  (注: 点击月份可以展开)</p>';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3>'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a>  ('.'<i class="fa fa-comments"></i>'. get_comments_number('0', '1', '%') .')</li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('mc_archives_list', $output);
     }
     echo $output;
 }
 function clear_zal_cache() {
     update_option('mc_archives_list', '');
 }
 add_action('save_post', 'clear_zal_cache');

/* 友链 */
function mc_blogroll_settings_api_init() {
    add_settings_field('mc_blogroll_setting', '友情链接', 'mc_blogroll_setting_callback_function', 'reading');
    register_setting('reading','mc_blogroll_setting');
}
add_action('admin_init', 'mc_blogroll_settings_api_init');
function mc_blogroll_setting_callback_function() {
    echo '<textarea name="mc_blogroll_setting" rows="10" cols="50" id="mc_blogroll_setting" class="large-text code">' . get_option('mc_blogroll_setting') . '</textarea>';
}
function mc_blogroll(){
    $mc_blogroll_setting =  get_option('mc_blogroll_setting');
    if($mc_blogroll_setting){
        $mc_blogrolls = explode("\n", $mc_blogroll_setting);
        foreach ($mc_blogrolls as $mc_blogroll) {
            $mc_blogroll = explode("|", $mc_blogroll ,3);
            echo '<a target="_blank" href="'.trim($mc_blogroll[0]).'" title="'.esc_attr(trim($mc_blogroll[2])).'">【 '.trim($mc_blogroll[1]).' 】</a>';
        }
    }
}


?>
