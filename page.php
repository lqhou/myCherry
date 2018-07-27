<?php 
get_header();
?>

<div class="sitebody">

    <div class="pageleft">
        <!-- page menu -->
        <div class="page-nav">
            <ul>
		    <?php wp_nav_menu (array(
              'theme_location'  => 'pages',
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
            </ul>
        </div>
    </div>
    <div class="pagecontent">

    <?php
        global $query_string;
        query_posts($query_string.'&orderby=id');
        if ( have_posts() ) : while ( have_posts() ) : the_post();
    ?>
  
		<article class="article">
			<div class="pagetitle">
                <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?></a>
            </div>
                  
            <div class="a-content">
				<?php the_content(); ?>
            </div>
  
			<div class="hpageinfo">
				<i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?> &nbsp;
				<i class="fa fa-eye"></i> <?php post_views(' ', ' 次浏览'); ?>
			</div>
		</article>

		<section class="comments">
            <h1>评论交流</h1>
            <div class="content">
               <?php comments_template();?>
            </div>
        </section>

    <?php
        endwhile;
		endif;
		wp_reset_query();
	?>

    </div>
</div>
<?php get_footer(); ?>