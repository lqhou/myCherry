<?php get_header(); ?>


<div class="sitebody">
    <div class="wrapcontent">
        <div class="content">
			<?php $count = 1; ?>
			<?php
			global $query_string;
			query_posts($query_string.'&orderby=id');
			if ( have_posts() ) : while ( have_posts() ) : the_post();

				/* Show data */
				if (!is_single() && !is_page()) {
				if(($count == 1||$count == 2||$count == 3)) : ?>
					<!-- <div class="post_date">
					<span class="date_d"><?php the_time('d') ?></span>
					<span class="date_ym"><?php the_time('Y') ?>.<?php echo date('m',get_the_time('U'));?></span>
					</div> -->
				<?php else: ?>
					<div class="article_b">
						<span class="small-number"><?php the_time('m') ?>-<?php the_time('d') ?>
						</span>
					</div>
				<?php endif; $count++; }?>
                <!-- end show data -->

				<?php
				if (get_post_format() == 'aside') {
					//日志型文章
					include('article_aside.php');
				} else {
					//普通类型文章
					include('article_standard.php');
				}
				//当页面类型为Single或者Page时显示评论
				if (is_single() || is_page()) {
			?>

			<?php if(is_single()) { ?>
				
				<section id=”postNextPrev” class="prenext_wrap">
					<div class="pre_wrap">
						<div class="prenext_title"><?php if (get_previous_post()) { previous_post_link("%link","<<< 上一篇",false);} else {echo "";} ?>
							<?php if (get_previous_post()) { previous_post_link("%link","%title",false);} else {echo "没有上一篇了，已经是最后一篇文章!";} ?>	
						</div>
					</div>
					<div class="next_wrap">
						<div class="prenext_title"><?php if (get_next_post()) { next_post_link("%link","下一篇 >>>",false);} else {echo "";} ?>
							<?php if (get_next_post()) { next_post_link("%link","%title",false);} else {echo "没有下一篇了，已经是最新一篇文章!";} ?>
						</div>
					</div>
				</section>
				
				<section class="related_wrap">
					<h1>相关文章</h1>
					<div class="content">
						<ul id="related_article">
						<?php
						global $post, $wpdb;
						$post_tags = wp_get_post_tags($post->ID);
						if ($post_tags) {
							$tag_list = '';
							foreach ($post_tags as $tag) {
								$tag_list .= $tag->term_id.',';
							}
							$tag_list = substr($tag_list, 0, strlen($tag_list)-1);

							$related_posts = $wpdb->get_results("
								SELECT DISTINCT ID, post_title
								FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy
								WHERE {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
								AND ID = object_id
								AND taxonomy = 'post_tag'
								AND post_status = 'publish'
								AND post_type = 'post'
								AND term_id IN (" . $tag_list . ")
								AND ID != '" . $post->ID . "'
								ORDER BY RAND()
								LIMIT 6");

							if ( $related_posts ) {
								foreach ($related_posts as $related_post) {
						?>
							<li><i class="fa fa-list"></i><a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><?php echo $related_post->post_title; ?></a></li>
						<?php   } 
							}
							else {
							echo '<li>暂无相关文章</li>';
							} 
						}
						else {
						echo '<li>暂无相关文章</li>';
						}
						?>
						</ul>
					</div>
				</section>

			<?php } ?>

			<section class="comments">
				<h1>评论交流</h1>
				<div class="content">
					<?php
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '/comments.php' );
					else 
						echo "<p>评论关闭</p>";
					?>
				</div>
			</section>

            <?php
			}
			endwhile; else:
			?>
            <div class="article-list" class="article">
                <h1>Sorry, 没有文章</h1>
                <div class="no-article">
                   没有文章
                </div>  
            </div>
			<?php
				endif;
				wp_reset_query();
			?>

			<?php if (!is_single() && !is_page() && $count>3): ?>
			<div class="article-list-line"></div>
			<?php endif; ?>
    		<div class="pagenavi"><?php pagenavi(); ?></div>

        </div> <!-- end content -->
	</div> <!-- end wrapcontent -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>