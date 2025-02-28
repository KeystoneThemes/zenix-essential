<?php 

   // Theme Update
   CSF::createSection( 'zenix_settings', array(
           
    'title'  => esc_html__( 'Theme Update', 'zenix-essential' ),
    'icon'   => 'fa fa-share-square-o',
    'fields' => array(
        // A Heading
        array(
            'type'    => 'heading',
            'content' => esc_html__('Theme Update','zenix-essential'),
        ),
        
        array(
            'type'    => 'notice',
            'style'   => 'warning',
            'content' => '<p>Check Latest Theme Update</p> <a class="button" id="wdb--check-theme-update-status">Check Update</a>',
          ),
  
        array(
            'type'     => 'callback',
            'function' => 'wdb__theme__update__html',
          ),
    ),
) );