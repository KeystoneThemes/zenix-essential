<?php

namespace ZenixEssentialApp\Widgets;

use Elementor\Control_Media;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Offcanvas_Menu extends Widget_Base {

	public function get_name() {
		return 'wdb--offcanvas-menu';
	}

	public function get_title() {
		return wdb_elementor_widget_concat_prefix( 'Animated Offcanvas' );
	}

	public function get_icon() {
		return 'wdb eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_keywords() {
		return [ 'offcanvas', 'menu' ];
	}

	public function get_style_depends() {
		return [ 'zenix-header-offcanvas' ];
	}

	public function get_script_depends() {
		return [ 'wdb-offcanvas-menu' ];
	}

	public function logo_image_url( $size ) {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['custom_image']['url'] ) ) {
			$logo = wp_get_attachment_image_src( $settings['custom_image']['id'], $size, true );

			return $logo[0];
		} else {
			$light_logo = ZENIX_IMG . '/lawyer-black-logo.png';
			$logo       = zenix_option( 'offcanvas_logo', $light_logo );

			return $logo;
		}

	}

	public function get_all_images_urls() {
		$returns_data = [];
		$media_dir    = ZENIX_ESSENTIAL_DIR_PATH . 'assets/images/bars/';
		$url_path     = ZENIX_ESSENTIAL_ASSETS_URL . 'images/bars/';
		try {

			if ( defined( 'GLOB_BRACE' ) ) {
				$imagesFiles = glob( $media_dir . "*.{jpg,jpeg,png,gif,svg,bmp,webp}", GLOB_BRACE );
				foreach ( $imagesFiles as $key => $item ) {
					$returns_data[ basename( $item ) ] = [
						'title' => basename( $item ),
						'url'   => $url_path . basename( $item ),
					];
				}
			} else {
				if ( function_exists( 'list_files' ) ) {

					$files = list_files( $media_dir, 2 );
					foreach ( $files as $file ) {

						if ( is_file( $file ) ) {
							$filename                  = basename( $file );
							$returns_data[ $filename ] = [
								'title' => $filename,
								'url'   => $url_path . $filename,
							];
						}

					}
				}

			}

		} catch ( \Exception $e ) {
		}

		return $returns_data;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Settings', 'zenix-essential' ),
			]
		);

		$this->add_control(
			'menu_button_text',
			[
				'label'       => esc_html__( 'Button Text', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Menu', 'zenix-essential' ),

			]
		);


		$this->add_control(
			'custom_bar',
			[
				'label'   => __( 'Custom Bar', 'zenix-essential' ),
				'type'    => Controls_Manager::SWITCHER,
				'yes'     => __( 'Yes', 'zenix-essential' ),
				'no'      => __( 'No', 'zenix-essential' ),
				'default' => '',
			]
		);

		//Image selector
		$this->add_control(
			'bar',
			[
				'label'     => esc_html__( 'Bar', 'zenix-essential' ),
				'type'      => \ZenixEssentialApp\CustomControl\ImageSelector_Control::ImageSelector,
				'options'   => $this->get_all_images_urls(),
				'bgcolor'   => '#D2EAF1',
				'col'       => 3,
				'default'   => 'hamburger-icon-0.png',
				'condition' => [
					'custom_bar' => '',
				],
			]
		);

		$this->add_control(
			'custom_bar_image',
			[
				'label'     => esc_html__( 'Choose Bar Image', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'custom_bar' => 'yes',
				],
			]
		);

		$this->add_control(
			'sticky_bar',
			[
				'label'   => __( 'Sticky Bar', 'zenix-essential' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'content_source',
			[
				'label'   => esc_html__( 'Content Source', 'zenix-essential' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'preset',
				'options' => [

					'preset'              => esc_html__( 'Preset', 'zenix-essential' ),
					'elementor_shortcode' => esc_html__( 'Custom Shortcode', 'zenix-essential' ),

				]
			]
		);

		$this->add_control(
			'preset_style',
			[
				'label'     => esc_html__( 'Preset Style', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'two',
				'options'   => [
					'two' => esc_html__( 'One', 'zenix-essential' ),
//						'three'     => esc_html__( 'Two' , 'zenix-essential' ),
//						'four'      => esc_html__( 'Three' , 'zenix-essential' ),
//						'five'      => esc_html__( 'Four' , 'zenix-essential' ),
//						'six'       => esc_html__( 'Five' , 'zenix-essential' ),

				],
				'condition' => [ 'content_source' => [ 'preset' ] ]
			]
		);

		$this->add_control(
			'shortcode',
			[
				'label'       => esc_html__( 'Elementor Template ShortCode', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( '[WDB_ELEMENTOR_TPL id="1951"]', 'zenix-essential' ),
				'condition'   => [ 'content_source' => [ 'elementor_shortcode' ] ]
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_custom_content',
			[
				'label'     => esc_html__( 'Custom Content', 'zenix-essential' ),
				'condition' => [ 'content_source' => [ 'preset' ] ]
			]
		);

		$this->add_control(
			'show_logo',
			[
				'label'        => esc_html__( 'Show Logo / Custom Image', 'zenix-essential' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'zenix-essential' ),
				'label_off'    => esc_html__( 'Hide', 'zenix-essential' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'custom_image',
			[
				'label'     => __( 'Add Logo / Image', 'header-footer-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [ 'show_logo' => [ 'yes' ] ]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'site_logo_size',
				'label'     => __( 'Image Size', 'header-footer-elementor' ),
				'default'   => 'medium',
				'condition' => [ 'show_logo' => [ 'yes' ] ]
			]
		);

		$this->add_control(
			'menu_selected',
			[
				'label'   => esc_html__( 'Menu', 'zenix-essential' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => zenix_menu_list()
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title',
			[
				'label'       => esc_html__( 'Title', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'List Title', 'zenix-essential' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content',
			[
				'label'       => esc_html__( 'Content', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Email', 'zenix-essential' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_type',
			[
				'label'   => esc_html__( 'Content Type', 'zenix-essential' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''        => esc_html__( 'Default', 'zenix-essential' ),
					'email'   => esc_html__( 'Email', 'zenix-essential' ),
					'phone'   => esc_html__( 'Phone', 'zenix-essential' ),
					'address' => esc_html__( 'Address', 'zenix-essential' ),
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link Value', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '#',
				'label_block' => true,
				'condition'   => [ 'list_type' => [ 'email', 'phone' ] ]
			]
		);


		$this->add_control(
			'contact_info',
			[
				'label'       => esc_html__( 'Contact Info', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ list_title }}}',
			]
		);

		$language = new \Elementor\Repeater();

		$language->add_control(
			'list_title',
			[
				'label'       => esc_html__( 'Title', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'List Title', 'zenix-essential' ),
				'label_block' => true,
			]
		);

		$language->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link Value', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '#',
				'label_block' => true,
			]
		);

		$this->add_control(
			'language_info',
			[
				'label'       => esc_html__( 'Language Info', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $language->get_controls(),
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->add_control(
			'copyright_texts',
			[
				'label'       => esc_html__( 'Copyright', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => '© All Rights Reserved <br> by <a href="https://keystonethemes.com/" target="_blank">Keystone Themes</a>',
				'placeholder' => esc_html__( 'Type your description here', 'zenix-essential' ),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_close_area',
			[
				'label' => esc_html__( 'Close Button', 'zenix-essential' ),
			]
		);

		$this->add_control(
			'default_close_contentss',
			[
				'label'   => __( 'Default?', 'zenix-essential' ),
				'type'    => Controls_Manager::SWITCHER,
				'yes'     => __( 'Yes', 'zenix-essential' ),
				'no'      => __( 'No', 'zenix-essential' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'close_text',
			[
				'label'       => esc_html__( 'Close Text', 'zenix-essential' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'close',
				'placeholder' => esc_html__( 'close text', 'zenix-essential' ),
				'condition'   => [ 'default_close_contentss!' => [ 'yes' ] ]
			]
		);

		$this->add_control(
			'close_icon',
			[
				'label'     => esc_html__( 'Icon', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'condition' => [ 'default_close_contentss!' => [ 'yes' ] ],
				'default'   => []
			]
		);

		$this->add_responsive_control(
			'close_position_type',
			[
				'label'     => esc_html__( 'Position', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''                                                         => esc_html__( 'Default', 'zenix-essential' ),
					'position: absolute;right: 50px;top: 50px; z-index: 1;'    => esc_html__( 'Right Top', 'zenix-essential' ),
					'position: absolute;left: 50px;top: 50px; z-index: 1;'     => esc_html__( 'Left Top', 'zenix-essential' ),
					'position: absolute;left: 50px;bottom: 50px; z-index: 1;'  => esc_html__( 'Left Bottom', 'zenix-essential' ),
					'position: absolute;right: 50px;bottom: 50px; z-index: 1;' => esc_html__( 'Right Bottom', 'zenix-essential' ),
				],
				'selectors' => [
					'.wdb-offcanvas-gl-style .offcanvas-close__button-wrapper' => '{{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_position_left',
			[
				'label'      => esc_html__( 'Left', 'zenix-essential' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => - 500,
						'max'  => 900,
						'step' => 1,
					],
				],
				'selectors'  => [
					'body .wdb-offcanvas-gl-style .offcanvas-close__button-wrapper' => 'left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'close_button_position_top',
			[
				'label'      => esc_html__( 'Top', 'zenix-essential' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => - 900,
						'max'  => 900,
						'step' => 1,
					],
				],
				'selectors'  => [
					'body .wdb-offcanvas-gl-style .offcanvas-close__button-wrapper' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_position_right',
			[
				'label'      => esc_html__( 'Right', 'zenix-essential' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => - 900,
						'max'  => 900,
						'step' => 1,
					],
				],
				'selectors'  => [
					'body .wdb-offcanvas-gl-style .offcanvas-close__button-wrapper' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_position_bottom',
			[
				'label'      => esc_html__( 'Bottom', 'zenix-essential' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => - 500,
						'max'  => 900,
						'step' => 1,
					],
				],
				'selectors'  => [
					'body .wdb-offcanvas-gl-style .offcanvas-close__button-wrapper' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_offcanvas_area',
			[
				'label' => esc_html__( 'Main Container', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'offcanvas_m_padding',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'body .wdb-offcanvas-gl-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_offcanvas_open_btn',
			[
				'label' => esc_html__( 'Open Text Button', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'open_btn_color',
			[
				'label'     => esc_html__( 'Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.wdb--info-animated-offcanvas'   => 'color: {{VALUE}}',
					'.offcanvas__close-2 button span' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'open_icon_typo',
				'selector' => '.wdb--info-animated-offcanvas',
			]
		);

		$this->add_control(
			'bcustom_text_sshadow',
			[
				'label'     => esc_html__( 'Text Shadow', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::TEXT_SHADOW,
				'selectors' => [
					'.wdb--info-animated-offcanvas' => 'text-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{COLOR}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_offcanvas_close_i_btn',
			[
				'label' => esc_html__( 'Close Icon Button', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'open_close_dc_color',
			[
				'label'     => esc_html__( 'Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .offcanvas__close-2 button span' => 'background-color: {{VALUE}}',
					'body .text-close-button span'         => 'background-color: {{VALUE}}',
					'body .text-close-button .bars span'   => 'background: {{VALUE}}',
				],
				'condition' => [ 'default_close_contentss' => [ 'yes' ] ]
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'menubackground',
				'types'    => [ 'classic', 'gradient' ],
				'label'    => esc_html__( 'Icon Background', 'zenix-essential' ),
				'selector' => '.offcanvas-close__button-wrapper .off-close-icon svg, .offcanvas-close__button-wrapper .off-close-icon i ,body .offcanvas__close-2 button,body .text-close-button',
			]
		);

        $this->add_responsive_control(
	        'close_icon_width',
	        [
		        'label'      => esc_html__( 'Icon Size', 'zenix-essential' ),
		        'type'       => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', 'rem', '%' ],
		        'range'      => [
			        'px' => [
				        'min'  => 1,
				        'max'  => 100,
			        ],
		        ],
		        'selectors'  => [
			        '.offcanvas__close-2 button span'   => 'width: {{SIZE}}{{UNIT}};',
		        ]
	        ]
        );

		$this->add_responsive_control(
			'close_button_min_width',
			[
				'label'      => esc_html__( 'Icon Wrapper Width', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', '%' ],
				'range'      => [
					'px' => [
						'min'  => 15,
						'max'  => 300,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors'  => [
					'.offcanvas__close-2 button'   => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'close_button_min_height',
			[
				'label'      => esc_html__( 'Icon Wrapper Height', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', '%' ],
				'range'      => [
					'px' => [
						'min'  => 15,
						'max'  => 300,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors'  => [
					'.offcanvas__close-2 button' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'close_bt_mborder',
				'selector' => '.offcanvas-close__button-wrapper .off-close-icon svg, .offcanvas-close__button-wrapper .off-close-icon i,body .text-close-button',
			]
		);


		$this->add_control(
			'close_btn_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'.offcanvas-close__button-wrapper .off-close-icon i'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.offcanvas-close__button-wrapper .off-close-icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.offcanvas-close__button-wrapper .text-close-button'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors'  => [
					'.offcanvas-close__button-wrapper .off-close-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.offcanvas-close__button-wrapper .off-close-icon i'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_offcanvas_close_btn',
			[
				'label' => esc_html__( 'Close Text Button', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'close_btn_color',
			[
				'label'     => esc_html__( 'Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.offcanvas-close__button-wrapper .text-close-button' => 'color: {{VALUE}}',
					'.offcanvas-close__button-wrapper i'                  => 'color: {{VALUE}}',
					'.offcanvas-close__button-wrapper svg'                => 'fill: {{VALUE}}'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'close_icon_typo',
				'selector' => '.offcanvas-close__button-wrapper i, .offcanvas-close__button-wrapper svg,.offcanvas-close__button-wrapper .text-close-button',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_offcanvas_menu',
			[
				'label' => esc_html__( 'Menu', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'nav_off_menucolor',
			[
				'label'     => esc_html__( 'Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.offcanvas__area-2 .mean-container .mean-nav ul li a'   => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'nav_off_h_menucolor',
			[
				'label'     => esc_html__( 'Hover Color', 'zenix-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.offcanvas__area-2 .mean-container .mean-nav ul li a:hover'  => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'nav_off_menu_close',
				'selector' => 'body .offcanvas__area-2 .mean-container .mean-nav ul li a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'mean_menu_border',
				'selector' => '.offcanvas__area-2 .mean-container .mean-nav ul li a',
			]
		);

		$this->add_responsive_control(
			'menu_hht_auto',
			[
				'label'     => esc_html__( 'Height Auto', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''     => esc_html__( 'No', 'zenix-essential' ),
					'auto' => esc_html__( 'Yes', 'zenix-essential' ),

				],
				'selectors' => [
					'.offcanvas__area-2 .offcanvas__menu-2' => 'height: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'off_menu_padding',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'.offcanvas__area-2 .mean-container .mean-nav ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'off_menu_dp_padding',
			[
				'label'      => esc_html__( 'Level Two Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'.offcanvas__area-2 .mean-container .mean-nav ul li li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'menu_icon_heading',
			[
				'label' => esc_html__( 'Menu Icon', 'zenix-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'expand_width',
			[
				'label' => esc_html__( 'Width', 'zenix-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'body .offcanvas__area-2 .mean-container .mean-nav ul li a.mean-expand' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'expand_height',
			[
				'label' => esc_html__( 'Height', 'zenix-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'body .offcanvas__area-2 .mean-container .mean-nav ul li a.mean-expand' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'expand_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => 'body .offcanvas__area-2 .mean-container .mean-nav ul li a.mean-expand',
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_offcanvas_contact',
			[
				'label' => esc_html__( 'Contact', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'contact_display',
			[
				'label'     => esc_html__( 'Display', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''     => esc_html__( 'Default', 'zenix-essential' ),
					'none' => esc_html__( 'None', 'zenix-essential' ),

				],
				'selectors' => [
					'body .wdb-offcanvas-gl-style .offcanvas__contact' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'nav_off_contact_color',
			[
				'label'     => esc_html__( 'Heading Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .wdb-offcanvas-gl-style .offcanvas__contact li p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'nav_off_contact_h_typho',
				'selector' => 'body .wdb-offcanvas-gl-style .offcanvas-6__meta-title,body .wdb-offcanvas-gl-style .offcanvas__contact li p',
			]
		);


		$this->add_control(
			'nav_off_contact__color',
			[
				'label'     => esc_html__( 'Body Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body .wdb-offcanvas-gl-style .offcanvas__contact li a'    => 'color: {{VALUE}};',
					'body .wdb-offcanvas-gl-style .offcanvas__contact li span' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'nav_off_contact__typho',
				'selector' => 'body .wdb-offcanvas-gl-style .offcanvas__contact li a,body .wdb-offcanvas-gl-style .offcanvas__contact li span,body .wdb-offcanvas-gl-style .offcanvas-6__meta li,.wdb-offcanvas-gl-style .offcanvas-4__meta li,body .wdb-offcanvas-gl-style .offcanvas-3__meta li',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_offcanvas_copy_contact',
			[
				'label' => esc_html__( 'Copyright , Search , Lang', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'footer_c_display',
			[
				'label'     => esc_html__( 'Copyright Display', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''     => esc_html__( 'Default', 'zenix-essential' ),
					'none' => esc_html__( 'None', 'zenix-essential' ),

				],
				'selectors' => [
					'body .wdb-offcanvas-gl-style .offcanvas__footer-2 p' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'nav_off_copyright_color',
			[
				'label'     => esc_html__( 'Copyright Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.wdb-offcanvas-gl-style .offcanvas__footer-2 p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'nav_off_copyright_link_color',
			[
				'label'     => esc_html__( 'Copyright Link Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.wdb-offcanvas-gl-style .offcanvas__footer-2 p a' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'nav_offcopyright_h_typho',
				'selector' => '.wdb-offcanvas-gl-style .offcanvas__footer-2 p',
			]
		);

		$this->add_responsive_control(
			'footer_s_display',
			[
				'label'     => esc_html__( 'Search Display', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''     => esc_html__( 'Default', 'zenix-essential' ),
					'none' => esc_html__( 'None', 'zenix-essential' ),

				],
				'selectors' => [
					'body .wdb-offcanvas-gl-style form' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'nav_off_search_color',
			[
				'label'     => esc_html__( 'Search Input Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.wdb-offcanvas-gl-style .offcanvas__footer-2 form button'                                                   => 'color: {{VALUE}};',
					'.wdb-offcanvas-gl-style .offcanvas__footer-2 .default-search__again-form form input'                        => 'color: {{VALUE}};border-color:{{VALUE}}',
					'.wdb-offcanvas-gl-style .offcanvas__footer-2 .default-search__again-form form input::placeholder'           => 'color: {{VALUE}};',
					'.wdb-offcanvas-gl-style .offcanvas__footer-2 .default-search__again-form form input::-ms-input-placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'footer_l_display',
			[
				'label'     => esc_html__( 'Lang Display', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''     => esc_html__( 'Default', 'zenix-essential' ),
					'none' => esc_html__( 'None', 'zenix-essential' ),

				],
				'selectors' => [
					'body .wdb-offcanvas-gl-style .offcanvas__lang .language' => 'display: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'nav_off_lang_color',
			[
				'label'     => esc_html__( 'Language Color', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.wdb-offcanvas-gl-style .offcanvas__lang .language li a'        => 'color: {{VALUE}};',
					'.wdb-offcanvas-gl-style .offcanvas__lang .language li a::after' => 'background-color: {{VALUE}};',


				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'nav_offcopyright_lang_typho',
				'selector' => '.wdb-offcanvas-gl-style .offcanvas__lang .language li a',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_right_section',
			[
				'label' => __( 'Offcanvas Right', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'offcan_right_margin',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'body .offcanvas__right-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'rigtut_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => 'body .offcanvas__right-2',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_left_section',
			[
				'label' => __( 'Offcanvas Left', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'offcan_left_margin',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'body .offcanvas__left-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'lefttut_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => 'body .offcanvas__left-2',
			]
		);

		$this->add_responsive_control(
			'leftio_display',
			[
				'label'     => esc_html__( 'Display', 'zenix-essential' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''     => esc_html__( 'Default', 'zenix-essential' ),
					'none' => esc_html__( 'None', 'zenix-essential' ),

				],
				'selectors' => [
					'body .wdb-offcanvas-gl-style .offcanvas__left-2' => 'display: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$bar = '';

		if ( $settings['bar'] != '' ) {
			$bar = ZENIX_ESSENTIAL_ASSETS_URL . 'images/bars/' . $settings['bar'];
		}

		if ( $settings['custom_bar'] == 'yes' && isset( $settings['custom_bar_image']['url'] ) ) {
			$bar = $settings['custom_bar_image']['url'];
		}

		$contact_info  = $settings['contact_info'];
		$menu_selected = $settings['menu_selected'];
		$size          = $settings['site_logo_size_size'];
		$preset_style  = $settings['preset_style'];

		?>
		<?php if ( $settings['sticky_bar']['url'] != '' ) { ?>
            <style>
                .wdb--info-animated-offcanvas .wdb-sticky-bar,
                .wdb-is-sticky .wdb--info-animated-offcanvas img {
                    display: none;
                }

                .wdb-is-sticky .wdb--info-animated-offcanvas .wdb-sticky-bar {
                    display: block !important;
                }
            </style>
		<?php } ?>
		<?php if ( $settings['content_source'] === 'preset' ) { ?>
			<?php include_once( ZENIX_ESSENTIAL_DIR_PATH . "widgets/offcanvas-preset/content-$preset_style" . '.php' ); ?>
		<?php } else { ?>
			<?php include_once( ZENIX_ESSENTIAL_DIR_PATH . "widgets/offcanvas-preset/content-elementor.php" ); ?>
		<?php } ?>
		<?php
	}
}