<?php 
 /*
  Include all options file here
 */

 /* Theme menu page */

 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/parent-page.php';
/* Theme options  settings*/
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/general.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/header.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/banner.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/blog.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/post-page.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/page-search.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/page-404.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/pre-loader.php';
 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/rtl.php');
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/footer.php';

 if( class_exists('WooCommerce') ) {
	 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/settings/woo.php';
 }
 
  /* Post Meta */

 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/posts/custom-fonts.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/posts/post.php';
 require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/posts/page.php';


 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/scroll-top-button.php');
 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/social.php');
 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/style.php');
 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/custom-code.php');
 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/custom-post-type.php');
 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/backup.php');
 include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/theme-optimize.php');
 //include_once(ZENIX_ESSENTIAL_DIR_PATH.'/inc/options/settings/theme-update.php');
  /* Taxonomy Meta */
  //Category
  require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/taxonomy/category.php';
  // Nav
  require_once ZENIX_ESSENTIAL_DIR_PATH . '/inc/options/nav.php';


