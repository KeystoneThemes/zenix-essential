<?php 

    include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/sidebar-widgets/recent-post.php');
    include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/sidebar-widgets/social.php');
    include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/sidebar-widgets/cta-banner.php');
    
    add_action( 'widgets_init', 'zenix_register_sidebar_widgets' );
    
    function zenix_register_sidebar_widgets() {
    	register_widget( 'Zenix_Recent_Post' );
    	register_widget( 'Zenix_Banner_Widget' );
    }
