<?php

namespace ZenixEssentialApp\Inc;
use \Elementor\Controls_Manager;

class Zenix_Section_Settings {

    public function __construct(){
        // add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'add_controls_section' ],50);
        // add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'add_controls_section' ],50);
        add_action( 'elementor/element/icon-box/section_icon/before_section_end', [ $this, 'bottom_top_scroll' ] );
        add_action( 'elementor/element/wdb--button/section_content/before_section_end', [ $this, 'bottom_top_scroll' ] );
        add_action( 'elementor/element/button/section_button/before_section_end', [ $this, 'bottom_top_scroll' ] );
    }
    
    public function bottom_top_scroll( $element ) {
	
        $element->add_control(
			'wdb_enable_bottom_top_scroll',
			[
				'label' => esc_html__( 'Enable ScrollTo', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'zenix-essential' ),
				'label_off' => esc_html__( 'NO', 'zenix-essential' ),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
			]
		);
		
    }

    public function add_controls_section( $element ){

        // $element->start_controls_section(
        //     'wdb_isolation_custom_sticky_section',
        //     [
        //         'tab'           =>  \Elementor\Controls_Manager::TAB_ADVANCED,
        //         'label' => esc_html__( 'Zenix Isolation', 'zenix-essential' ),
        //     ]
        // );

        //     $element->add_control(
        //         'wdb_pro_isolation_type',
        //         [
        //             'label' => esc_html__( 'Isolation', 'zenix-essential' ),
        //             'type' => \Elementor\Controls_Manager::SELECT,
        //             'default' => '',
        //             'options' => [

        //                 'isolate'      => esc_html__( 'Isolate', 'zenix-essential' ),
        //                 'revert'       => esc_html__( 'Revert', 'zenix-essential' ),
        //                 'revert-layer' => esc_html__( 'Revert layer', 'zenix-essential' ),
        //                 'auto'         => esc_html__( 'Auto', 'zenix-essential' ),
        //                 'initial'      => esc_html__( 'Initial', 'zenix-essential' ),
        //                 ''             => esc_html__( 'None', 'zenix-essential' ),
                
        //             ],
        //             'selectors' => [
        //                 '{{WRAPPER}}' => 'isolation: {{VALUE}}',
        //             ],
        //         ]
        //     );
 
       // $element->end_controls_section();
        
    }

   
}

new Zenix_Section_Settings();