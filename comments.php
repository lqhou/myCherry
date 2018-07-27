<?php if ( post_password_required() ) : ?>
<?php _e( 'Enter your password to view comments.' ); ?>
<?php return; endif; ?>

<div id="comments">

	<div id="respond" class="respond">
		<form action="" method="post" id="commentform" class="comment-form">
			<h3 class="clearfix"><span id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span></h3>
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
				<p class="title welcome"><?php printf(__('您需要 <a href="%s">登录</a> 才可以回复.'), wp_login_url( get_permalink() )); ?></p>
			<?php else : ?>
				<?php if ( is_user_logged_in() ) : ?>
					<p class="title welcome"><?php printf(__('您好，<a href="%1$s">%2$s</a>！期待您的<strong>交流和指正</strong>哦！'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('退出 »'); ?></a></p>
				<?php else : ?>
					<?php if ( $comment_author != "" ): ?>
						<p class="title welcome">
							<?php _e('您好，'); ?><?php printf(__('<strong>%s</strong>！期待您的<strong>交流和指正</strong>哦！'), $comment_author) ?>
							<span class="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span>
						</p>
					<?php else : ?>

					<div class="commentsinfo">
					<p>您好！期待您的<strong>交流和指正</strong>哦！</p>
				    </div>
				<?php endif; ?>
				<div id="author_info">
			<div class="author_info_box">
                <label for="author"><small><?php _e('姓名（必填）：'); ?></small></label>
				<input type="text" name="author" id="author" class="text" size="15" value="<?php echo $comment_author; ?>" />
			</div>
		   	<div class="author_info_box">
                <label for="mail"><small><?php _e('邮箱（必填）：'); ?></small></label>
				<input type="text" name="email" id="mail" class="text" size="15" value="<?php echo $comment_author_email; ?>" />
			</div>
			<div class="author_info_box">
                <label for="url"><small><?php _e('网站：'); ?></small></label>
				<input type="text" name="url" id="url" class="text" size="15" value="<?php echo $comment_author_url; ?>" />
			</div>
       
			</div>
			<?php endif; ?>

			<div id="author_textarea">
				<textarea name="comment" id="comment" class="textarea" cols="105" rows="5" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
			</div>

			<p><input id="submit" type="submit" name="submit" value="<?php _e('确认提交 / Ctrl+Enter'); ?>" class="submit" /></p>
			
			<?php comment_id_fields(); ?> 
			<?php do_action('comment_form', $post->ID); ?>
			<?php endif; ?>
		</form>
	</div>
	
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
      		<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
    	</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">  
				<span class="alignleft"><?php previous_comments_link( __( '&laquo; Older Comments' ) ); ?></span>
				<span class="alignright"><?php next_comments_link( __( 'Newer Comments &raquo;' ) ); ?></span>
			</div>
			<div class="clearfix"></div>
		<?php endif; ?>
		<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p><?php _e( 'Comments are closed.' ); ?></p>
	<?php endif; ?>

</div>