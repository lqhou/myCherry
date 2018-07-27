<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Cache-Control" content="no-cache" />
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-app-status-bar-style" content="black" />
    <meta name="apple-touch-fullscreen" content="YES" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        <?php bloginfo('name');
        if (is_home()){echo " | "; bloginfo('description');}
        wp_title( '|', true, 'left' ); ?>
    </title>
    <!-- show favicon -->
    <link id="favicon" href="<?php bloginfo('template_url') ?>/images/favicon.ico" rel="icon" type="image/x-icon" />

    <?php if(is_home()) {
        $keywords = get_option('mycherry_keywords');
        $description = get_option('mycherry_description');
    } elseif (is_single() || is_page()) {
          // $keywords = tagtext();
        $description = get_the_title();
    } elseif (is_category()) {
        $description = category_description();
        if (!empty($description) && get_query_var('paged')) {
            $description .= '(第'.get_query_var('paged').'页)';
            }
        $keywords = single_cat_title('', false);
    } elseif (is_tag())
    {
        $description = tag_description();
        if (!empty($description) && get_query_var('paged')) {
            $description .= '(第'.get_query_var('paged').'页)';
        }
        $keywords = single_tag_title('', false);
    } ?>
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="description" content="<?php echo $description; ?>">

    <link href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css?ver=4.7.0" rel="stylesheet" />


    <?php wp_head(); ?>
</head>

<body>

    <!--loading-->
    <div class="loading"></div>
    <div class="circle-loading"></div>

    <div class="banner">
        <div class="head-top-info">
        <div class="titlebox">
        	<div class="sitetitle">
				<a href="<?php bloginfo('wpurl'); ?>" >
               		<?=(get_option('mycherry_maintitle')!='' ? get_option('mycherry_maintitle') : 'RasBlog')?>
                </a>
			</div>
        	<div class="siteinfo">
				<?=(get_option('mycherry_subtitle')!='' ? get_option('mycherry_subtitle') : 'www.hlqfcee.com')?>
        	</div>
        </div>
        </div><!-- end head-top-info  -->
    </div>
   
    <div class="sitehead" id="sitehead">
        <div class="head-top">
            <!-- adapt to the small screen menu -->
            <div id="categories"><i class="fa fa-bars"></i>
            <select >
                <option value="<?=(bloginfo('home_url'))?>">请选择</option>
                <?php
                $args = array(
                    'hide_empty'=>false
                );
                $header_categories = get_categories($args);
                foreach($header_categories as $category) {
                ?>
                <option value="<?=(get_category_link( $category->term_id ))?>"><?=($category->name)?></option>
                <?php
                }
                ?>
            </select>
            </div>

            <!-- main menu -->
            <div class="navbox">
            <div class="site-icon"> <img src="<?php bloginfo('template_url'); ?>/images/face.png" /> </div>
            <div class="nav">
                <ul>
                <li<?php if ( is_home() ) { echo ' class="current_page_item"'; }?>><a href="<?php bloginfo('url'); ?>/">首页</a></li>
                <?php wp_nav_menu (array(
                'theme_location'  => 'primary',
                'container'       => false,
                'menu'            => '',
                'menu_id'         => 'nav',
                'echo'            => true,
                'fallback_cb'     => '',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '%3$s',
                'depth'           => 1,
                'walker'          => '',)
                ); ?>

                <li id="nav-current" class="nav-current"></li>
                </ul>
            </div>
            </div>
        </div><!-- end head-top  -->


        <div class="head-bottom">
        </div>

        
    </div>

    <div id="map">
        <div class="position">
        当前位置：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
        ><?php
        if( is_single() ){
        $categorys = get_the_category();
        $category = $categorys[0];
        echo( get_category_parents($category->term_id,true,' >') );echo $s.' 查看文章';
        } elseif ( is_page() ){
        the_title();
        } elseif ( is_category() ){
        single_cat_title();
        } elseif ( is_tag() ){
        single_tag_title();
        } elseif ( is_day() ){
        the_time('Y年Fj日');
        } elseif ( is_month() ){
        the_time('Y年F');
        } elseif ( is_year() ){
        the_time('Y年');
        } elseif ( is_search() ){
        echo $s.' 的搜索结果';
        }
        ?>
        </div>
    </div>

    <div class="to-top"><i class="fa fa-angle-up"></i></div>