<?php

namespace ZenixEssentialApp\Widgets;

use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Lottie extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wdb--lottie-animation';
	}

	public function get_title() {
		return wdb_elementor_widget_concat_prefix( 'Lottie' );
	}

	public function get_icon() {
		return 'wdb eicon-animation';
	}

	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_keywords() {
		return [ 'animation', 'lottie' ];
	}
	
	public function get_script_depends() {
	   
		return [ 'wdb-lottie' ];
	}
		
    protected function register_controls() {
        $this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Settings', 'zenix-essential' ),
			]
		);
		
        $this->add_control(
			'source',
			[
				'label' => esc_html__( 'Source', 'zenix-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_file',
				'options' => [
					'media_file' => esc_html__( 'Media File', 'zenix-essential' ),
					'external_url' => esc_html__( 'External URL', 'zenix-essential' ),
				],
				
			]
		);

		$this->add_control(
			'source_external_url',
			[
				'label' => esc_html__( 'External URL', 'zenix-essential' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'source' => 'external_url',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter your URL', 'zenix-essential' ),				
			]
		);

		$this->add_control(
			'source_json',
			[
				'label' => esc_html__( 'Upload JSON File', 'zenix-essential' ),
				'type' => Controls_Manager::MEDIA,
				'media_types' => [ 'application/json' ],				
				'condition' => [
					'source' => 'media_file',
				],
			]
		);
		
		$this->add_control(
			'wdb_interactivity_event',
			[
				'label' => esc_html__( 'Trigger', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',		
				'options' => [
					'' => esc_html__( 'None', 'zenix-essential' ),
					'scroll' => esc_html__( 'On Scroll', 'zenix-essential' ),
					'hover' => esc_html__( 'On Hover', 'zenix-essential' ),
					'cursor_move'  => esc_html__( 'Mouse Cursor', 'zenix-essential' ),					
					'click'  => esc_html__( 'On Click', 'zenix-essential' ),					
					'viewport'  => esc_html__( 'Viewport', 'zenix-essential' ),					
				],				
			]
		);
		
		$this->add_control(
			'wdb_interactivity_event_pause',
			[
				'label' => esc_html__( 'Pause', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',	
				'condition' => ['wdb_interactivity_event' => ['click','hover','viewport']],
				'options' => [
					'' => esc_html__( 'None', 'zenix-essential' ),
					'onmouseleave' => esc_html__( 'On Mouseleave', 'zenix-essential' ),
					'onclick' => esc_html__( 'On Click', 'zenix-essential' ),						
										
				],				
			]
		);
		
		$this->add_control(
			'wdb_interactivity_event_replay',
			[
				'label' => esc_html__( 'Replay', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'condition' => ['wdb_interactivity_event' => ['click','hover','viewport'], 'wdb_interactivity_event_pause!' => ['']],
				'default' => '',				
				'options' => [
					'' => esc_html__( 'None', 'zenix-essential' ),
					'onhover' => esc_html__( 'On Hover', 'zenix-essential' ),
					'onclick' => esc_html__( 'On Click', 'zenix-essential' ),
					'inview'  => esc_html__( 'Viewport', 'zenix-essential' )		
				],				
			]
		);
		
		$this->add_control(
			'start_point',
			[
				'label' => esc_html__( 'Start Point', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'condition' => ['wdb_interactivity_event' => ['scroll','cursor_move']],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 5,
					],					
				]				
				
			]
		);
		
		$this->add_control(
			'end_point',
			[
				'label' => esc_html__( 'End Point', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'condition' => ['wdb_interactivity_event' => ['scroll','cursor_move']],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 1500,
						'step' => 5,
					],					
				]				
				
			]
		);
		
		
		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay?', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'zenix-essential' ),
				'label_off' => esc_html__( 'No', 'zenix-essential' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['wdb_interactivity_event' => ['']]
			]
		);
		
		$this->add_control(
			'controls',
			[
				'label' => esc_html__( 'Controls?', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'zenix-essential' ),
				'label_off' => esc_html__( 'No', 'zenix-essential' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop?', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'zenix-essential' ),
				'label_off' => esc_html__( 'No', 'zenix-essential' ),
				'condition' => ['wdb_interactivity_event!' => ['scroll']],
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control(
			'loop_count',
			[
				'label' => esc_html__( 'Times', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 10,
				'condition' => ['loop' => ['yes']]
			]
		);
		
		
		
		$this->add_control(
			'backward',
			[
				'label' => esc_html__( 'Backward Direction?', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'zenix-essential' ),
				'label_off' => esc_html__( 'No', 'zenix-essential' ),
				'condition' => ['wdb_interactivity_event' => ['hover']],
				'return_value' => 'yes',
				'description' => esc_html__('Play it backward.','zenix-essential'),
				'default' => '',
			]
		);		
		
		
		
		$this->add_control(
			'wdb_speed',
			[
				'label' => esc_html__( 'Speed', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 5,
					],					
				]				
				
			]
		);
		
	
		$this->end_controls_section();
		
		$this->start_controls_section(
			'content_properties_section',
			[
				'label' => esc_html__( 'Additiuonal Properties', 'zenix-essential' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		
		$this->add_control(
			'wdb_renderer',
			[
				'label' => esc_html__( 'Renderer', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'zenix-essential' ),
					'svg' => esc_html__( 'Svg', 'zenix-essential' ),
					// 'html' => esc_html__( 'Html', 'zenix-essential' ),
					'canvas'  => esc_html__( 'Canvas', 'zenix-essential' ),					
				],				
			]
		);		
		
		$this->add_control(
			'intermission',
			[
				'label' => esc_html__( 'Intermission', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'condition' => ['wdb_interactivity_event' => ['']],
				'description' => esc_html__('Duration (in milliseconds) to pause before playing each cycle in a looped animation. Set this parameter to 0 (no pause) or any positive number. ','zenix-essential'),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],					
				]				
				
			]
		);		
		
		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'zenix-essential' ),
				'type' => \Elementor\Controls_Manager::COLOR,				
			]
		);


		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'zenix-essential' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'con_width',
				[
					'label' => esc_html__( 'Width', 'zenix-essential' ),
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
						'{{WRAPPER}} lottie-player' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'con_height',
				[
					'label' => esc_html__( 'Height', 'zenix-essential' ),
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
						'{{WRAPPER}} lottie-player' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
					

		$this->end_controls_section();

	}

	protected function render() {
	
        $settings = $this->get_settings_for_display();
        $source   = $settings['source'];
        $url      = '';
        if($source == 'media_file'){
            $source_json = $settings['source_json'];
            $url         = isset($source_json['url']) ? $source_json['url'] : $url;
        }elseif($source == 'external_url'){
           $source_json = $settings['source_external_url'];
           $url         = isset($source_json['url']) ? $source_json['url'] : $url;
        }
        if($url === ''){
			$url = 'https://assets3.lottiefiles.com/packages/lf20_UJNc2t.json';
        }
        $id = $this->get_id();      
		$this->add_render_attribute(
			'wrapper',
			[
				'id'            => 'wdb-lottie-player-'.esc_attr($id),
				'class'         => [ 'wdb-lottie-wrp' ],
				'loop'          => $settings['loop'] == 'yes' ? true: false,
				'background'    => $settings['background_color'] !== '' ? $settings['background_color']: 'transparent',
				'src'           => esc_url($url),
				'data-settings' => json_encode(
					[ 
						'event'       => $settings['wdb_interactivity_event'],
						'pause'       => $settings['wdb_interactivity_event_pause'],
						'play'        => $settings['wdb_interactivity_event_replay'],
						'start_point' => isset( $settings['start_point']['size'] ) ?$settings['start_point']['size'] : 0,
						'end_point'   => isset($settings['end_point']['size']) ? $settings['end_point']['size'] : 300
					] 
				),
			]
		);
		
		$this->set_properties_option();		
		
		?>
          <lottie-player <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>></lottie-player>
		<?php
	}
	
	public function set_properties_option(){
		$settings = $this->get_settings_for_display();
		if($settings['autoplay'] == 'yes'){
			$this->add_render_attribute(
				'wrapper',
				[					
					'autoplay' => true,				
				]
			);
		}
		
		if($settings['controls'] == 'yes'){
			$this->add_render_attribute(
				'wrapper',
				[					
					'controls' => true,				
				]
			);
		}
		
		if( $settings[ 'loop' ] == 'yes' ){
		
			$this->add_render_attribute(
				'wrapper',
				[					
					'count' => $settings['loop_count'],				
				]
			);	
		}
		
		if($settings['wdb_interactivity_event'] == 'hover'){
		
			$this->add_render_attribute(
				'wrapper',
				[					
					'hover' => true,				
				]
			);	
		}
		
		if($settings['backward'] == 'yes'){
		
			$this->add_render_attribute(
				'wrapper',
				[					
					'direction' => -1,				
				]
			);	
		}		
	
		if($settings['wdb_renderer'] != ''){
		
			$this->add_render_attribute(
				'wrapper',
				[					
					'renderer' => $settings['wdb_renderer'],				
				]
			);
			
		}
				
		
		if( isset( $settings['wdb_speed']['size'] ) &&  is_numeric( $settings['wdb_speed']['size'] ) ){
		
			$this->add_render_attribute(
				'wrapper',
				[					
					'speed' => $settings['wdb_speed']['size']				
				]
			);				
		}
	}
}