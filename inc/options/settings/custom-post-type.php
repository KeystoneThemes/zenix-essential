<?php

CSF::createSection( ZENIX_OPTION_KEY, array(
    'id'    => 'cpt_tab',                         // Set a unique slug-like ID
    'title' => esc_html__( 'CPT & Taxonomy', 'zenix-essential' ),
    'icon'  => 'fa fa-cog',
) ); 

CSF::createSection( 'zenix_settings', array(
    'parent' => 'cpt_tab', // The slug id of the parent section
    'title'  => esc_html__( 'Settings', 'zenix-essential' ),
    'icon'   => 'fa fa-share-alt',
    'fields' => array(     
         
        array(
            'id'     => 'cpt_options',
            'type'   => 'repeater',
            'title'  => esc_html__('Custom Post Type','zenix-essential'),
            'fields' => array(
          
                array(
                    'id'      => 'posttype',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Post Type (Unique)', 'zenix-essential' ),                   
                ),
                
                array(
                    'id'      => 'singular_name',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Singular Name', 'zenix-essential' ),                   
                ),
                
                array(
                    'id'      => 'plural_name',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Plural Name', 'zenix-essential' ),                   
                ),
                 
                array(
                    'id'      => 'slug',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Front Slug', 'zenix-essential' ),                   
                ),
                
                array(
                    'id'          => 'supports',
                    'type'        => 'select',
                    'title'       => esc_html__('Select Supports','zenix-essential'),
                    'chosen'      => true,
                    'multiple'    => true,
                    'placeholder' => esc_html__('Select an option','zenix-essential'),
                    'options'     => array(
                        'title' => 'Title', 
                        'editor' => 'Editor',
                        'author' => 'Author',
                        'thumbnail' => 'Thumbnail',
                        'excerpt' => 'Excerpt',
                        'comments' => 'Comments'
                    ),
                    'default'     => 'title'
                ),                  
                
                array(
                    'id'         => 'exclude_from_search',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Exclude From Search?','zenix-essential'),
                    'default'    => false
                ),
                
                array(
                    'id'         => 'has_archive',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Has Archive?','zenix-essential'),
                    'default'    => false
                ),
                
                array(
                    'id'         => 'publicly_queryable',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Publicly Queryable?','zenix-essential'),
                    'default'    => false
                ),
             
                array(
                    'id'         => 'show_in_menu',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in admin menu?','zenix-essential'),
                    'default'    => true
                ),               
                array(
                    'id'      => 'icon',
                    'type'    => 'media',
                    'title' => esc_html__('Nav Icon','zenix-essential'),
                    'library' => 'image',
                    'preview' => true
                  ),
                array(
                    'id'         => 'show_in_nav_menus',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in nav menus?','zenix-essential'),
                    'default'    => false
                ), 
          
            ),
          ),
          array(
            'type'    => 'heading',
            'content' => esc_html__('Custom Taxonomy','zenix-essential'),
          ),
          
          array(
            'id'     => 'cpt_taxonomy_options',
            'type'   => 'repeater',
            'title'  => esc_html__('Custom Taxonomy Type','zenix-essential'),
            'fields' => array(
          
                array(
                    'id'      => 'taxonomy_name',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Taxonomy Name (Unique)', 'zenix-essential' ),                   
                ),
                
                array(
                    'id'      => 'taxonomy_label',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Singular Name', 'zenix-essential' ),                   
                ),
                
                array(
                    'id'      => 'taxonomy_plural_label',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Plural Name', 'zenix-essential' ),                   
                ),
                 
                array(
                    'id'      => 'slug',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Front Slug', 'zenix-essential' ),                   
                ),
                
                array(
                    'id'          => 'post_types',
                    'type'        => 'select',
                    'title'       => esc_html__('Select post types','zenix-essential'),
                    'chosen'      => true,
                    'multiple'    => true,
                    'placeholder' => esc_html__('Select an post type','zenix-essential'),
                    'options'     => function_exists('zenix_get_cache_post_types') ?  zenix_get_cache_post_types() : [],
                    'default'     => ''
                ),
                
                array(
                    'id'         => 'publicly_queryable',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Publicly Queryable?','zenix-essential'),
                    'default'    => true
                ),
                
                array(
                    'id'         => 'show_in_menu',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in admin menu?','zenix-essential'),
                    'default'    => true
                ),  
                 
                
                array(
                    'id'         => 'show_in_nav_menus',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in nav menus?','zenix-essential'),
                    'default'    => false
                ),
                
                array(
                    'id'         => 'show_ui',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in ui?','zenix-essential'),
                    'default'    => true
                ), 
                array(
                    'id'         => 'show_in_rest',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in Rest?','zenix-essential'),
                    'default'    => false
                ), 
                         
            ),
          ),         
    ),

) );