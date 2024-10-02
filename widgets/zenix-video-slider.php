<?php

namespace ZenixEssentialApp\Widgets;

use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Video Slider
 *
 * Elementor widget for Video Slider.
 *
 * @since 1.0.0
 */
class Zenix_Video_Slider extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'zenix--video-slider';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Zenix Video Slider', 'zenix-essential' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_icon() {
		return 'wdb eicon-slider-video';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_script_depends() {
		wp_register_script( 'zenix-video-slider', ZENIX_ESSENTIAL_ASSETS_URL . '/js/widgets/video-slider.js', [ 'jquery' ], false, true );

		return [ 'swiper', 'zenix-video-slider' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Videos', 'zenix-essential' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			's_video_link',
			[
				'label' => esc_html__( 'Video Link', 'zenix-essential' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'https://keystonethemes.com/assets/wp-content/uploads/2024/05/insurance-video.mp4', 'zenix-essential' ),
				'placeholder' => esc_html__( 'Enter your link here', 'zenix-essential' ),
                'label_block' => true,
			]
		);

		$this->add_control(
			'video_list',
			[
				'label'   => esc_html__( 'Video Slider', 'zenix-essential' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [ [], [], [], [], [] ],
			]
		);

		$this->end_controls_section();

		//slider control
		$this->slider_controls();


		//layout style
		$this->start_controls_section(
			'section_slide_style',
			[
				'label' => esc_html__( 'Video Slider', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slide_height',
			[
				'label'      => esc_html__( 'Height', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide video' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_height',
			[
				'label'      => esc_html__( 'Video Height', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide video' => 'transform: scaleY({{SIZE}});',
				],
			]
		);

		$this->add_responsive_control(
			'active_slide_height',
			[
				'label'      => esc_html__( 'Active Height', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 700,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide-active iframe, {{WRAPPER}} .swiper-slide-active video, {{WRAPPER}} .zenix_video_slider' => 'height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                        'center_slide' => 'yes',
                ],
			]
		);

		$this->add_responsive_control(
			'active_video_height',
			[
				'label'      => esc_html__( 'Active Video Height', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
                        'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide-active video' => 'transform: scaleY({{SIZE}});',
				],
				'condition' => [
					'center_slide' => 'yes',
				],
			]
		);

		$this->end_controls_section();


		// Slider Navigation Style
		$this->slider_navigation_style_controls();

		// Slider Pagination Style
		$this->slider_pagination_style_controls();
	}

	/**
	 * Register the slider controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function slider_controls() {
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => esc_html__( 'Slider Options', 'zenix-essential' ),
			]
		);

		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'       => esc_html__( 'Slides to Show', 'zenix-essential' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '2',
				'required'    => true,
				'options'     => [
					                 'auto' => esc_html__( 'Auto', 'zenix-essential' ),
				                 ] + $slides_to_show,
				'render_type' => 'template',
				'selectors'   => [
					'{{WRAPPER}}' => '--slides-to-show: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'zenix-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => esc_html__( 'Yes', 'zenix-essential' ),
					'no'  => esc_html__( 'No', 'zenix-essential' ),
				],
			]
		);

		$this->add_control(
			'autoplay_delay',
			[
				'label'     => esc_html__( 'Autoplay delay', 'zenix-essential' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoplay_interaction',
			[
				'label'     => esc_html__( 'Autoplay Interaction', 'zenix-essential' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'true',
				'options'   => [
					'true'  => esc_html__( 'Yes', 'zenix-essential' ),
					'false' => esc_html__( 'No', 'zenix-essential' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'allow_touch_move',
			[
				'label'     => esc_html__( 'Allow Touch Move', 'zenix-essential' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'false',
				'options'   => [
					'true'  => esc_html__( 'Yes', 'zenix-essential' ),
					'false' => esc_html__( 'No', 'zenix-essential' ),
				],
			]
		);

		// Loop requires a re-render so no 'render_type = none'
		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'zenix-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__( 'Yes', 'zenix-essential' ),
					'false' => esc_html__( 'No', 'zenix-essential' ),
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => esc_html__( 'Animation Speed', 'zenix-essential' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label'       => esc_html__( 'Space Between', 'zenix-essential' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 20,
				'render_type' => 'template',
				'selectors'   => [
					'{{WRAPPER}}' => '--space-between: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'center_slide',
			[
				'label'        => esc_html__( 'Center Slide', 'zenix-essential' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'zenix-essential' ),
				'label_off'    => esc_html__( 'No', 'zenix-essential' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator'    => 'before',
			]
		);

		//slider navigation
		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Navigation', 'zenix-essential' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'dots',
				'options'   => [
					'both'   => esc_html__( 'Arrows and Dots', 'zenix-essential' ),
					'arrows' => esc_html__( 'Arrows', 'zenix-essential' ),
					'dots'   => esc_html__( 'Dots', 'zenix-essential' ),
					'none'   => esc_html__( 'None', 'zenix-essential' ),
				],
			]
		);

		$this->add_control(
			'navigation_previous_icon',
			[
				'label'            => esc_html__( 'Previous Arrow Icon', 'zenix-essential' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon'  => 'eicon-chevron-left',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended'      => [
					'fa-regular' => [
						'arrow-alt-circle-left',
						'caret-square-left',
					],
					'fa-solid'   => [
						'angle-double-left',
						'angle-left',
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'caret-left',
						'caret-square-left',
						'chevron-circle-left',
						'chevron-left',
						'long-arrow-alt-left',
					],
				],
				'conditions'       => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'both',
						],
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'arrows',
						],
					],
				],
			]
		);

		$this->add_control(
			'navigation_next_icon',
			[
				'label'            => esc_html__( 'Next Arrow Icon', 'zenix-essential' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon'  => 'eicon-chevron-right',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended'      => [
					'fa-regular' => [
						'arrow-alt-circle-right',
						'caret-square-right',
					],
					'fa-solid'   => [
						'angle-double-right',
						'angle-right',
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'caret-right',
						'caret-square-right',
						'chevron-circle-right',
						'chevron-right',
						'long-arrow-alt-right',
					],
				],
				'conditions'       => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'both',
						],
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'arrows',
						],
					],
				],
			]
		);

		$this->end_controls_section();
	}

    // Slider Navigation
	private function slider_navigation_style_controls() {
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => esc_html__( 'Navigation', 'zenix-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => esc_html__( 'Size', 'zenix-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev, {{WRAPPER}} .wdb-arrow.wdb-arrow-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'arrows_border',
				'selector' => '{{WRAPPER}} .wdb-arrow.wdb-arrow-prev, {{WRAPPER}} .wdb-arrow.wdb-arrow-next',
			]
		);

		$this->add_control(
			'arrows_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev, {{WRAPPER}} .wdb-arrow.wdb-arrow-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev, {{WRAPPER}} .wdb-arrow.wdb-arrow-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_type',
			[
				'label' => esc_html__( 'Arrows Position Type', 'zenix-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'static',
				'options' => [
					'static' => esc_html__( 'Default', 'zenix-essential' ),
					'absolute' => esc_html__( 'Absolute', 'zenix-essential' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'prev_pos_toggle',
			[
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label' => esc_html__( 'Arrow Prev', 'zenix-essential' ),
				'label_off' => esc_html__( 'Default', 'zenix-essential' ),
				'label_on' => esc_html__( 'Custom', 'zenix-essential' ),
				'return_value' => 'yes',
				'condition' => [
					'arrows_type' => 'absolute',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'prev_pos_left',
			[
				'label' => esc_html__( 'Left', 'zenix-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'prev_pos_btm',
			[
				'label' => esc_html__( 'Bottom', 'zenix-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'next_pos_toggle',
			[
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label' => esc_html__( 'Arrow Next', 'zenix-essential' ),
				'label_off' => esc_html__( 'Default', 'zenix-essential' ),
				'label_on' => esc_html__( 'Custom', 'zenix-essential' ),
				'return_value' => 'yes',
				'condition' => [
					'arrows_type' => 'absolute',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'next_pos_right',
			[
				'label' => esc_html__( 'Right', 'zenix-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'next_pos_btm',
			[
				'label' => esc_html__( 'Bottom', 'zenix-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-next' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->start_controls_tabs(
			'arrows_style_tabs'
		);

		$this->start_controls_tab(
			'arrows_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'zenix-essential' ),
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => esc_html__( 'Color', 'zenix-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev, {{WRAPPER}} .wdb-arrow.wdb-arrow-next'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev svg, {{WRAPPER}} .wdb-arrow.wdb-arrow-next svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .swiper-button-disabled::after'         => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrows_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wdb-arrow.wdb-arrow-prev, {{WRAPPER}} .wdb-arrow.wdb-arrow-next',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrows_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'zenix-essential' ),
			]
		);

		$this->add_control(
			'arrows_h_color',
			[
				'label'     => esc_html__( 'Color', 'zenix-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev:hover, {{WRAPPER}} .wdb-arrow.wdb-arrow-next:hover'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev:hover svg, {{WRAPPER}} .wdb-arrow.wdb-arrow-next:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrows_h_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wdb-arrow.wdb-arrow-prev:hover, {{WRAPPER}} .wdb-arrow.wdb-arrow-next:hover',
			]
		);

		$this->add_control(
			'arrows_hb_color',
			[
				'label'     => esc_html__( 'Border Color', 'zenix-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wdb-arrow.wdb-arrow-prev:hover, {{WRAPPER}} .wdb-arrow.wdb-arrow-next:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Slider Pagination
	private function slider_pagination_style_controls() {
		$this->start_controls_section(
			'sec_style_pagination',
			[
				'label'     => esc_html__( 'Pagination', 'zenix-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'dots_size',
			[
				'label'     => esc_html__( 'Dots Size', 'zenix-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 3,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_inactive_color',
			[
				'label'     => esc_html__( 'Dots Color', 'zenix-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)'  => 'background: {{VALUE}}; opacity: 1;',
					'{{WRAPPER}} .swiper-pagination-current, {{WRAPPER}} .swiper-pagination-total' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_o_width',
			[
				'label'     => esc_html__( 'Outline width', 'zenix-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'outline-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_o_offset',
			[
				'label'     => esc_html__( 'Outline Offset', 'zenix-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'outline-offset: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => esc_html__( 'Active Color', 'zenix-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet'  => 'background: {{VALUE}}; outline-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'dots_bottom',
			[
				'label'      => esc_html__( 'Spacing Bottom', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => - 200,
						'max' => 200,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -40,
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_responsive_control(
			'dots_align',
			[
				'label' => esc_html__( 'Alignment', 'zenix-essential' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'zenix-essential' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'zenix-essential' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'zenix-essential' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullets' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['video_list'] ) ) {
			return;
		}

		//slider settings
		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$slider_settings = [
			'loop'           => 'true' === $settings['loop'],
			'speed'          => $settings['speed'],
			'allowTouchMove' => $settings['allow_touch_move'],
			'slidesPerView'  => $settings['slides_to_show'],
			'spaceBetween'   => $settings['space_between'],
			'centeredSlides' => $settings['center_slide'],
		];

		if ( 'yes' === $settings['autoplay'] ) {
			$slider_settings['autoplay'] = [
				'delay'                => $settings['autoplay_delay'],
				'disableOnInteraction' => $settings['autoplay_interaction'],
			];
		}

		if ( $show_arrows ) {
			$slider_settings['navigation'] = [
				'nextEl' => '.elementor-element-' . $this->get_id() . ' .wdb-arrow-next',
				'prevEl' => '.elementor-element-' . $this->get_id() . ' .wdb-arrow-prev',
			];
		}

		if ( $show_dots ) {
			$slider_settings['pagination'] = [
				'el'        => '.elementor-element-' . $this->get_id() . ' .swiper-pagination',
				'clickable' => true,
			];
		}

		//slider breakpoints
		$active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

		foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
			$slides_to_show = ! empty( $settings[ 'slides_to_show_' . $breakpoint_name ] ) ? $settings[ 'slides_to_show_' . $breakpoint_name ] : $settings['slides_to_show'];
			$space_between = ! empty( $settings[ 'space_between_' . $breakpoint_name ] ) ? $settings[ 'space_between_' . $breakpoint_name ] : $settings['space_between'];

			$slider_settings['breakpoints'][ $breakpoint->get_value() ]['slidesPerView'] = $slides_to_show;
			$slider_settings['breakpoints'][ $breakpoint->get_value() ]['spaceBetween'] = $space_between;
		}

		$this->add_render_attribute(
			'wrapper',
			[
				'class'         => [ 'zenix_vs_wrapper' ],
				'data-settings' => json_encode( $slider_settings ), //phpcs:ignore
			]
		);

		$swiper_class = Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';

		$this->add_render_attribute(
			'carousel-wrapper',
			[
				'class' => 'zenix_video_slider ' . $swiper_class,
				'style' => 'position: static',
				'dir'   => 'ltr',
			]
		);
		?>
        <style>
            .zenix_vs_wrapper svg {
                width: 1em;
                height: 1em;
            }

            .zenix_vs_wrapper video {
                min-height: 300px;
                transition: all 0.5s;
            }

            .zenix_vs_wrapper .swiper-slide-active {
                background-color: #eee;
            }

            .zenix_vs_wrapper .swiper-pagination-bullet-active {
                outline-offset: 5px;
                outline-width: 1px;
                outline-style: solid;
            }
        </style>

        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

            <div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
                <div class="swiper-wrapper">
					<?php foreach ( $settings['video_list'] as $item ) { ?>
                        <div class="swiper-slide">
                            <div class="slide">
                                <video class="vs__video" >
                                    <source src="<?php echo $item['s_video_link']; ?>" type="video/mp4">
                                </video>
                            </div>
                        </div>
					<?php } ?>
                </div>
            </div>

            <!-- navigation and pagination -->
			<?php if ( 1 < count( $settings['video_list'] ) ) : ?>
				<?php if ( $show_arrows ) : ?>
                    <div class="ts-navigation">
                        <div class="wdb-arrow wdb-arrow-prev" role="button" tabindex="0">
							<?php $this->render_swiper_button( 'previous' ); ?>
                        </div>
                        <div class="wdb-arrow wdb-arrow-next" role="button" tabindex="0">
							<?php $this->render_swiper_button( 'next' ); ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $show_dots ) : ?>
                    <div class="ts-pagination">
                        <div class="swiper-pagination"></div>
                    </div>
				<?php endif; ?>
			<?php endif; ?>
        </div>
		<?php
	}

	/**
	 * Render swiper button.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function render_swiper_button( $type ) {
		$direction     = 'next' === $type ? 'right' : 'left';
		$icon_settings = $this->get_settings_for_display( 'navigation_' . $type . '_icon' );

		if ( empty( $icon_settings['value'] ) ) {
			$icon_settings = [
				'library' => 'eicons',
				'value'   => 'eicon-chevron-' . $direction,
			];
		}

		Icons_Manager::render_icon( $icon_settings, [ 'aria-hidden' => 'true' ] );
	}
}
