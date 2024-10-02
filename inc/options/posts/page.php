<?php 

  $_hf_html = '';
  if(class_exists('Header_Footer_Elementor')){
    $hf_page      = admin_url( 'edit.php?post_type=elementor-hf' );
    $_hf_html = sprintf( '<h4><a href="%s" target="_blank">%s</a></h4>' , esc_url($hf_page), esc_html__('Manage From Builder Page','zenix-essential') );
  } 

  // Control core classes for avoid errors
  if( class_exists( 'CSF' ) ) {

      //
      // Set a unique slug-like ID
      $post_prefix = 'zenix_page_options';
    
      //
      // Create a metabox for post
      CSF::createMetabox( $post_prefix, array(
        'title'     => 'Settings',
        'post_type' => 'page',
      ) );
      
       // Banner section
       CSF::createSection( $post_prefix, array(
        'title'  => esc_html__('General','zenix-essential'),
        'fields' => array(
        
          array(
              'id'      => 'general_full_site_background',
              'type'    => 'switcher',
              'title'   => esc_html__( 'FullSite Background Pattern', 'zenix-essential' ),
              'default' => false
          ), 
          
          array(
              'id'        => 'general_fullsite_background_preset',
              'type'      => 'image_select',
              'title'     => esc_html__('Background Pattern Select','zenix-essential'),
              'options'   => ZENIX_ESSENTIAL_get_background_patterns(),
              'dependency' => array( 'general_full_site_background', '==', 'true' ),
              'default'   => '',                
          ),
  
          array(
              'id'        => 'general_full_site_custom_background',
              'type'      => 'media',
              'preview'   => false,
              'library'   => 'image',
              'dependency' => array( 'general_fullsite_background_preset|general_full_site_background','==|==','custom|true' ),
              'title'     => esc_html__('Custom Background Pattern','zenix-essential'),
          ),
        
        ) ) );
    
      // Banner section
      CSF::createSection( $post_prefix, array(
        'title'  => 'Banner',
        'fields' => array(
        
          array(
              'id'      => 'disable_banner',
              'type'    => 'switcher',
              'title'   => esc_html__( 'Disable Banner', 'zenix-essential' ),
              'default' => false,           
          ),
                    
          array(
            'id'      => 'blog_content_container_size',
            'type'    => 'dimensions',
            'title'   => esc_html__( 'Content Container size(px)', 'zenix-essential' ),
            'placeholder' => '860',          
            'units' => array( 'px','em','cm' ),
            'output_prefix' => 'max',
            'height' => false,
            'output'=> 'html .default-blog__grid.no-sidebar', 
            
        ),
        array(
            'id'    => 'blog_content_padding',
            'type'  => 'spacing',
            'title' => esc_html__('Blog Content Padding','zenix-essential'),
            'left'  => false,
            'right' => false,
            'units' => array( 'px','em','cm' ),
            'output_mode' => 'padding',
            'output'                => 'html .default-blog__area', 
          ),  
          array(
            'id'    => 'wp_admin_top_margin',
            'type'  => 'spacing',
            'title' => esc_html__('Admin Topbar margin','zenix-essential'),
            'left'  => false,
            'right' => false,
            'bottom' => false,
            'units' => array( 'px','em','cm' ),
            'output_mode' => 'margin',
            'output'                => 'html .admin-bar header,html .admin-bar .body-wrapper', 
        ),
        array(
                'id'      => 'banner_page_title',
                'type'    => 'text',
                'title'   => esc_html__( 'Page Banner', 'zenix-essential' ),
                'dependency' => array( 'disable_banner', '==', false ),
        ), 
       
        array(
  
              'id'      => 'banner_page_image',
              'type'    => 'background',
              'title'   => esc_html__( 'Upload Background', 'zenix-essential' ),
              'desc'    => esc_html__( 'Upload main Image width 1200px and height 400px.', 'zenix-essential' ),
              'output' => 'body.page .default-breadcrumb__area',
              'dependency' => array( 'disable_banner', '==', false ),
        ),
            
        array(
              'id'     => 'page_banner_padding',
              'type'   => 'spacing',
              'title'  => esc_html__('Padding','zenix-essential'),
              'output' => '.page .default-breadcrumb__area'    ,
              'dependency' => array( 'disable_banner', '==', false ),
        ),

        array(
                'id'    => 'banner_page_image_overlay',
                'type'  => 'color',
                'title' => esc_html__( 'Overlay Color', 'zenix-essential' ),
                'output' => '.page .default-breadcrumb__area::before',
                'output_mode' => 'background-color',
                'dependency' => array( 'disable_banner', '==', false ),
        ),
    
        array(
              'id'    => 'banner_page_image_opacity',
              'type'  => 'slider',
              'title' => esc_html__( 'Overlay Opacity', 'zenix-essential' ),
              'min'     => 0,
              'max'     => 1,
              'step'    => 0.1,
              'dependency' => array( 'disable_banner', '==', false ),
        ),

        array(
              'id'     => 'banner_page_title_color',
              'type'   => 'color',
              'title'  => esc_html__( 'Page Title Color', 'zenix-essential' ),
              'output' => '.page .default-breadcrumb__area .default-breadcrumb__title',
              'dependency' => array( 'disable_banner', '==', false ),
          ),

          array(
              'id'     => 'banner_page_breadcrumb_color',
              'type'   => 'color',
              'title'  => esc_html__( 'Page Breadcrumb Color', 'zenix-essential' ),
              'output' => '.page .default-breadcrumb__area li a,.page .default-breadcrumb__list li.active',
              'output_important' => true,
              'dependency' => array( 'disable_banner', '==', false ),
          ),
          array(
            'id'    => 'banner_page_image_overlay',
            'type'  => 'color',
            'title' => esc_html__( 'Overlay Color', 'zenix-essential' ),
            'output' => '.page .default-breadcrumb__area::before',
            'output_mode' => 'background-color',
            'dependency' => array( 'disable_banner', '==', false ),
          ),
    
        )
      ) );
    
      //
      // Header section
      CSF::createSection( $post_prefix, array(
        'title'  => 'Header',
        'fields' => array(

          array(
            'id'          => 'header_style_override',
            'type'        => 'select',
            'title'       => esc_html__('Override Header','zenix-essential'),            
            'options'     => array(
              ''  => esc_html__('No option','zenix-essential'),
              'theme_header'  => esc_html__('Theme Header','zenix-essential'),
            ),
            'default'     => ''
          ),
       
          array(
              'id'      => 'header_style',
              'type'    => 'image_select',
              'title'   => esc_html__( 'Header Style', 'zenix-essential' ),
              'desc'    => esc_html__( 'Select the header style which you want to show on your website.', 'zenix-essential' ),
              'options' => array(
                  'style1' => ZENIX_ESSENTIAL_ASSETS_URL. '/images/header/header-1.svg',
               ),
              'default' => '',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          
          array(
            'id'      => 'transparent_header',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Transparent Header', 'zenix-essential' ),
            'default' => false,
            'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),


          
          array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Menu Background', 'zenix-essential' ),
            'dependency' => array( 'header_style_override', '==', 'theme_header' ),
        ),
        
          array(
              'id'      => 'menu_bg',
              'type'    => 'background',
              'title'   => esc_html__( 'Menu Background', 'zenix-essential' ),
              'desc'    => esc_html__( 'Set the menu background form here.', 'zenix-essential' ),
              'default' => array(
                  'image'      => '',
                  'repeat'     => 'repeat',
                  'position'   => 'center center',
                  'attachment' => 'scroll',
                  'size'       => '',
                  'color'      => '',
              ),
              'output_important'=> true,
              'output' =>'.page .default-blog-header',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          
          array(
              'id'     => 'header-menu-padding',
              'type'   => 'spacing',
              'title'  => esc_html__('Menu Padding','zenix-essential'),
              'output' => '.page .lawyer-header__inner,.page .lawyer-header__inner',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
            ),
        
          array(
              'type'    => 'subheading',
              'content' => esc_html__( 'Menu Color', 'zenix-essential' ),
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
  
          array(
              'id'      => 'menu_color',
              'type'    => 'color',
              'title'   => esc_html__( 'Menu Color', 'zenix-essential' ),
              'desc'    => esc_html__( 'Set the menu color by color picker', 'zenix-essential' ),
              'default' => '',
              'output'  => '.page .default-blog-header .nav-item a,.page .logo-title a',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          array(
              'id'      => 'menu_hover',
              'type'    => 'color',
              'title'   => esc_html__( 'Menu Hover Color', 'zenix-essential' ),
              'desc'    => esc_html__( 'Set the menu hover color by color picker', 'zenix-essential' ),
              'default' => '',
             
              'output'  => '.page .default-blog-header .nav-item:hover > a',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
         
          array(
              'type'    => 'subheading',
              'content' => esc_html__( 'Menu Dropdown Color & Hover', 'zenix-essential' ),
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          array(
              'id'      => 'menu_dropdown_color',
              'type'    => 'color',
              'title'   => esc_html__( 'Menu Dropdown Color', 'zenix-essential' ),
              'desc'    => esc_html__( 'Set the menu dropdown color by color picker', 'zenix-essential' ),
              'default' => '',
              'output'  => '.page .default-blog-header .nav-item .dp-menu .nav-item a',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          array(
              'id'      => 'menu_dropdown_hover__text_color',
              'type'    => 'color',
              'title'   => esc_html__( 'Menu Dropdown Hover Color', 'zenix-essential' ),
              'desc'    => esc_html__( 'Set the menu dropdown hover color by color picker', 'zenix-essential' ),
              'default' => '',
              'output'  => '.page .default-blog-header .nav-item .dp-menu .nav-item:hover a',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          array(
              'id'      => 'menu_dropdown_uibg_color',
              'type'    => 'color',
              'title'   => esc_html__( 'Menu Dropdown bgColor', 'zenix-essential' ),
              'desc'    => esc_html__( 'Set the menu dropdown hover color by color picker', 'zenix-essential' ),
              'default' => '',
              'output_mode' => 'background',
              'output'  => '.page .main-menu ul.dp-menu,.page .main-menu ul.dp-menu ul',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          
          array(
            'type'    => 'heading',
            'content' => esc_html__('Mobile/ Offcanvas','zenix-essential'),
          ),
        
          array(
          
              'id'      => 'offcanvas_container_image',
              'type'    => 'background',
              'title'   => esc_html__( 'Upload Background', 'zenix-essential' ),
              'desc'    => esc_html__( 'Upload main Image width 400px and height 100%.', 'zenix-essential' ),
              'output' => '.offcanvas__area .offcanvas',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          array(
              'id'     => 'offcanvas_container_color',
              'type'   => 'color',
              'title'  => esc_html__( 'Color', 'zenix-essential' ),
              'output' => '
              .page.light .offcanvas__title,
              .page .offcanvas__title,
              .page .offcanvas__area .offcanvas ul li a ,
              .page .offcanvas__area .offcanvas i,
              .page .offcanvas__area .offcanvas p,
              .page .offcanvas__area .offcanvas p
              ',
              'output_important' => true,
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),
          
          array(
              'id'     => 'offcanvas_menu_border_color',
              'type'   => 'color',
              'title'  => esc_html__( 'Menu Border Color', 'zenix-essential' ),
              'output' => '
              .page .offcanvas__menu-wrapper.mean-container .mean-nav > ul > li:last-child > a,
              .page .offcanvas__menu-wrapper.mean-container .mean-nav > ul > li > a
              ',
              'output_important' => true,
              'output_mode' => 'border-color',
              'dependency' => array( 'header_style_override', '==', 'theme_header' ),
          ),  

        )
      ) );
    
      // newslatter
      CSF::createSection( $post_prefix, array(
        'title'  => esc_html__('Footer','zenix-essential'),
        'fields' => array(
            
            array(
              'id'          => 'footer_style_override',
              'type'        => 'select',
              'title'       => esc_html__('Override Footer','zenix-essential'),            
              'options'     => array(
                ''  => esc_html__('No option','zenix-essential'),
                'theme_footer'  => esc_html__('Theme Footer','zenix-essential'),
                'builder_footer'  => esc_html__('Elementor Footer','zenix-essential'),
              ),
              'default'     => ''
            ),
         
            array(
                'id'      => 'footer_style',
                'type'    => 'image_select',
                'title'   => esc_html__( 'Footer Style', 'zenix-essential' ),
                'desc'    => esc_html__( 'Select the footer style which you want to show on your website.', 'zenix-essential' ),
                'options' => array(
                  'style2'       => ZENIX_ESSENTIAL_ASSETS_URL. '/images/footer/footer_2.svg',
                 ),
                'default' => 'style2',
                'dependency' => array( 'footer_style_override', '==', 'theme_footer' ),
            ),
  
            array(
              'id'          => 'builder_footer',
              'type'        => 'select',
              'title'       => esc_html__('Elementor Footer','zenix-essential'),            
              'options'     => zenix_header_footer__custom_ele_type('footer'),
              'default'     => '',
              'dependency'  => array( 'footer_style_override', '==', 'builder_footer' ),
              'after'       => wp_kses_post( $_hf_html ),
            ),           
        )
      ) );
      
      CSF::createSection( $post_prefix , array(
        'title'  => esc_html__( 'Custom Code', 'zenix-essential' ),
        'icon'   => 'fa fa-code',
        'fields' => array(
        
              array(
                'id'            => 'opt-tabbed-code',
                'type'          => 'tabbed',
                'title'         => esc_html__('Custom Code','zenix-essential'),
                'tabs'          => array(
                  array(
                    'title'     => 'Css',
                    'icon'      => 'fa fa-css3',
                    'fields'    => array(                    
                          array(
                            'id'       => 'custom_css',
                            'type'     => 'code_editor',
                            'title'    => esc_html__('Desktop Device','zenix-essential'),
                            'settings' => array(
                              'theme'  => 'mbo',
                              'mode'   => 'css',
                            ),
                            'default'  => '',
                            'placeholder'  => '.element{ color: #ffbc00; }',
                          ),
                        
                         array(
                            'id'       => 'custom_css_tab',
                            'type'     => 'code_editor',
                            'title'    => esc_html__('Tab Device','zenix-essential'),
                            'help' => esc_html__('Max width 991','zenix-essential'),
                            'settings' => array(
                              'theme'  => 'mbo',
                              'mode'   => 'css',
                            ),
                            'default'  => '',
                            'placeholder'  => '.element{ color: #ffbc00; }',
                          ),
                        
                         array(
                            'id'       => 'custom_css_mobile',
                            'type'     => 'code_editor',
                            'title'    => esc_html__('Mobile Device','zenix-essential'),
                            'settings' => array(
                              'theme'  => 'mbo',
                              'mode'   => 'css',
                            ),
                            'placeholder'  => '.element{ color: #ffbc00; }',
                          ),
                    )
                  ),
                  array(
                    'title'     => 'JS',
                    'icon'      => 'fa fa-gear',
                    'fields'    => array(
                        array(
                            'id'       => 'opt_code_editor_js',
                            'type'     => 'code_editor',
                            'title'    => esc_html__('Javascript Editor','zenix-essential'),
                            'settings' => array(
                              'theme'  => 'monokai',
                              'mode'   => 'javascript',
                            ),
                            'default'  => '',
                        ),
                    )
                  ),
                  array(
                    'title'     => 'HTML',
                    'icon'      => 'fab fa-html5',
                    'fields'    => array(
                        array(
                            'id'       => 'opt_code_editor_html',
                            'type'     => 'code_editor',
                            'title'    => 'Footer HTML Editor',
                            'help'     => esc_html__('Html will be load in footer','zenix-essential'),
                            'settings' => array(
                                'theme'  => 'monokai',
                                'mode'   => 'htmlmixed',
                                'tabSize' => 4
                            ),
                            'default'  => '',
                            'sanitize' => false,
                        ),
                    )
                  ),
                )
              ),         
              
        ),
      ) ); 
    
  }
 