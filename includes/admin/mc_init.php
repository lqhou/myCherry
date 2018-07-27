<?php

add_action('admin_menu', 'mc_theme_page');
function mc_theme_page () {
	if ( count($_POST) > 0 && isset($_POST['myCherry_settings']) ) {
      
        $options = array ('maintitle','subtitle','skincolor','keywords','description','analysis');
		foreach ( $options as $opt ) {
			delete_option ( 'mycherry_'.$opt, $_POST[$opt] );
          	add_option ( 'mycherry_'.$opt, $_POST[$opt] );
		}

        $socials_cb = array('soc_weibo','soc_qq','soc_weixin','soc_facebook','soc_twitter','soc_mail','soc_google','soc_github','soc_linkedin','a_feedback');
        foreach ( $socials_cb as $opt ) {
            delete_option ( 'mycherry_'.$opt, $_POST[$opt] );
            add_option ( 'mycherry_'.$opt, $_POST[$opt] );
        }
        $socials = array('weibo','facebook','twitter','mail','google','github','linkedin');
        foreach ( $socials as $opt ) {
            delete_option ( 'mycherry_'.$opt, $_POST[$opt] );
            add_option ( 'mycherry_'.$opt, $_POST[$opt] );
        }
	}
	add_theme_page(__('MyCherry设置'), __('MyCherry 主题'), 'edit_themes', basename(__FILE__), 'mc_settings');
}
  
function mc_settings() {
	include_once(TEMPLATEPATH.'/includes/admin/setpanel.php');
}

?>
