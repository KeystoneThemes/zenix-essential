<?php

namespace ZenixEssentialApp\Inc;

use \Elementor\Controls_Manager;
class Wdb_Elementor_Sticky_Section {

    private static $instance = null;
    
    public function __construct() {
      
        // add_action( 'wp_head', [$this, 'inline_script']);
        // add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'sticky_transparent_option' ],50);
        // add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'sticky_transparent_option' ],50);
        // add_action( 'elementor/frontend/section/after_render', array($this, 'after_section_render'), 10, 2);
        // add_action( 'elementor/frontend/container/after_render', array($this, 'after_section_render'), 10, 2);
        
    }
       
    function sticky_transparent_option($element){    

            $element->start_controls_section(
                'wdb_sticky_custom_sticky_section',
                [
                    'tab'           =>  \Elementor\Controls_Manager::TAB_ADVANCED,
                    'label' => esc_html__( 'WDB Sticky', 'zenix-essential' ),
                ]
            );

                $element->add_control(
                    'wdb_global_sticky',
                    [
                        'label' => esc_html__( 'Sticky', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'Yes', 'zenix-essential' ),
                        'label_off' => esc_html__( 'No', 'zenix-essential' ),
                        'return_value' => 'yes',
                        'default' => ''                       
                    ]
                );

                $element->add_responsive_control(
                    'wdb_sticky_type',
                    [
                        'label' => esc_html__( 'Sticky Type', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',                       
                        'options' => [

                            'top'    => esc_html__('Top','zenix-essential'),
                            ''       => esc_html__('none','zenix-essential'),

                        ],
                        'condition' => [
                            'wdb_global_sticky' => ['yes']
                        ],
                        
                    ]
                );

                $element->add_responsive_control(
                    'wdb_sticky_padding',
                    [
                        'label' => esc_html__( 'Padding', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],                     
                        'selectors' => [
                            '{{WRAPPER}}.wdb-is-sticky' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                           
                        ],
                    ]
                );
                
                $element->add_responsive_control(
                    'wdb_sticky_padding_bottom',
                    [
                        'label' => esc_html__( 'Space Bottom', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],                        
                        'selectors' => [
                            '{{WRAPPER}}.wdb-is-sticky' => '--padding-block-end: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                
                $element->add_responsive_control(
                    'wdb_sticky_padding_top',
                    [
                        'label' => esc_html__( 'Space Top', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],                       
                        'selectors' => [
                            '{{WRAPPER}}.wdb-is-sticky' => '--padding-block-start: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
        

                $element->add_control(
                    'wdb_sticky_offset',
                    [
                        'label' => esc_html__( 'Sticky Offset', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'min' => 999,
                        'max' => 9999,                       
                        'step' => 5,
                        'default' => 110,
                        'condition' => [
                            'wdb_global_sticky' => ['yes']
                        ],

                        
                    ]
                );

                $element->add_control(
                    'wdb_sticky_offset_z_index',
                    [
                        'label' => esc_html__( 'Z-index', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'min' => -2000,
                        'max' => 99999,
                        'step' => 5,
                        'condition' => [
                            'wdb_global_sticky' => ['yes']
                        ],
                        'selectors' => [
                            '{{WRAPPER}}' => 'z-index: {{VALUE}};',
                        ],
                    ]
                );
                
                $element->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'wdb_sticky_background',
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}}.wdb-is-sticky',
                       
                    ]
                );
                
                $element->add_control(
                    'more_options_sticky_hading',
                    [
                        'label' => esc_html__( 'Header Navigation', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                
                $element->add_control(
                    'wdb_sticky_text_color',
                    [
                        'label' => esc_html__( 'Menu Color', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            'body {{WRAPPER}}.wdb-is-sticky select' => 'color: {{VALUE}} !important',
                            'body {{WRAPPER}}.wdb-is-sticky ul > li a' => 'color: {{VALUE}} !important',
                            '{{WRAPPER}}.wdb-is-sticky ul > li i' => 'color: {{VALUE}} !important',
                            '{{WRAPPER}}.wdb-is-sticky ul > li svg' => 'fill: {{VALUE}}',
                        ],
                    ]
                );
                
                $element->add_control(
                    'wdb_sticky_text_hover_color',
                    [
                        'label' => esc_html__( 'Menu Hover Color', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [                           
                            'body {{WRAPPER}}.wdb-is-sticky ul > li:hover > a' => 'color: {{VALUE}} !important',
                            '{{WRAPPER}}.wdb-is-sticky ul > li:hover i' => 'color: {{VALUE}} !important',
                            '{{WRAPPER}}.wdb-is-sticky ul > li:hover svg' => 'fill: {{VALUE}}',
                        ],
                    ]
                );
                
                
                $element->add_control(
                    'wdb_sticky_svg_color',
                    [
                        'label' => esc_html__( 'Svg Icon Color', 'zenix-essential' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}}.wdb-is-sticky i' => 'color: {{VALUE}} !important',
                            '{{WRAPPER}}.wdb-is-sticky svg' => 'fill: {{VALUE}} !important',
                            '{{WRAPPER}}.wdb-is-sticky svg path' => 'fill: {{VALUE}} !important',
                        ],
                    ]
                );
                
                $element->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'wdb_sticky_content_typography',
                        'label' => esc_html__( 'Menu Typography', 'zenix-essential' ),
                        'selector' => 'body {{WRAPPER}}.wdb-is-sticky ul > li a',
                    ]
                );
    
            $element->end_controls_section();   
        
    }
  
    public function after_section_render(\Elementor\Element_Base $element)
    {
        $data     = $element->get_data();
        $settings = $data['settings'];
      
        if  (
                (isset($settings['wdb_global_sticky']) && $settings['wdb_global_sticky'] == 'yes') || 
                (isset($settings['wdb_sticky_type']) && $settings['wdb_sticky_type'] != '')
            ){
            $pure_settings = [
              'wdb_global_sticky' => isset($settings['wdb_global_sticky']) ? $settings['wdb_global_sticky'] : null,
              'wdb_sticky_type'   => isset($settings['wdb_sticky_type']) ? $settings['wdb_sticky_type'] : 'top',
              'wdb_sticky_offset' => isset( $settings['wdb_sticky_offset'] ) ? $settings['wdb_sticky_offset'] : null,
            ];
            echo "
            <script>
                window.wdb_section_sticky_data.section".esc_attr($data['id'])." = JSON.parse('".json_encode($pure_settings)."');
            </script>
            ";
        }
       
    }
    public function inline_script(){

		echo '
			<script type="text/javascript">
				var wdb_section_sticky_data = {};
				var wdb_section_sticky_data_url = "";
			</script>
		';
	}
   
  // The object is created from within the class itself
  // only if the class has no instance.
  public static function getInstance(){
  
        if (self::$instance == null){
          self::$instance = new self();
        }
        
        return self::$instance;    
    }    
}


Wdb_Elementor_Sticky_Section::getInstance();

