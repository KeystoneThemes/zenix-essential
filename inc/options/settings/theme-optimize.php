<?php 

CSF::createSection( ZENIX_OPTION_KEY, array(
        'icon'   => 'fas fa-stethoscope',
        'title'  => esc_html__( 'Asset Optimize','zenix-essential'),
        'fields' => array(
             
            array(
                'id'      => 'optimize_asset_enable',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Asset Optimize', 'zenix-essential' ),
                'desc'    => esc_html__('Do enable this option if your site in http2','zenix-essential'),
                'default' => false
            ),
            
            array(
                'id'         => 'optimize_minify_css',
                'type'       => 'switcher',
                'title'      => esc_html__( 'Minify css', 'zenix-essential' ),
                'default'    => false,
                'dependency' => array( 'optimize_asset_enable', '==', 'true' ),
            ), 
            
            array(
                'id'      => 'ondemand_contact_form_7',
                'type'    => 'switcher',
                'title'   => esc_html__( 'On Demand Contact form 7', 'zenix-essential' ),
                'default' => true,              
            ), 
            
            array(
                'id'      => 'defer_js_and_css',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Theme JS Defer', 'zenix-essential' ),
                'default' => true,              
            ), 
            
        
        )
    ) ); 