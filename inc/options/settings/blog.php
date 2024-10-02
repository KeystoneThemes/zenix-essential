<?php 

    // Blog a top-tab
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'id'    => 'blog_tab',                     // Set a unique slug-like ID
        'title' => esc_html__( 'Blog', 'zenix-essential' ),
        'icon'  => 'fas fa-archive',
    ) ); 
    // Blog
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'blog_tab',                        // The slug id of the parent section
        'icon'   => 'fas fa-archive',
        'title'  => esc_html__( 'General', 'zenix-essential' ),
        'fields' => array(
            array(
                'id'          => 'blog_layout',
                'type'        => 'select',
                'title'       => esc_html__('Blog Layout', 'zenix-essential'),
                'placeholder' => 'Select an Style',
                'options'     => array(
                    'style-1'       => esc_html__('Style 1', 'zenix-essential'),
                    'style-2'  => esc_html__('Style 2', 'zenix-essential'),
                  
                ),
                'default'    => 'style-1',
            ),
             
            array(
                'id'          => 'blog_sidebar',
                'type'        => 'select',
                'title'       => esc_html__('Blog Sidebar', 'zenix-essential'),
                'placeholder' => 'Select an option',
                'options'     => array(
                    'blog-lg'       => esc_html__('No sidebar', 'zenix-essential'),
                    'left-sidebar'  => esc_html__('Left Sidebar', 'zenix-essential'),
                    'right-sidebar' => esc_html__('Right Sidebar', 'zenix-essential'),
                ),
                'default'    => '',
            ),
            array(
                'id'            => 'blog_content_container_size',
                'type'          => 'dimensions',
                'title'         => esc_html__( 'Content Container size(px)', 'zenix-essential' ),
                'placeholder'   => '860',
                'dependency' => array( 'blog_post_nav', '==', 'true' ),
                'units'         => array( 'px','em','cm' ),
                'output_prefix' => 'max',
                'height'        => false,
                'output'        => 'html .default-blog__grid',
            ),
            array(
                'id'          => 'blog_content_padding',
                'type'        => 'spacing',
                'title'       => esc_html__('Blog Content Padding','zenix-essential'),
                'left'        => false,
                'right'       => false,
                'units'       => array( 'px','em','cm' ),
                'output_mode' => 'padding',
                'output'      => 'html .default-blog__area',
            ),
            array(
                'id'      => 'blog_meta_above_title',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog meta above title', 'zenix-essential' ),
                'default' => false,
            ),
            
            array(
                'id'      => 'blog_thumb',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Thumbnail', 'zenix-essential' ),
                'default' => false,
            ),

	        array(
		        'id'      => 'blog_excerpt',
		        'type'    => 'switcher',
		        'title'   => esc_html__( 'Blog Excerpt', 'zenix-essential' ),
		        'default' => true,
	        ),

            array(
                'id'      => 'blog_author',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Author', 'zenix-essential' ),
                'default' => false,
            ),
            
            array(
                'id'      => 'blog_author_image',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Author image', 'zenix-essential' ),
                'default' => false,
            ),

            array(
                'id'      => 'blog_date',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Date', 'zenix-essential' ),
                'default' => true,
            ),
            
            array(
                'id'      => 'blog_comment',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Comment', 'zenix-essential' ),
                'default' => false,
            ),
            
            array(
                'id'      => 'blog_category',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Category', 'zenix-essential' ),
                'default' => true,
            ),
           
            array(
                'id'      => 'blog_readmore',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Readmore', 'zenix-essential' ),
                'default' => true,
            ),
            array(
                'id'      => 'blog_readmore_text',
                'type'    => 'text',
                'title'   => esc_html__( 'Blog Readmore Text', 'zenix-essential' ),
                'default' => esc_html__( 'Read More', 'zenix-essential' ),
            ),
            
            array(
                'id'      => 'blog_readmore__icon',
                'type'    => 'media',
                'title'   => esc_html__('Readmore Icon','zenix-essential'),
                'library' => 'image',
            ),
          
            array(
                'id'      => 'blog_post_nav',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Blog Navigation', 'zenix-essential' ),
                'default' => true,
            ),
            
            array(
                'id'         => 'blog_next_icon',
                'type'       => 'media',
                'title'      => esc_html__('Next Icon','zenix-essential'),
                'library'    => 'image',           
                'dependency' => array( 'blog_post_nav', '==', 'true' ),
            ),
            
            array(
                'id'         => 'blog_prev_icon',
                'type'       => 'media',
                'title'      => esc_html__('Prev Icon','zenix-essential'),
                'library'    => 'image',            
                'dependency' => array( 'blog_post_nav', '==', 'true' ),
            ),

            array(
            'id'          => 'blog_post_nav_alignment',
            'type'        => 'select',
            'title'       => esc_html__( 'Navigation Alignment', 'zenix-essential' ),
            'placeholder' => 'Select an option',
            'options'     => array(
                'justify-content-start'  => esc_html__( 'Left', 'zenix-essential' ),
                'justify-content-center' => esc_html__( 'Center', 'zenix-essential' ),
                'justify-content-end'    => esc_html__( 'Right', 'zenix-essential' ),
            ),          
            'dependency' => array( 'blog_post_nav', '==', 'true' ),
            'default'    => 'justify-content-start'
            ),
           
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Blog & Page Default Options', 'zenix-essential' ),
            ),
            
            array(
                'id'      => 'blog_excerpt_word',
                'type'    => 'number',
                'title'   => esc_html__( 'Blog Excerpt Word', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the words that how many words you want to show in every blog post item.', 'zenix-essential' ),
                'default' => '30',
            ),
        

        )
    ) ); 
     // fav icon
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'blog_tab',                           // The slug id of the parent section  
        'title'  => esc_html__('Sidebar Style','zenix-essential'),
        'icon'   => 'fa fa-image',
        'fields' => array(

            array(
                'id'      => 'news__sidebars_bg',
                'type'    => 'background',
                'title'   => esc_html__( 'Sidebar Background', 'zenix-essential' ),
                'desc'    => esc_html__( 'Upload a new background image to set the footer background.', 'zenix-essential' ),
                'default' => array(
                    'image'      => '',
                    'repeat'     => 'no-repeat',
                    'position'   => 'center center',
                    'attachment' => 'scroll',
                    'size'       => 'cover',
                   
                ),
                'output' => '.default-sidebar__widget .widget,.default-sidebar__widget'
            ),
           
            array(
                    'id'    => 'news__sidebars_padding_top',
                    'type'  => 'slider',
                    'title' => esc_html__( 'Sidebar Padding Top', 'zenix-essential' ),
                    'min'   => 0,
                    'max'   => 200,
                    'step'  => 1,
                    'unit'  => 'px',
                    
            ),
            array(
                    'id'    => 'news__sidebars_padding_bottom',
                    'type'  => 'slider',
                    'title' => esc_html__( 'Sidebar Padding Bottom', 'zenix-essential' ),
                    'min'   => 0,
                    'max'   => 200,
                    'step'  => 1,
                    'unit'  => 'px',
                    
            ),
         
            array(
              'type'    => 'subheading',
              'content' => esc_html__( 'Text & Link Color', 'zenix-essential' ),
            ),
            array(
                'id'     => 'news__sidebars_widget_title_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Title Color', 'zenix-essential' ),
                'desc'   => esc_html__( 'Set Sideabr widget title color form here.', 'zenix-essential' ),
                'output' => '.default-sidebar__widget .widget .widget-title,.default-sidebar__widget .widget-title'
            ),
            array(
                'id'     => 'news__sidebars_widget_content_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Content Color', 'zenix-essential' ),
                'desc'   => esc_html__( 'Set footer widget content color form here.', 'zenix-essential' ),
                'output' => '
                .default-sidebar__widget select, 
                .default-sidebar__widget .tagcloud a,
                .default-sidebar__widget ul li a,
                .rsswidget,
                .default-sidebar__recent-item p,
                .default-sidebar__widget,               
                .default-sidebar__widget .widget,               
                .default-sidebar__wrapper .widget_pages li a,
                .default-sidebar__wrapper .widget_meta li a, 
                .default-sidebar__wrapper .widget_nav_menu li a, 
                .default-sidebar__wrapper .widget_recent_entries li a,s
                .default-sidebar__widget ul li a,
                .default-sidebar__wrapper .widget_rss ul cite,
                .default-sidebar__wrapper .widget_recent_comments li a,
                .default-sidebar__wrapper .widget_rss ul a,
                .default-sidebar__wrapper .widget_rss .rssSummary,
                .default-sidebar__wrapper .widget_rss ul .rss-date,
                .default-sidebar__widget .widget ul li a.url'
            ),
            array(
                'id'     => 'sidebar_border_color',
                'type'   => 'border',
                'title'  => esc_html__( 'Border Color', 'zenix-essential' ),
                'output' => '.default-sidebar__widget'
            ),
            array(
                'id'    => 'sidebar_widget_title_margin_top',
                'type'  => 'slider',
                'title' => esc_html__( 'Title Margin Top', 'zenix-essential' ),
                'min'   => 0,
                'max'   => 200,
                'step'  => 1,
                'unit'  => 'px',
                
          ),
            array(
                'id'    => 'sidebar_widget_title_margin_bottom',
                'type'  => 'slider',
                'title' => esc_html__( 'Title Margin bottom', 'zenix-essential' ),
                'min'   => 0,
                'max'   => 200,
                'step'  => 1,
                'unit'  => 'px',
                
          ),
       
            array(
                'id'     => 'sidebars_link_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Sideber links color', 'zenix-essential' ),
                'desc'   => esc_html__( 'Set the Sidebar area link color', 'zenix-essential' ),
                'output' => '.default-sidebar__widget .single-blog-post a .default-sidebar__widget .tagcloud a, .default-sidebar__widget .widget a, .default-sidebar__widget .widget ul li a.url,.default-sidebar__widget .widget ul li a.rsswidget'
            ),

            array(
                'id'     => 'sidebar_link_hover',
                'type'   => 'color',
                'title'  => esc_html__( 'Sidebar links Hover color', 'zenix-essential' ),
                'desc'   => esc_html__( 'Set the footer area link hover color', 'zenix-essential' ),
                'output' => '.default-sidebar__widget .single-blog-post a:hover, .default-sidebar__widget .tagcloud a:hover,.default-sidebar__widget .widget a:hover, .default-sidebar__widget .widget ul li a.url:hover,.default-sidebar__widget .widget ul li a.rsswidget:hover'
            ),

        )
    ) );