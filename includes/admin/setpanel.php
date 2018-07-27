
<div class="mc-wrap">
<div class="mc-content">
<h2>MyCherry 主题设置</h2>
<div class="mc-info">

</div>

<form method="post" action="">

    <div class="mc-box">
		<h3><strong>网站信息</strong></h3>
		<table class="form-table">
			<tr><td>
          		<label>网站主标题：</label>
				<input type="text" name="maintitle" style="width:200px;" placeholder="请输入您的网站主标题！" value="<?php echo get_option('mycherry_maintitle'); ?>" />
			</td></tr>
            <tr><td>
          		<label>网站副标题：</label>
				<input type="text" name="subtitle" style="width:200px;" placeholder="请输入您的网站副标题！" value="<?php echo get_option('mycherry_subtitle'); ?>" />
			</td></tr>
            <tr><td><em>注：这里的 ”主标题“ 和 ”副标题” 有别于 “设置->常规” 中的 “站点标题” 和 “副标题”！<br>&nbsp &nbsp &nbsp &nbsp &nbsp MyCherry主题将前者显示在网站的导航栏上，而后者显示在浏览器标签上！</em> </td></tr>
		</table>
	</div>

     <div class="mc-box">
		<h3><strong>社交信息</strong></h3>
		<table class="form-table">
          <tr><td>
          <label>QQ：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_qq" type="checkbox" value="soc_qq" <?php if(mc_test('mycherry_soc_qq')) echo 'checked="checked"' ?> />
          <em>【注：请自行替换掉 “主题目录>images” 目录下的：qq.jpg】</em>
          </td></tr>
          <tr><td>
          <label>微信：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_weixin" type="checkbox" value="soc_weixin" <?php if(mc_test('mycherry_soc_weixin')) echo 'checked="checked"' ?> />
          <em>【注：请自行替换掉 “主题目录>images” 目录下的：weixin.jpg】</em>
          </td></tr>
		  <tr><td>
          <label>新浪微博：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_weibo" type="checkbox" value="soc_weibo" <?php if(mc_test('mycherry_soc_weibo')) echo 'checked="checked"' ?> />
          <input type="text" name="weibo" style="width:260px;" placeholder="请输入您的新浪微博地址！" value="<?php echo get_option('mycherry_weibo'); ?>" />
          </td></tr>
          <tr><td>
          <label>Facebook：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_facebook" type="checkbox" value="soc_facebook" <?php if(mc_test('mycherry_soc_facebook')) echo 'checked="checked"' ?> />
          <input type="text" name="facebook" style="width:260px;" placeholder="请输入您的Facebook主页地址！" value="<?php echo get_option('mycherry_facebook'); ?>" />
          </td></tr>
          <tr><td>
          <label>Twitter：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_twitter" type="checkbox" value="soc_twitter" <?php if(mc_test('mycherry_soc_twitter')) echo 'checked="checked"' ?> />
          <input type="text" name="twitter" style="width:260px;" placeholder="请输入您的Twitter主页地址！" value="<?php echo get_option('mycherry_twitter'); ?>" />
          </td></tr>
          
          <tr><td>
          <label>Google+：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_google" type="checkbox" value="soc_google" <?php if(mc_test('mycherry_soc_google')) echo 'checked="checked"' ?> />
          <input type="text" name="google" style="width:260px;" placeholder="请输入您的Google+主页地址！" value="<?php echo get_option('mycherry_google'); ?>" />
          </td></tr>

		  <tr><td>
          <label>LinkedIn：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_linkedin" type="checkbox" value="soc_linkedin" <?php if(mc_test('mycherry_soc_linkedin')) echo 'checked="checked"' ?> />
          <input type="text" name="linkedin" style="width:260px;" placeholder="请输入您的LinkedIn主页地址！" value="<?php echo get_option('mycherry_linkedin'); ?>" />
          </td></tr>

		  <tr><td>
          <label>GitHub：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_github" type="checkbox" value="soc_github" <?php if(mc_test('mycherry_soc_github')) echo 'checked="checked"' ?> />
          <input type="text" name="github" style="width:260px;" placeholder="请输入您的GitHub主页地址！" value="<?php echo get_option('mycherry_github'); ?>" />
          </td></tr>

          <tr><td>
          <label>E-mail：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="soc_mail" type="checkbox" value="soc_mail" <?php if(mc_test('mycherry_soc_mail')) echo 'checked="checked"' ?> />
          <input type="text" name="mail" style="width:260px;" placeholder="请输入您的E-mail地址！" value="<?php echo get_option('mycherry_mail'); ?>" />
          </td></tr>
		</table>
	</div>

    <div class="mc-box">
		<h3><strong>“喜欢、分享、打赏”功能</strong></h3>
		<table class="form-table">
          <tr><td>
          <label>Article Feedback：</label><br> &nbsp &nbsp &nbsp &nbsp
          <input name="a_feedback" type="checkbox" value="a_feedback" <?php if(mc_test('mycherry_a_feedback')) echo 'checked="checked"' ?> /><em>【开启后，会在文章页面最后添加“喜欢、分享、打赏”功能！】</em>
          </td></tr>
        </table>
    </div>

    <div class="mc-box">
        <h3><strong>主题颜色</strong></h3>
		<table class="form-table">
			<tr><td>
          		<label>主题颜色：</label>
				<select name="skincolor">
                <?php
				$dir = TEMPLATEPATH.'/css/skins/'; //主题css路径
				$list = scandir($dir); // 得到该文件下的所有文件和文件夹
				foreach($list as $file){//遍历
					$file_location=$dir."/".$file;//生成路径
					if(!is_dir($file_location) && $file!="." &&$file!=".."){ //判断是不是文件夹
						$value = str_replace(".css","",$file);
				?>
                	<option <?php if (get_option('mycherry_skincolor')==$value) echo "selected"; ?> value="<?=($value)?>"><?php echo $value; ?></option>
                <?php
					}
				}
				?>
                </select>
			</td></tr>
		</table>
	</div>
    
	<div class="mc-box">
		<h3><strong>SEO</strong></h3>
		<table class="form-table">
			<tr><td>
          		<label>网站关键词（Meta Keywords）</label><em>【注：多个关键词中间用半角逗号或下划线隔开】</em><br>
				<textarea name="keywords" id="keywords" rows="3" cols="80"><?php echo get_option('mycherry_keywords'); ?></textarea>
			</td></tr>
			<tr><td>
                <label>网站描述（Meta Description）</label><em>【注：针对搜索引擎设置的网页描述】</em><br>
				<textarea name="description" id="description" rows="3" cols="80"><?php echo get_option('mycherry_description'); ?></textarea>
			</td></tr>
		</table>
	</div>
          
    <div class="mc-box">
		<h3><strong>站点统计</strong></h3>
		<table class="form-table">
			<tr><td>
               <label>统计代码</label>&nbsp &nbsp<em>【注：从CNZZ或百度统计获得的代码粘贴到此处】</em><br>
				<textarea name="analysis" id="analysis" rows="3" cols="80"><?php echo stripslashes(get_option('mycherry_analysis')); ?></textarea>
			</td></tr>
		</table>
    </div>
    
	<p class="submit">
        <input type="submit" name="myCherry_settings" class="button-primary" value="<?php _e('保存设置'); ?>" />
	</p>
</form>
</div>
</div>
