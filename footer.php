    <script src="<?php bloginfo('template_url'); ?>/scripts/mc_lode.js"></script>
    <!--<script src="<?php bloginfo('template_url'); ?>/scripts/jquery.min.js"></script>-->
    <script src="<?php bloginfo('template_url'); ?>/scripts/main_nav.js"></script>
 
    <?php if (is_single()) {?>
        <script>
        //文章页图片自适应
        function responsiveImg() {
            var img_count=(jQuery('.article .a-content').find('img')).length;
                if (img_count != 0) {
                    var maxwidth=jQuery(".article .a-content").width();
                    for (var i=0;i<=img_count-1;i++) {
                        var max_width=jQuery('.article .a-content img:eq('+i+')');
                        if (max_width.width() > maxwidth) {
                            max_width.addClass('responsive-img');
                        } else if(maxwidth>400) {
                            max_width.removeClass('responsive-img');
                    }
                }
            }
        }
        jQuery(function() {
            responsiveImg();
            window.onresize = function(){
                responsiveImg();
            }
        });
        </script>
    <?php } ?>

    <div class="sitefoot_pre">
    <svg width="100%" viewBox="0 0 1000 29" version="1.1" preserveAspectRatio="none">
        <defs></defs>
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="FooterWave" transform="translate(0.000000, -424.000000)" fill="">
                <path d="M1024,452.25271 C1024,452.25271 1024,452.252711 1024,431 C978.405999,427.397902 869.678254,419.256709 671,428 C510.632812,435.114797 388.21875,437.373804 266.320313,437.373804 C144.421875,437.373805 0,428.557398 0,428.557398 L0,452.25271 L1024,452.25271 Z" id="footerBlueTop"></path>
            </g>
        </g>
    </svg>
    </div>
   
    <div class="sitefoot">
        <div class="sitefoot_left">
            <div class="sitefoot_title"><i class="fa fa-leaf"></i>作品</div>
            <div class="mc_works">
                <ul>
                    <li><a href="#"><img src="" > </img></a></li>
                    <li><a href="#"><img src="" > </img></a></li>
                    <li><a href="#"><img src="" > </img></a></li>
                </ul>
            </div>
        </div>
        <div class="sitefoot_center">
            <div class="sitefoot_title"><i class="fa fa-external-link"></i>友链</div>
            <div class="mc_brlink">
                <?php mc_blogroll();?>
            </div>
        </div>
        <div class="sitefoot_right">
            <div class="sitefoot_title"><i class="fa fa-user-circle-o"></i>关于</div>
            <div class="foot_about">
                <ul>
                    <li><a href="http://www.rasblog.com/?page_id=53">关于本站</a></li>
                    <li><a target="_blank" href="http://www.rasblog.com/?feed=sitemap">站点地图</a></li>
                </ul>
            </div>
            <div class="socialbox">
              <ul>
                <?php
                if(mc_test('mycherry_soc_mail')) {
                  echo '<li><i class="fa fa-envelope" aria-hidden="true"></i><span class="mail-span">'.get_option(mycherry_mail).'</span></li>';
                }
                if(mc_test('mycherry_soc_qq')) {
                  echo '<li><i class="fa fa-qq" aria-hidden="true"></i><span class="soc-span"><img src="'. get_template_directory_uri() .'/images/qq.jpg"/></span></li>';
                }
				if(mc_test('mycherry_soc_weixin')) {
                  echo '<li><i class="fa fa-weixin" aria-hidden="true"></i><span class="soc-span"><img src="'. get_template_directory_uri() .'/images/weixin.jpg"/></span></li>';
                }
				if(mc_test('mycherry_soc_weibo')) {
                  echo '<li><a href="'.get_option(mycherry_weibo).'" target="_blank" title="新浪微博"><i class="fa fa-weibo" aria-hidden="true"></i></a></li>';
                }
				if(mc_test('mycherry_soc_facebook')) {
                  echo '<li><a href="'.get_option(mycherry_facebook).'" target="_blank" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
                }
				if(mc_test('mycherry_soc_twitter')) {
                  echo '<li><a href="'.get_option(mycherry_twitter).'" target="_blank" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                }
				if(mc_test('mycherry_soc_google')) {
                  echo '<li><a href="'.get_option(mycherry_google).'" target="_blank" title="Google+"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
                }
				if(mc_test('mycherry_soc_linkedin')) {
                  echo '<li><a href="'.get_option(mycherry_linkedin).'" target="_blank" title="LinkedIn"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>';
                }
				if(mc_test('mycherry_soc_github')) {
                  echo '<li><a href="'.get_option(mycherry_github).'" target="_blank" title="GitHub"><i class="fa fa-github" aria-hidden="true"></i></a></li>';
                }
				?>
              </ul>
            </div>
        </div>
    </div>
 
    <div class="site_copyright">
        <ul>粤ICP备18041580号</ul>
        <ul>Copyright &copy; 2016-2018 &nbsp <a href="http://www.rasblog.com/"> RasBlog </a> &nbsp All rights reserved.</ul>
    </div>
 
    <?php echo stripslashes(get_option('mycherry_analysis'))."\r\n"; ?>
 
    <!--Baidu Share-->
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
 
    <?php wp_footer(); ?>
</body>
</html>
