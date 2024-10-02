<?php 
 

 // Post Page
CSF::createSection( ZENIX_OPTION_KEY, array(
    'icon'   => 'fas fa-search',
    'id'    => 'search_page_section', // Set a unique slug-like ID
    'title' => esc_html__( 'Search', 'zenix-essential' )
    ) );
    
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'search_page_section', // The slug id of the parent section
        'icon'   => 'fa fa-book',
        'title'  => esc_html__( 'Content', 'zenix-essential' ),
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Search Page Setting', 'zenix-essential' ),
              ),
              
              array(
                'id'      => 'enable_search_sidebar',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Enable Sidebar', 'zenix-essential' ),
                'desc'    => esc_html__( 'If you want to enable sidebar form you can set ( YES / NO )', 'zenix-essential' ),
                'default' => false,
              ),
            
              array(
                  'id'         => 'search_not_found_title',
                  'type'       => 'text',
                  'title'      => esc_html__( 'Search not found title', 'zenix-essential' ),
                  'desc'       => esc_html__( 'Set your Search title.', 'zenix-essential' ),
                  'default'    => esc_html__( 'Nothing found!', 'zenix-essential' ),
              ),
              
              array(
                'id'         => 'search_not_found_content',
                'type'       => 'wp_editor',
                'title'      => esc_html__( 'Error content', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set your 404 error subtitle.', 'zenix-essential' ),
                'default'    => esc_html__( 'It looks like nothing was found here. Maybe try a search?', 'zenix-essential' ),
             ),
              
              array(
                'id'         => 'search_found_title',
                'type'       => 'text',
                'title'      => esc_html__( 'Found Title', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set your search found title.', 'zenix-essential' ),
                'default'    => esc_html__( 'Search Results for:', 'zenix-essential' ),
             ),
         
             array(
                  'id'      => 'enable_search_form',
                  'type'    => 'switcher',
                  'title'   => esc_html__( 'Enable Search Form', 'zenix-essential' ),
                  'desc'    => esc_html__( 'If you want to enable or disable search form you can set ( YES / NO )', 'zenix-essential' ),
                  'default' => true,
             ),
             
             array(
                'type'    => 'heading',
                'content' => 'Limit Post type in Search Result',
              ),
             
             array(
                'id'          => 'search_result_post_types',
                'type'        => 'select',
                'title'       => 'Select post types for search result',
                'chosen'      => true,
                'multiple'    => true,
                'placeholder' => 'Select an post type',
                'options'     => function_exists('zenix_get_cache_post_types') ?  array_merge( zenix_get_cache_post_types(), ['post' => 'post' , 'page'=> 'page'] ) : ['post' => 'post' , 'page'=> 'page'],
                'default'     => ''
            ),  
              
        )
    ) );
    
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'search_page_section', // The slug id of the parent section
        'icon'   => 'fa fa-book',
        'title'  => esc_html__( 'Style', 'zenix-essential' ),
        'fields' => array(
            array(
            
                'id'      => 'search_bg_image',
                'type'    => 'background',
                'title'   => esc_html__( 'Upload Background', 'zenix-essential' ),
                'desc'    => esc_html__( 'Upload main Image width 1200px.', 'zenix-essential' ),
                'output' => '.search .body-wrapper'
            ),
            
            array(
                'id'     => 'search_content_title_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Title Color', 'zenix-essential' ),
                'output' => '.search .default-search-title, .default-search-title-wrapper h2',
                'output_important' => true
            ),
            
            
            array(
                'id'     => 'search_content_c_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Content Color', 'zenix-essential' ),
                'output' => '.search .default-search__again-form p',
                'output_important' => true
            ),
            array(
                'type'    => 'subheading',
                'content' => esc_html__( 'Form', 'zenix-essential' ),
              ),
              
            array(
                'id'     => 'search_form_input_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Input Color', 'zenix-essential' ),
                'output' => '.search .joya-search-form input',
                'output_important' => true
            ),
            array(
                'id'     => 'search_form_input_icon_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Input Icon Color', 'zenix-essential' ),
                'output' => '.search .joya-search-form button i',
                'output_important' => true
            ),
            array(
                'id'     => 'search_form_input_bg_color',
                'type'   => 'color',
                'title'  => esc_html__( 'Input bgColor', 'zenix-essential' ),
                'output' => '.search .joya-search-form input',
                'output_important' => true,
                'output_mode' => 'background-color'
            ),
            
            array(
                'id'     => 'search_form_input_border',
                'type'   => 'border',
                'title'  => esc_html__('Input Border','zenix-essential'),
                'output' => '.search .joya-search-form input'
            ),
            
            array(
                'id'     => 'search_content_input_placeholdercolor',
                'type'   => 'color',
                'title'  => esc_html__( 'Input Placeholder Color', 'zenix-essential' ),
                'output' => '.search .joya-search-form input::placeholder,.search .joya-search-form input::-ms-input-placeholder',
                'output_important' => true
            ),
            array(
                'id'     => 'search_content_button_hborder',
                'type'   => 'border',
                'title'  => esc_html__('Input Border','zenix-essential'),
                'output' => '.search .joya-search-form input:hover'
            ),
        )
    ) );
    