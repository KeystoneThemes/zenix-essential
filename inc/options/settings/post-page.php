<?php 
 

 // Post Page
CSF::createSection( ZENIX_OPTION_KEY, array(
    'icon'   => 'fa fa-book',
    'title' => esc_html__( 'Post & Page', 'zenix-essential' ),
    'fields' => array(

        array(
          'type'    => 'subheading',
          'content' => esc_html__( 'Post Setting', 'zenix-essential' ),
        ),        
        
        array(
            'id'      => 'single_post_tags',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Enable Post tags', 'zenix-essential' ),
            'desc'    => esc_html__( 'If you want to enable or disable single post tags you can set ( YES / NO )', 'zenix-essential' ),
            'default' => true,
        ),

        array(
            'id'      => 'blog_single_author_box',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Blog Author About', 'zenix-essential' ),
            'default' => false
        ),
        
        array(
            'id'            => 'blog_post_preset_grp',
            'type'          => 'tabbed',
            'title'         => esc_html__('Preset','zenix-essential'),
            'tabs'          => array(
              array(
                'title'     => 'Post Single',
                'icon'      => 'fas fa-warehouse',
                'fields'    => array(
                    
                    array(
                        'id'        => 'post_layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Layout','zenix-essential'),
                        'options'   => array(
                          'default' => ZENIX_ESSENTIAL_ASSETS_URL . 'images/patterns/default.svg',
                          'health-one' => ZENIX_ESSENTIAL_ASSETS_URL . 'images/patterns/layout-1.svg',
                          'athlete' => ZENIX_ESSENTIAL_ASSETS_URL . 'images/patterns/layout-2.svg',
                        ),
                        'default'   => 'default',
                    ),
            
                    array(
                        'id'      => 'preset_blog_banner',
                        'type'    => 'switcher',
                        'title'   => esc_html__( 'Banner', 'zenix-essential' ),
                        'default' => false,
                        'dependency' => array( 'post_layout', 'any', 'health-one,athlete' )
                    ), 
                    
                    array(
                        'id'      => 'preset_blog_view',
                        'type'    => 'switcher',
                        'title'   => esc_html__( 'View', 'zenix-essential' ),
                        'default' => false,
                        'dependency' => array( 'post_layout', 'any', 'health-one,athlete' )
                    ),
                    
                    array(
                        'id'      => 'preset_blog_sidebar',
                        'type'    => 'switcher',
                        'title'   => esc_html__( 'Sidebar', 'zenix-essential' ),
                        'default' => false,
                        'dependency' => array( 'post_layout', 'any', 'health-one,athlete' )
                    ),
                    
                    array(
                        'type'     => 'callback',
                        'function' => 'zenix_elementor_post_single_layout_json',
                        'dependency' => array( 'post_layout', '==', 'elementor_builder' )
                    )
                    
                )
              ),           
            )
          ),
          
          


    ),
) );

