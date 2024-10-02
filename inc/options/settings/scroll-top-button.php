<?php 

  // scroll
  CSF::createSection( 'zenix_settings', array(
    'title'  => esc_html__( 'Scroll Top Button', 'zenix-essential' ),
    'icon'   => 'fa fa-arrow-up',
    'fields' => array(
        array(
            'id'      => 'enable_scroll_top',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Enable Scroll Top', 'zenix-essential' ),
            'desc'    => esc_html__( 'If you want to enable or disable scroll to top button you can set ( YES / NO )', 'zenix-essential' ),
            'default' => true,
        ),
        
        array(
            'id'      => 'footer_copyright_back_button_color',
            'type'    => 'color',
            'title'   => esc_html__( 'Fill Color', 'zenix-essential' ),
            'desc'    => esc_html__( 'Set footer Back Button icon color form here.', 'zenix-essential' ),
          
          
        ),
        
        array(
            'id'      => 'footer_back_button_progress_color',
            'type'    => 'color',
            'title'   => esc_html__( 'Progress Color', 'zenix-essential' ),
            'desc'    => esc_html__( 'Set footer Back Button progress color form here.', 'zenix-essential' ),
          
          
        ),
        
        array(
            'id'      => 'footer_copyright_icon_color',
            'type'    => 'color',
            'title'   => esc_html__( 'Back Button Icon Color', 'zenix-essential' ),
            'desc'    => esc_html__( 'Set footer Back Button icon color form here.', 'zenix-essential' ),
            'output' => '.progress-wrap::after'
        ),

      
    ),
    
) ); 