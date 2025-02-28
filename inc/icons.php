<?php 

namespace ZenixEssentialApp\Inc;

Class Zenix_Additional_Icon{

    public function __construct(){
        add_filter( 'elementor/icons_manager/additional_tabs', [$this,'theme_custom_icon_manager']);
        add_filter( 'csf_field_icon_add_icons', [$this, 'csf_icon_field'] );        
        
    }
    
    public function theme_custom_icon_manager($settings){
    
        if(!defined('ZENIX_CSS')){
          return $settings;
        }
  
        $json_data = ZENIX_ESSENTIAL_URL . 'assets/js/elementor-icon.js';

        $settings['zenix-icon-set'] = [
           'name'          => 'wdb-icon-set',
           'label'         => esc_html__( 'Zenix Icons', 'zenix-essential' ),
           'url'           => ZENIX_CSS . '/custom-icons.css',
           'enqueue'       => [ ZENIX_CSS . '/custom-icons.css' ],
           'prefix'        => 'zenix-',
           'displayPrefix' => 'zenix-theme',
           'labelIcon'     => 'fab fa-font-awesome-alt',
           'ver'           => '2.0',
           'fetchJson'     => $json_data
        ];
       
        return $settings;  
    }
    
    public function csf_icon_field($icons){
 
        $newicons[]  = array(
            'title' => 'Wdb Icons',
            'icons' => $this->icons_array()
          );
       
         // $icons = array_reverse( $icons );
          return $newicons;
     }
     
     public function icons_array(){
         return array(
            'wdb-icon icon-wdb-apple-store',
            'wdb-icon icon-wdb-arrow-left1',
            'wdb-icon icon-wdb-arrow-right1',
            'wdb-icon icon-wdb-arrow-up1',
            'wdb-icon icon-wdb-check1',
            'wdb-icon icon-wdb-check-fill',
            'wdb-icon icon-wdb-cross',
            'wdb-icon icon-wdb-envelop1',
            'wdb-icon icon-wdb-kite',
            'wdb-icon icon-wdb-play-icon',
            'wdb-icon icon-wdb-quote1',
            'wdb-icon icon-wdb-quote-style-2',
            'wdb-icon icon-wdb-snapchat',
            'wdb-icon icon-wdb-tiktok',
            'wdb-icon icon-wdb-arrow-down',
            'wdb-icon icon-wdb-arrow-long-down',
            'wdb-icon icon-wdb-arrow-right',
            'wdb-icon icon-wdb-arrow-right-2',
            'wdb-icon icon-wdb-arrow-right-3',
            'wdb-icon icon-wdb-arrow-right-4',
            'wdb-icon icon-wdb-arrow-up',
            'wdb-icon icon-wdb-arrow-up-2',
            'wdb-icon icon-wdb-arrow-up-3',
            'wdb-icon icon-wdb-arrow-up-4',
            'wdb-icon icon-wdb-arrow-up-5',
            'wdb-icon icon-wdb-check',
            'wdb-icon icon-wdb-check-2',
            'wdb-icon icon-wdb-close',
            'wdb-icon icon-wdb-location',
            'wdb-icon icon-wdb-menu-bar-1',
            'wdb-icon icon-wdb-menu-bar-2',
            'wdb-icon icon-wdb-paper-plane',
            'wdb-icon icon-wdb-phone',
            'wdb-icon icon-wdb-play-2',
            'wdb-icon icon-wdb-plus',
            'wdb-icon icon-wdb-quote',
            'wdb-icon icon-wdb-search',
            'wdb-icon icon-wdb-star-2',
            'wdb-icon icon-wdb-star-3',
            'wdb-icon icon-wdb-check-circle',
            'wdb-icon icon-wdb-wdb-Search',
            'wdb-icon icon-wdb-wdb-wdb-dribbble',
            'wdb-icon icon-wdb-youtube',
            'wdb-icon icon-wdb-xing',
            'wdb-icon icon-wdb-wordpress',
            'wdb-icon icon-wdb-whatsup',
            'wdb-icon icon-wdb-video',
            'wdb-icon icon-wdb-user-group',
            'wdb-icon icon-wdb-user',
            'wdb-icon icon-wdb-twitter-sq',
            'wdb-icon icon-wdb-twitter',
            'wdb-icon icon-wdb-tumblr',
            'wdb-icon icon-wdb-tags',
            'wdb-icon icon-wdb-sticky',
            'wdb-icon icon-wdb-share',
            'wdb-icon icon-wdb-wdb-search',
            'wdb-icon icon-wdb-reply',
            'wdb-icon icon-wdb-wdb-quote',
            'wdb-icon icon-wdb-wdb-plus',
            'wdb-icon icon-wdb-play-fill',
            'wdb-icon icon-wdb-pinterest',
            'wdb-icon icon-wdb-minus',
            'wdb-icon icon-wdb-mail',
            'wdb-icon icon-wdb-wdb-phone',
	         'wdb-icon icon-wdb-phone-fill',
	         'wdb-icon icon-wdb-love-fill',
	         'wdb-icon icon-wdb-love',
	         'wdb-icon icon-wdb-wdb-location',
	         'wdb-icon icon-wdb-linkdin-fill',
	         'wdb-icon icon-wdb-linkdin',
	         'wdb-icon icon-wdb-instragram',
	         'wdb-icon icon-wdb-hash',
	         'wdb-icon icon-wdb-facebook',
	         'wdb-icon icon-wdb-facebook-fill',
	         'wdb-icon icon-wdb-facebook-messenger',
	         'wdb-icon icon-wdb-envelop',
	         'wdb-icon icon-wdb-envelop-fill',
	         'wdb-icon icon-wdb-eye',
	         'wdb-icon icon-wdb-digg',
	         'wdb-icon icon-wdb-delicious',
	         'wdb-icon icon-wdb-calender',
	         'wdb-icon icon-wdb-checvron-right',
	         'wdb-icon icon-wdb-chevron-down',
	         'wdb-icon icon-wdb-chevron-left',
	         'wdb-icon icon-wdb-chevron-up',
	         'wdb-icon icon-wdb-clock',
	         'wdb-icon icon-wdb-wdb-close',
	         'wdb-icon icon-wdb-close-circle',
	         'wdb-icon icon-wdb-comment',
	         'wdb-icon icon-wdb-comment-fill',
	         'wdb-icon icon-wdb-comment-sq',
	         'wdb-icon icon-wdb-archive',
	         'wdb-icon icon-wdb-archive-fill',
	         'wdb-icon icon-wdb-arrow-down-1',
	         'wdb-icon icon-wdb-arrow-left',
	         'wdb-icon icon-wdb-arrow-right-1',
	         'wdb-icon icon-wdb-arrow-up-1',
	         'wdb-icon icon-wdb-at',
	         'wdb-icon icon-wdb-bar',
	         'wdb-icon icon-wdb-behance',
	         'wdb-icon icon-wdb-blogger',
	         'wdb-icon icon-wdb-angle-up',
	         'wdb-icon icon-wdb-angle-right',
	         'wdb-icon icon-wdb-angle-left',
	         'wdb-icon icon-wdb-angle-down',
	         'wdb-icon icon-wdb-wdb-menu',
	         'wdb-icon icon-wdb-volume-medium',
	         'wdb-icon icon-wdb-arrow-up-right2',
	         'wdb-icon icon-wdb-arrow-down-left2',
	         'wdb-icon icon-wdb-circle-right',
	         'wdb-icon icon-wdb-circle-left',
         );
     }

}

new Zenix_Additional_Icon();