<?php if (!is_single() && !is_page()) { ?>

    <div class="article-list">
        <div class="header">
            <?php $category = get_the_category(); ?>
            <a class="label" href="<?php echo get_category_link($category[0]->term_id ) ?>">
            <?php echo "日志 >> " . $category[0]->cat_name; ?>
            </a><div class="label-arrow"></div>
            <h1>
            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title() ?></a>
            </h1>
        </div>
      
        <div class="aside_content">
            <?php the_excerpt(); ?>
        </div>
     
        <div class="aside-info"><?php the_time('Y 年 m 月 d 日 (l)');?>
            <?php 
				if (get_post_meta($post->ID, 'weather_value', true)!='') {
					$weather = get_weather();
			?>
            <div class="weather-name"><?=($weather[get_post_meta($post->ID, 'weather_value', true)])?></div>
            <div class="weather-box weather-<?=(get_post_meta($post->ID, 'weather_value', true))?>"></div>
            <?php
				}
			?>
        </div>
    </div>

<?php } else ?>
<?php if (is_single()) { ?>

    <article class="article ">
      
        <div class="articletitle">
            <h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title() ?></a></h1>
        </div>
     
        <div class="titleinfo">
            <i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?>
            <i class="fa fa-user"></i> <?php the_author(); ?>
            <i class="fa fa-eye"></i> <?php post_views(' ', ' 次浏览'); ?>
            <i class="fa fa-comments"></i> <?php echo get_comments_number(); ?> 条评论
        </div>
      
        <div class="aside_content">
            <?php the_content(); ?>
        </div>
      
        <div class="aside-info"><?php the_time('Y 年 m 月 d 日 (l)');?>
            <?php 
				if (get_post_meta($post->ID, 'weather_value', true)!='') {
					$weather = get_weather();
			?>
            <div class="weather-name"><?=($weather[get_post_meta($post->ID, 'weather_value', true)])?></div>
            <div class="weather-box weather-<?=(get_post_meta($post->ID, 'weather_value', true))?>"></div>
            <?php
				}
			?>
        </div>
    </article>

<?php } ?>