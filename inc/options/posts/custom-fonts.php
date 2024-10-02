<?php 

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

    // Set a unique slug-like ID
    $post_prefix = 'zenix_custom_fonts_options';
  
    CSF::createMetabox( $post_prefix, array(
      'title'     => 'Settings',
      'post_type' => 'wdb-custom-font',
    ) );
     
    
    CSF::createSection( $post_prefix, array(
      'title'  =>  esc_html__( 'Settings', 'zenix-essential'),
      'fields' => array(
      
        array(
          'type'     => 'callback',
          'function' =>  'wdb_custom_font_demo_review_callback',
        ),
      
        array(
          'id'     => 'wdb_font_variation',
          'type'   => 'repeater',
          'title'  => esc_html__('Add Font Variation','joya-essential'),
          'fields' => array(
        
            array(
              'id'          => 'font_weight',
              'type'        => 'select',
              'title'       => esc_html__('Font Weight','zenix-essential'),
              'placeholder' => esc_html__('Select an Weight','zenix-essential'),
              'options'     => array(
                '100'  => '100',
                '200'  => '200',                
                '300'  => '300',                
                '400'  => '400 Regular',                
                '500'  => '500',                
                '600'  => '600',                
                '700'  => '700',                
                '800'  => '800',                
                '900'  => '900',                
              ),
              'default'     => '400'
            ),
            
            array(
              'id'          => 'font_style',
              'type'        => 'select',
              'title'       => esc_html__('Style','zenix-essential'),
              'placeholder' => 'Select an Style',
              'options'     => array(
                'normal'  => 'Normal',
                'italic'  => 'Italic',
                'oblique'  => 'Oblique'                             
              ),
              'default'     => 'normal'
            ),
            
            array(
              'id'      => 'woff_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('The Web Open Font Format','zenix-essential'),
              'title'   => esc_html__('WOFF FILE','zenix-essential'),             
            ),
            
            array(
              'id'      => 'woff2_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('The Web Open Font Format 2 . Used by modern browser','zenix-essential'),
              'title'   => esc_html__('WOFF2 FILE','zenix-essential'),             
            ),
            
            array(
              'id'      => 'ttf_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('The TrueType Font Format  . Best used for safari , android ios','zenix-essential'),
              'title'   => esc_html__('TTF FILE','zenix-essential'),             
            ),
            
            array(
              'id'      => 'eot_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('Embeded Open Type   . Best used for IE6-9','zenix-essential'),
              'title'   => esc_html__('EOT FILE','zenix-essential'),             
            ),            
        
          ),
        ),
  
      )
      
    ) );    
  
  }
  