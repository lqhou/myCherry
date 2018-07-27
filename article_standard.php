<?php if (!is_single() && !is_page()) { ?>

    <?php if(($count == 2||$count == 3||$count == 4)) : ?>
        <div class="article-list">
            <div class="header">
                <?php
                    $this_category = get_category($cat);
                    if(!$this_category->category_parent) {
                        $category = get_the_category(); ?>
                        <a class="label" href="<?php echo get_category_link($category[0]->term_id ) ?>">
                        <?php echo $category[0]->cat_name; ?>
                        </a><div class="label-arrow"></div>
                <?php } else { ?>
                    <i class="label-arrow1 fa fa-arrow-circle-right"></i>
                <?php } ?>
                <h1>
                <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?>
                </a>
                </h1>
            </div>

            <div class="article-info">
                <i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?>
                <i class="fa fa-user"></i> <?php the_author(); ?>
                <i class="fa fa-eye"></i> <?php post_views(' 次浏览',1); ?>
                <i class="fa fa-comments"></i> <?php echo get_comments_number(); ?> 条评论
                <i class="fa fa-heart"></i> <?php if( get_post_meta($post->ID,'mc_likes',true) ) {
                        echo get_post_meta($post->ID,'mc_likes',true);
                    } else {
                        echo '0';
                    }?> 人喜欢
            </div>

            <div class="lcontent">
                <div class="contentimg-1">
                    <a href="<?php the_permalink();?>" title="<?php the_title();?>" alt="<?php the_title();?>">
                    <?php //if( has_post_thumbnail() ) : the_post_thumbnail('thumbnail'); ?>
                    <?php // else : ?>
                        <img src="<?php echo catch_first_image() ?>"></img>
                    <?php //endif; ?>
                    </a>
                </div>

                <?php the_excerpt(); ?>

            </div>

        </div>

        <?php if($count < 4): ?>
            <div class="article-list-line"></div>
        <?php endif; ?>

    <?php else: ?>

        <div class="article-list">
            <div class="lcontent">
                <div class="contentimg">
                    <a href="<?php the_permalink();?>" title="<?php the_title();?>" alt="<?php the_title();?>">
                    <?php //if( has_post_thumbnail() ) : the_post_thumbnail('thumbnail'); ?>
                    <?php // else : ?>
                        <img src="<?php echo catch_first_image() ?>"></img>
                    <?php //endif; ?>
                    </a>
                </div>

                <div class="header-sub">
                    <?php
                        $this_category = get_category($cat);
                        if(!$this_category->category_parent) {
                            $category = get_the_category(); ?>
                            <a class="label" href="<?php echo get_category_link($category[0]->term_id ) ?>">
                            <?php echo $category[0]->cat_name; ?>
                            </a><div class="label-arrow"></div>
                    <?php } else { ?>
                        <i class="label-arrow1 fa fa-arrow-circle-right"></i>
                    <?php } ?>
                    <h1>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?>
                    </a>
                    </h1>
                </div>

                <div class="article-info-sub">
                    <i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?>
                    <i class="fa fa-user"></i> <?php the_author(); ?>
                    <i class="fa fa-eye"></i> <?php post_views(' 次浏览',1); ?>
                    <i class="fa fa-comments"></i> <?php echo get_comments_number(); ?> 条评论
                    <i class="fa fa-heart"></i> <?php if( get_post_meta($post->ID,'mc_likes',true) ) {
                            echo get_post_meta($post->ID,'mc_likes',true);
                        } else {
                            echo '0';
                        }?> 人喜欢
                </div>
                
                <?php the_excerpt(); ?>
                
            </div>
        </div>

    <?php endif;?>

<!-- Article or page -->
<?php } else {?>
<?php if (is_single()) { ?>

    <article class="article">

        <div class="articletitle">
            <h1>
            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?>
            </a>
            </h1>
        </div>

        <div class="titleinfo">
            <i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?>
            <i class="fa fa-user"></i> <?php the_author(); ?>
            <i class="fa fa-eye"></i> <?php post_views(' 次浏览',1); ?>
            <i class="fa fa-comments"></i> <?php echo get_comments_number(); ?> 条评论
            <i class="fa fa-heart"></i> <?php if( get_post_meta($post->ID,'mc_likes',true) ) {
                    echo get_post_meta($post->ID,'mc_likes',true);
                 } else {
                    echo '0';
                 }?> 人喜欢
        </div>

        <div class="a-content">
            <?php the_content(); ?>
            <div class="end">
                （全文完）    
            </div>
        </div>

        <!--
        <div class="article-copyright">
            <i class="fa fa-exclamation-circle"></i> 转载烦劳注明：“ 引自<b>
            <a href="<?php// bloginfo('wpurl');?>"><?php// bloginfo('name') ?>
            </a></b>的<b><a href="<?php// the_permalink();?>">《<?//php the_title();?>》</a></b>” 不胜感激！
        </div>
        -->

        <div class="post-author"><div class="avatar"><?php echo get_avatar( get_the_author_email(), '70' ); ?></div>
            <div class="post-author-desc">
                <div class="post-author-description"><li class="post-author-label">关于作者：</li><?php  echo the_author_meta( 'description' ); ?></div>
                <div class="clear" style="clear both"></div>
                <div class="post-author-description"><li class="post-author-label">转载注明：</li>" 转载自<b>
                    <a href="<?php bloginfo('wpurl');?>"><?php bloginfo('name') ?>
                    </a></b>的<b><a href="<?php the_permalink();?>">《<?php the_title();?>》</a></b>"
                </div>
                <div class="clear" style="clear both"></div>
                <div class="post-author-description"><li class="post-author-label">文章订阅：</li>
                    <a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>
                </div>
                <div class="clear" style="clear both"></div>
                <div class="post-author-title"><i class="fa fa-exclamation-circle"></i> 版权声明</div>
            </div>
        </div>



        <!-- Article Feedback  -->
        <div class="article-feedback" <?php if(!mc_test('mycherry_a_feedback')) echo 'style="display:none;"'?> >
            <a href="javascript:;" id="likebtn" data-action="like" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['mc_likes_'.$post->ID])) echo ' done';?>"><i class="fa fa-heart"></i>喜欢 <span class="count">
            <?php if( get_post_meta($post->ID,'mc_likes',true) ) {
                    echo '('.get_post_meta($post->ID,'mc_likes',true).')';
                 } else {
                    echo '(0)';
                 }?></span>
            </a>
            <span id="rewardbtn">赏<div class="rewardbtn-box">暂未启用！</div></span>
            <li id="sharebtn"><i class="fa fa-share-alt"></i>分享<div class="share-box">
            <div class="share-icon">
                <div class="bdsharebuttonbox"><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_fbook" data-cmd="fbook" title="分享到Facebook"></a><a href="#" class="bds_linkedin" data-cmd="linkedin" title="分享到linkedin"></a><a href="#" class="bds_twi" data-cmd="twi" title="分享到Twitter"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
                </div>
                <div class="share-arrow"></div>
            </div></li>
        </div>
        
        <div class="hpageinfo">
            <i class="fa fa-folder-open"></i> <?php the_category(',');?> &nbsp;
            <i class="fa fa-tags"></i> <?php the_tags('');?> &nbsp;
        </div>

    </article>


<?php } else {?>

    <article class="article">

        <div class="pagetitle">
            <a href="<?php the_permalink();?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?>
            </a>
        </div>

        <div class="a-content">
            <?php the_content(); ?>
        </div>

        <div class="hpageinfo">
            <i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?>&nbsp&nbsp
            <i class="fa fa-user"></i> <?php the_author(); ?>&nbsp&nbsp
            <i class="fa fa-eye"></i> <?php post_views(' 次浏览',1); ?>&nbsp&nbsp
        </div>

    </article>

<?php } ?>
<?php } ?>

