<?php

    $hf_page      = admin_url( 'edit.php?post_type=wdb-hf-tpl' );
    $_hf_html = sprintf( '<h4><a href="%s" target="_blank">%s</a></h4>' , esc_url($hf_page), esc_html__('Edit From Builder Page','zenix-essential') );

   // header a top-tab
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'id'    => 'header_tab', // Set a unique slug-like ID
        'title'   => esc_html__( 'Header', 'zenix-essential' ),
        'icon'     => 'fa fa-home',
    ) );


    // Header
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'header_tab', // The slug id of the parent section
        'title'   => esc_html__( 'Header', 'zenix-essential' ),
        'icon'   => 'fa fa-credit-card',
        'fields' => array(

            array(
                'id'      => 'header_style',
                'type'    => 'image_select',
                'title'   => esc_html__( 'Header Style', 'zenix-essential' ),
                'desc'    => esc_html__( 'Select the header style which you want to show on your website.', 'zenix-essential' ),
                'options' => array(
                    'style1' => ZENIX_ESSENTIAL_ASSETS_URL. '/images/header/header-1.svg',
                ),
                'default' => 'style1',
            ),
            
            array(
                'id'      => 'transparent_header',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Transparent Header', 'zenix-essential' ),
                'default' => false,
            ),

            array(
                'id'      => 'sticky_header',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Sticky Header', 'zenix-essential' ),
                'default' => false,
            ),

            array(
                'id'    => 'sticky_header_start_from',
                'type'  => 'number',
                'default' => 150,
                'title' => esc_html__('Sticky Header Start From','zenix-essential'),
                'dependency' => array( 'sticky_header', '==', 'true' )
            ),

            // Button
            array(
                'id'      => 'button_enable',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Enable Cta Button', 'zenix-essential' ),
                'desc'    => esc_html__( 'If you want to enable or disable button you can set ( YES / NO )', 'zenix-essential' ),
                'default' => true,
            ),

            array(
                'id'         => 'button_text',
                'type'       => 'text',
                'title'      => esc_html__( 'Button One lebel', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set the Button text.', 'zenix-essential' ),
                'default'    => 'Join Us',

            ),

            array(
                'id'         => 'button_link',
                'type'       => 'text',
                'title'      => esc_html__( 'Button url', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set the Button url.', 'zenix-essential' ),
                'default'    => '#',
            ),

            array(
                'id'         => 'header_tel_text',
                'type'       => 'text',
                'title'      => esc_html__( 'Tel text', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set your phone text.', 'zenix-essential' ),
                'default'    => '(028) - 2541 - 320',
            ),

            array(
                'id'         => 'header_tel_number',
                'type'       => 'text',
                'title'      => esc_html__( 'Tel number' , 'zenix-essential' ),
                'desc'       => esc_html__( 'Set your phone number.' , 'zenix-essential' ),
                'default'    => esc_html__( '0282541320' , 'zenix-essential' ),
            ),

            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Styling', 'zenix-essential' ),
            ),

            array(
                'id'               => 'inf-header-border-c',
                'type'             => 'border',
                'title'            => esc_html__('Header Border','zenix-essential'),
                'output'           => array( 'html .lawyer-header__inner' ),
                'output_important' => true
              ),

            array(
                'id'               => 'tel_text_color',
                'type'             => 'color',
                'title'            => esc_html__( 'Tel Color', 'zenix-essential' ),
                'output'           => '.header__area-8.default-blog-header .phone',
                'output_important' => true,
            ),

            array(
                'id'      => 'button_content_center',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Button Content Center', 'zenix-essential' ),
                'default' => true
            ),

            array(
                'id'               => 'button_one_text_color',
                'type'             => 'color',
                'title'            => esc_html__( 'Button Color', 'zenix-essential' ),
                'output'           => '.default-blog-header .wc-btn-primary',
                'output_important' => true,
            ),

            array(
                'id'               => 'button_one_bg_color',
                'type'             => 'color',
                'output_important' => true,
                'title'            => esc_html__( 'Button Background Color', 'zenix-essential' ),
                'output'           => '.default-blog-header .wc-btn-primary',
                'output_mode'      => 'background-color'
            ),

            array(
                'id'               => 'button_one_hv_bg_color',
                'type'             => 'color',
                'output_important' => true,
                'title'            => esc_html__( 'Button Hover Background Color', 'zenix-essential' ),
                'output'           => '.default-blog-header .wc-btn-primary:hover',
                'output_mode'      => 'background-color'
            ),

            array(
                'type'    => 'heading',
                'content' => esc_html__('Sticky Header Style','zenix-essential'),
              ),

            array(
                'id'    => 'sticky_header_background',
                'type'  => 'background',
                'title' => esc_html__('Sticky Background','zenix-essential'),
                'background_gradient'             => true,
                'background_origin'               => true,
                'background_clip'                 => true,
                'background_blend_mode'           => true,
                'output_important'                => true,
                'output'                          =>'body .default-blog-header.wdb-is-sticky',
                'dependency'                      => array( 'sticky_header', '==', 'true' )

            ),

            array(
                'id'               => 'sticky_header_padding',
                'type'             => 'spacing',
                'title'            => esc_html__('Sticky Header Padding','zenix-essential'),
                'output'           => 'body .default-blog-header.wdb-is-sticky',
                'output_important' => true,
                'output_mode'      => 'padding',                                              // or margin, relative
                'dependency'       => array( 'sticky_header', '==', 'true' )
            ),
            
            array(
                'id'      => 'sticky_header_menu_color',
                'type'    => 'color',
                'title'   => esc_html__( 'Menu Color', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the menu color by color picker', 'zenix-essential' ),
                'default' => '',
                'output'  => 'body .default-blog-header.wdb-is-sticky .nav-item a,body .default-blog-header.wdb-is-sticky .logo-title a',
                'output_important' => true,
            ),

        )
    ) );

    // Main menu
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'header_tab', // The slug id of the parent section
        'title'      => esc_html__( 'Main Menu', 'zenix-essential' ),
        'icon'   => 'fa fa-sitemap',
        'fields' => array(

            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Menu Background', 'zenix-essential' ),
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
                'output_important' => true,
                'output'           => 'body .default-blog-header'
            ),

            array(
                'id'     => 'header-menu-padding',
                'type'   => 'spacing',
                'title'  => esc_html__('Menu Padding','zenix-essential'),
                'output' => '.lawyer-header__inner,.light .lawyer-header__inner'
              ),

            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Menu Color', 'zenix-essential' ),
            ),

            array(
                'id'      => 'menu_color',
                'type'    => 'color',
                'title'   => esc_html__( 'Menu Color', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the menu color by color picker', 'zenix-essential' ),
                'default' => '',
                'output'  => 'body .default-blog-header .nav-item a,body .logo-title a'
            ),
            array(
                'id'      => 'menu_hover',
                'type'    => 'color',
                'title'   => esc_html__( 'Menu Hover Color', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the menu hover color by color picker', 'zenix-essential' ),
                'default' => '',

                'output'  => 'body .default-blog-header .nav-item:hover > a'
            ),

            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Menu Dropdown Color & Hover', 'zenix-essential' ),
            ),
            array(
                'id'      => 'menu_dropdown_color',
                'type'    => 'color',
                'title'   => esc_html__( 'Menu Dropdown Color', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the menu dropdown color by color picker', 'zenix-essential' ),
                'default' => '',
                'output'  => 'body .default-blog-header .nav-item .dp-menu .nav-item a'
            ),
            array(
                'id'      => 'menu_dropdown_hover__text_color',
                'type'    => 'color',
                'title'   => esc_html__( 'Menu Dropdown Hover Color', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the menu dropdown hover color by color picker', 'zenix-essential' ),
                'default' => '',
                'output'  => 'body .default-blog-header .nav-item .dp-menu .nav-item:hover a'
            ),
            array(
                'id'      => 'menu_dropdown_uibg_color',
                'type'    => 'color',
                'title'   => esc_html__( 'Menu Dropdown bgColor', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the menu dropdown hover color by color picker', 'zenix-essential' ),
                'default' => '',
                'output_mode' => 'background',
                'output'  => '.main-menu ul.dp-menu, .main-menu ul.dp-menu ul'
            ),



        )
    ) );

    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'header_tab', // The slug id of the parent section
        'title'      => esc_html__( 'Mobile Offcanvas', 'zenix-essential' ),
        'icon'   => 'fa fa-sitemap',
        'fields' => array(

            array(
                'id'      => 'offcanvas_responsive_enable',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Custom Responsive Menu', 'zenix-essential' ),
                'default' => false,
            ),

            array(
                'id'      => 'offcanvas_responsive_menu_width',
                'type'    => 'slider',
                'title'   => esc_html__('Responsive Menu Width','zenix-essential'),
                'min'     => 540,
                'max'     => 5000,
                'step'    => 20,
                'unit'    => 'px',
                'default' => 1199,
                'dependency' => array( 'offcanvas_responsive_enable', '==', 'true' )
            ),

            array(
                'id'         => 'offcanvas_content',
                'type'       => 'textarea',
                'title'      => esc_html__( 'Content', 'zenix-essential' ),
                'desc'       => esc_html__( 'below logo text.', 'zenix-essential' ),
                'default'    => '',

            ),

            array(
                'id'    => 'offcanvas_menu_icon_plus',
                'type'  => 'icon',
                'title' => esc_html__('Plus Icon','zenix-essential'),
            ),

            array(
                'id'    => 'offcanvas_menu_icon_minus',
                'type'  => 'icon',
                'title' => esc_html__('Minus Icon','zenix-essential'),
            ),

            array(
                'id'    => 'header_menu_icon',
                'type'  => 'media',
                'title' => esc_html__('Nav Icon','zenix-essential'),
                'library' => 'image',

            ),

            array(
                'id'      => 'offcanvas_gallery_enable',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Gallery', 'zenix-essential' ),
                'default' => false,
            ),


            array(
                'id'    => 'offcanvas_gallery_title',
                'type'  => 'text',
                'title' => esc_html__('Gallery Heading','zenix-essential'),
                'dependency' => array( 'offcanvas_gallery_enable', '==', 'true' ),
            ),

            array(
                'id'     => 'offcanvas_gallery',
                'type'   => 'repeater',
                'title'  => esc_html__('Gallery','zenix-essential'),
                'dependency' => array( 'offcanvas_gallery_enable', '==', 'true' ),
                'fields' => array(

                  array(
                    'id'    => 'url',
                    'type'  => 'text',
                    'title' => esc_html__('URL','zenix-essential')
                  ),

                  array(
                    'id'    => 'image',
                    'type'  => 'media',
                    'library' => 'image',
                    'title' => esc_html__('Image','zenix-essential'),
                  ),

                ),
            ),

            array(
                'id'      => 'offcanvas_social',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Social', 'zenix-essential' ),
                'default' => false,
            ),
            array(
                'type'    => 'notice',
                'style'   => 'zenix-essential',
                'content' => esc_html__('Please Check Social Tab from left sidebar','zenix-essential'),
            ),
            array(
                'id'    => 'offcanvas_social_heading',
                'type'  => 'text',
                'title' => esc_html__('Social Heading','zenix-essential'),
                // 'dependency' => array( 'offcanvas_social', '==', 'true' ),
            ),

            array(
                'type'    => 'heading',
                'content' => esc_html__('Style','zenix-essential'),
            ),

            array(
                'id'          => 'offcanvas_content_alignment',
                'type'        => 'select',
                'title'       => esc_html__('Alignment','zenix-essential'),
                'placeholder' => 'Alignment',
                'options'     => array(
                  'left'  => esc_html__( 'Left' , 'zenix-essential' ),
                  'center'  => esc_html__( 'Center' , 'zenix-essential' ),
                  'right'  => esc_html__( 'Right' , 'zenix-essential' ),
                ),
                'default'     => ''
            ),

            array(

                'id'      => 'offcanvas_container_image',
                'type'    => 'background',
                'title'   => esc_html__( 'Upload Background', 'zenix-essential' ),
                'desc'    => esc_html__( 'Upload main Image width 400px and height 100%.', 'zenix-essential' ),
                'output' => '.offcanvas__area .offcanvas'
            ),

            array(
                'id'      => 'menu-offcanvas-typography',
                'type'    => 'typography',
                'title'   => esc_html__('Menu Typography','zenix-essential'),
                'output'  => 'body .offcanvas__area .offcanvas ul li a'
            ),

            array(
                'id'     => 'offcanvas_container_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Menu Color', 'zenix-essential' ),
                'output' => '                
                body .offcanvas__area .offcanvas ul li a,
                body .offcanvas__area .offcanvas i             
                ',
                'output_important' => true
            ),

            array(
                'id'               => 'header-menu-padding-ofc',
                'type'             => 'spacing',
                'title'            => esc_html__('Menu Padding','zenix-essential'),
                'output'           => 'body .offcanvas__menu-wrapper.mean-container .mean-nav ul li a',
                'output_mode'       => 'padding', // or margin, relative
                'output_important' => true,
               
            ),

            array(
                'id'     => 'menu-border-offcanvas',
                'type'   => 'border',
                'title'  => 'Menu Item Border',
                'output' => array( '.offcanvas__menu-wrapper.mean-container .mean-nav ul li a'),
              ),

            array(
                'id'     => 'offcanvas_container_t_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Title Color', 'zenix-essential' ),
                'output' => '
                .offcanvas__title,
                .body .offcanvas__title            
                ',
                'output_important' => true
            ),

            array(
                'id'     => 'offcanvas_menu_border_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Menu Border Color', 'zenix-essential' ),
                'output' => '
                .offcanvas__menu-wrapper.mean-container .mean-nav > ul > li:last-child > a,
                .offcanvas__menu-wrapper.mean-container .mean-nav > ul > li > a
                ',
                'output_important' => true,
                'output_mode' => 'border-color'
            ),

            array(
                'id'     => 'offcanvas_container_p_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Content Color', 'zenix-essential' ),
                'output' => '              
                .offcanvas__area p,
                .offcanvas__area .offcanvas p
                ',
                'output_important' => true
            ),

            array(
                'id'          => 'logo-and-content-space',
                'type'        => 'spacing',
                'title'       => esc_html__('Logo && Content Spacing','zenix-essential'),
                'output'      => '.offcanvas__logo',
                'output_mode' => 'padding', // or margin, relative
                'default'     => array(
                  'top'       => '0',
                  'right'     => '0',
                  'bottom'    => '30',
                  'left'      => '0',
                  'unit'      => 'px',
                ),
              ),

	        array(
		        'id'          => 'opt-spacing-4',
		        'type'        => 'spacing',
		        'title'       => esc_html__( 'Intro Content Spacing', 'zenix-essential' ),
		        'output'      => '.offcanvas__logo p',
		        'output_mode' => 'padding', // or margin, relative
		        'default'     => array(
			        'top'    => '20',
			        'right'  => '0',
			        'bottom' => '10',
			        'left'   => '0',
			        'unit'   => 'px',
		        ),
	        ),

	        array(
		        'id'          => 'opt-spacing-5',
		        'type'        => 'spacing',
		        'title'       => esc_html__( 'Gallery Spacing', 'zenix-essential' ),
		        'output'      => '.offcanvas__gallery',
		        'output_mode' => 'padding',
	        ),

	        array(
		        'id'    => 'gl_offcanvas_social_icon_size',
		        'type'  => 'typography',
		        'title' => 'Social Media Icon Typography',
		        'output' => '.offcanvas__media li a',
	        ),

	        array(
		        'id'     => 'gl_offcanvas_social_icon_h_color',
		        'type'   => 'color',
		        'title'  => esc_html__( 'Social Media Icon Hover Color', 'zenix-essential' ),
		        'output' => '.offcanvas__media li a:hover',
		        'output_important' => true
	        ),

	        array(
		        'id'          => 'opt-spacing-6',
		        'type'        => 'spacing',
		        'title'       => esc_html__( 'Social Media Spacing', 'zenix-essential' ),
		        'output'      => '.offcanvas__media',
		        'output_mode' => 'padding',
	        ),

       )
    ) );

    // Logo section
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'header_tab', // The slug id of the parent section
        'title'  => 'Logos',
        'icon'   => 'fa fa-file-image-o',
        'fields' => array(

            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Main Image Logo', 'zenix-essential' ),
            ),

            array(
                'id'      => 'general_text_logo',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Text Logo', 'zenix-essential' ),
                'default' => false
            ),

            array(
                'id'         => 'general_blog_title',
                'type'       => 'text',
                'title'      => esc_html__( 'Blog Title', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set global blog title', 'zenix-essential' ),
                'default'    => esc_html__( 'Blog', 'zenix-essential' ),
                'dependency' => array( 'general_text_logo', '==', 'true' )
            ),

            array(
                'id'      => 'logo',
                'type'    => 'upload',
                'title'   => esc_html__( 'Upload Main Logo', 'zenix-essential' ),
                'desc'    => esc_html__( 'Upload main logo width 180px and height 65px.', 'zenix-essential' ),
                'default' => '',
                'help'    => esc_html__( 'Note: Please use logo image max width: 250px and max height 100px.', 'zenix-essential' ),
                'dependency' => array( 'general_text_logo', '==', 'false' )
            ),
            // array(
            //     'id'      => 'dark_logo',
            //     'type'    => 'upload',
            //     'title'   => esc_html__( 'Upload Dark Logo', 'zenix-essential' ),
            //     'desc'    => esc_html__( 'Upload Color logo width 180px and height 65px.', 'zenix-essential' ),
            //     'default' => '',
            //     'help'    => esc_html__( 'Note: Please use logo image max width: 250px and max height 100px.', 'zenix-essential' ),
            //     'dependency' => array( 'general_text_logo', '==', 'false' )
            // ),
            array(
                'id'      => 'offcanvas_logo',
                'type'    => 'upload',
                'title'   => esc_html__( 'Upload Offcanvas Logo', 'zenix-essential' ),
                'desc'    => esc_html__( 'Upload sticky logo width 180px and height 65px.', 'zenix-essential' ),
                'default' => '',
                'help'    => esc_html__( 'Note: Please use logo image max width: 250px and max height 100px.', 'zenix-essential' ),
            ),
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Text Logo Color', 'zenix-essential' ),
                'dependency' => array( 'general_text_logo', '==', 'true' )
            ),
            array(
                'id'      => 'logo_color',
                'type'    => 'color',
                'title'   => esc_html__( 'Text Logo Color', 'zenix-essential' ),
                'desc'    => esc_html__( 'Set the text logo color by color picker.', 'zenix-essential' ),
                'output' => '.logo-title a',
                'dependency' => array( 'general_text_logo', '==', 'true' )
            ),



        )
    ) );