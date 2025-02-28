<?php

namespace ZenixEssentialApp\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Zenix_Tabs extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve tabs widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'zenix--tabs';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tabs widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Zenix Tabs', 'zenix-essential' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve tabs widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'wdb eicon-tabs';
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

	// Style Dependency
	public function get_style_depends() {
		wp_register_style( 'zenix-tabs', ZENIX_ESSENTIAL_ASSETS_URL . 'css/zenix-tabs.css' );
		return [ 'zenix-tabs' ];
	}

    // Script Dependency
	public function get_script_depends() {
		wp_register_script( 'zenix-tabs', ZENIX_ESSENTIAL_ASSETS_URL . '/js/widgets/zenix-tabs.js', [ 'jquery' ], false, true );

		return [ 'zenix-tabs' ];
	}

	/**
	 * Register tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$start = is_rtl() ? 'right' : 'left';
		$end   = is_rtl() ? 'left' : 'right';

		$this->start_controls_section(
			'section_tabs',
			[
				'label' => esc_html__( 'Tabs', 'zenix-essential' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_icon',
			[
				'label'       => esc_html__( 'Icon', 'zenix-essential' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fas fa-home',
					'library' => 'fa-solid',
				],
				'skin'        => 'inline',
				'label_block' => false,
			]
		);

		$repeater->add_control(
			'tab_title',
			[
				'label'       => esc_html__( 'Title', 'zenix-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Title', 'zenix-essential' ),
				'placeholder' => esc_html__( 'Tab Title', 'zenix-essential' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'tab_desc',
			[
				'label' => esc_html__( 'Description', 'zenix-essential' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => esc_html__( 'Add the best talent on the market, an agile skilled management & seamlessinvolvement', 'zenix-essential' ),
			]
		);

		$repeater->add_control(
			'tabs_content_type',
			[
				'label'   => esc_html__('Content Type', 'zenix-essential'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'content'  => esc_html__('Content', 'zenix-essential'),
					'template' => esc_html__('Saved Templates', 'zenix-essential'),
				],
				'default' => 'content',
			]
		);

		$repeater->add_control(
			'elementor_templates',
			[
				'label'       => esc_html__( 'Save Template', 'zenix-essential' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => false,
				'multiple'    => false,
				'options'     => wdb_addons_get_saved_template_list(),
				'condition'   => [
					'tabs_content_type' => 'template',
				],
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label'       => esc_html__( 'Content', 'zenix-essential' ),
				'default'     => esc_html__( 'Tab Content', 'zenix-essential' ),
				'placeholder' => esc_html__( 'Tab Content', 'zenix-essential' ),
				'type'        => Controls_Manager::WYSIWYG,
				'condition'   => [
					'tabs_content_type' => 'content',
				],
			]
		);

		$this->add_control(
			'tabs',
			[
				'label'       => esc_html__( 'Tabs Items', 'zenix-essential' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'tab_title'   => esc_html__( 'Tab Title 1', 'zenix-essential' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zenix-essential' ),
					],
					[
						'tab_title'   => esc_html__( 'Tab Title 2', 'zenix-essential' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zenix-essential' ),
					],
					[
						'tab_title'   => esc_html__( 'Tab Title 3', 'zenix-essential' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'zenix-essential' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => esc_html__( 'View', 'zenix-essential' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control( 'tabs_direction',
			[
				'label'        => esc_html__( 'Direction', 'zenix-essential' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'column'         => [
						'title' => esc_html__( 'Above', 'zenix-essential' ),
						'icon'  => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__( 'Below', 'zenix-essential' ),
						'icon'  => 'eicon-v-align-bottom',
					],
					'row-reverse'    => [
						'title' => esc_html__( 'After', 'zenix-essential' ),
						'icon'  => 'eicon-h-align-' . $end,
					],
					'row'            => [
						'title' => esc_html__( 'Before', 'zenix-essential' ),
						'icon'  => 'eicon-h-align-' . $start,
					],
				],
				'separator'    => 'before',
				'selectors'    => [
					'{{WRAPPER}} .wdb--tabs' => 'flex-direction: {{VALUE}}',
				],
				'prefix_class' => 'wdb-tabs-direction-',
			]
		);

		$this->add_control(
			'tabs_align',
			[
				'label'        => esc_html__( 'Alignment', 'zenix-essential' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					''        => esc_html__( 'Start', 'zenix-essential' ),
					'center'  => esc_html__( 'Center', 'zenix-essential' ),
					'end'     => esc_html__( 'End', 'zenix-essential' ),
					'stretch' => esc_html__( 'Stretch', 'zenix-essential' ),
				],
				'selectors'    => [
					'{{WRAPPER}} .tabs-wrapper' => 'justify-content: {{VALUE}}',
				],
				'prefix_class' => 'tabs-alignment-',
			]
		);

		$this->end_controls_section();

		//settings
		$this->start_controls_section( 'section_tabs_setting', [
			'label' => esc_html__( 'Settings', 'zenix-essential' ),
		] );

		$this->add_responsive_control(
			'tab_tittle_align',
			[
				'label'     => esc_html__( 'Title Alignment', 'zenix-essential' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'zenix-essential' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'zenix-essential' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'zenix-essential' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'text-align: {{VALUE}}; justify-content:{{VALUE}};',
				],
			]
		);

		$this->add_responsive_control( 'tabs_icon_position',
			[
				'label'     => esc_html__( 'Icon Position', 'zenix-essential' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'column'         => [
						'title' => esc_html__( 'Above', 'zenix-essential' ),
						'icon'  => 'eicon-v-align-top',
					],
					'column-reverse' => [
						'title' => esc_html__( 'Below', 'zenix-essential' ),
						'icon'  => 'eicon-v-align-bottom',
					],
					'row-reverse'    => [
						'title' => esc_html__( 'After', 'zenix-essential' ),
						'icon'  => 'eicon-h-align-' . $end,
					],
					'row'            => [
						'title' => esc_html__( 'Before', 'zenix-essential' ),
						'icon'  => 'eicon-h-align-' . $start,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'flex-direction: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'tab_icon_gap',
			[
				'label'      => esc_html__( 'Icon Gap', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'separator'  => 'after',
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tab-title' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$dropdown_options     = [
			'none' => esc_html__( 'None', 'zenix-essential' ),
		];
		$excluded_breakpoints = [
			'laptop',
			'tablet_extra',
			'widescreen',
		];

		foreach ( Plugin::$instance->breakpoints->get_active_breakpoints() as $breakpoint_key => $breakpoint_instance ) {
			// Exclude the larger breakpoints from the dropdown selector.
			if ( in_array( $breakpoint_key, $excluded_breakpoints, true ) ) {
				continue;
			}

			$dropdown_options[ $breakpoint_key ] = sprintf(
			/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$s %3$dpx)', 'zenix-essential' ),
				$breakpoint_instance->get_label(),
				'>',
				$breakpoint_instance->get_value()
			);
		}

		$this->add_control(
			'breakpoint_selector',
			[
				'label'        => esc_html__( 'Breakpoint', 'zenix-essential' ),
				'type'         => Controls_Manager::SELECT,
				'description'  => esc_html__( 'Note: Choose at which breakpoint tabs will automatically switch to a vertical (“accordion”) layout.', 'zenix-essential' ),
				'options'      => $dropdown_options,
				'default'      => 'mobile',
				'prefix_class' => 'wdb-tabs-',
			]
		);

		$this->end_controls_section();

		//style tabs title
		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => esc_html__( 'Tabs', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navigation_width',
			[
				'label'     => esc_html__( 'Navigation Width', 'zenix-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => '%',
				],
				'range'     => [
					'%' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-wrapper' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'tabs_direction' => [ 'row-reverse', 'row' ],
				],
			]
		);

		$this->add_responsive_control( 'tabs_title_space_between',
			[
				'label'      => esc_html__( 'Gap between tabs', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .tabs-wrapper' => 'gap: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tab-item:not(:last-child) .tab-mobile-title:not(.active)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control( 'tabs_title_spacing',
			[
				'label'      => esc_html__( 'Distance from content', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .wdb--tabs' => 'gap: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tab-mobile-title.active' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'tab_title_border',
				'selector'  => '{{WRAPPER}} .tab-title',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_title_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Icon Style
		$this->start_controls_section( 'sec_style_icon', [
			'label' => esc_html__( 'Icon', 'zenix-essential' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'zenix-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tab-title i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tab-title svg' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_wrapper_size',
			[
				'label'      => esc_html__( 'Circle Size', 'zenix-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .icon'   => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .icon',
			]
		);

		$this->end_controls_section();

		// Title Style
		$this->start_controls_section(
			'sec_style_title', [
				'label' => esc_html__( 'Title', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'zenix-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Desc Style
		$this->start_controls_section(
			'sec_style_desc', [
				'label' => esc_html__( 'Description', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'zenix-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
				'selector' => '{{WRAPPER}} .desc',
			]
		);;

		$this->end_controls_section();

		//content box
		$this->start_controls_section( 'section_box_style', [
			'label' => esc_html__( 'Content', 'zenix-essential' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_background_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .tab-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'selector' => '{{WRAPPER}} .tab-content',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__( 'Padding', 'zenix-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Hover/Active Style
		$this->start_controls_section(
			'sec_style_active', [
				'label' => esc_html__( 'Hover/Active', 'zenix-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_h_color',
			[
				'label' => esc_html__( 'Icon Color', 'zenix-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title.active .icon, {{WRAPPER}} .tab-title:hover .icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_h_bg',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .tab-title.active .icon, {{WRAPPER}} .tab-title:hover .icon',
			]
		);

		$this->add_control(
			'tab_hb_color',
			[
				'label' => esc_html__( 'Border Color', 'zenix-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-title.active, {{WRAPPER}} .tab-title:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$tabs     = $this->get_settings_for_display( 'tabs' );
		$id_int   = substr( $this->get_id_int(), 0, 3 );

		$this->add_render_attribute( 'wrapper', 'class', 'wdb--tabs zenix--tabs' );
		?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <div class="tabs-wrapper" role="tablist">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count             = $index + 1;
					$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

					$this->add_render_attribute( $tab_title_setting_key, [
						'id'            => 'tab-title-' . $id_int . $tab_count,
						'class'         => [ 'tab-title', 'tab-desktop-title' ],
						'aria-selected' => 1 === $tab_count ? 'true' : 'false',
						'data-tab'      => $tab_count,
						'role'          => 'tab',
						'tabindex'      => 1 === $tab_count ? '0' : '-1',
						'aria-controls' => 'tab-content-' . $id_int . $tab_count,
					] );
					?>
                    <div <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>>
						<div class="icon">
							<?php Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                        <div class="content">
                            <div class="title">
	                            <?php $this->print_unescaped_setting( 'tab_title', 'tabs', $index ); ?>
                            </div>
                            <p class="desc">
	                            <?php $this->print_unescaped_setting( 'tab_desc', 'tabs', $index ); ?>
                            </p>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="tabs-content-wrapper">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					$hidden = 1 === $tab_count ? 'false' : 'hidden';
					$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

					$tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

					$this->add_render_attribute( $tab_content_setting_key, [
						'id'              => 'tab-content-' . $id_int . $tab_count,
						'class'           => 'tab-content',
						'data-tab'        => $tab_count,
						'role'            => 'tabpanel',
						'aria-labelledby' => 'tab-title-' . $id_int . $tab_count,
						'tabindex'        => '0',
					] );

					$this->add_render_attribute( $tab_title_mobile_setting_key, [
						'class'         => [ 'tab-title', 'tab-mobile-title' ],
						'aria-selected' => 1 === $tab_count ? 'true' : 'false',
						'data-tab'      => $tab_count,
						'role'          => 'tab',
						'tabindex'      => 1 === $tab_count ? '0' : '-1',
						'aria-controls' => 'tab-content-' . $id_int . $tab_count,
						'aria-expanded' => 'false',
					] );

					?>
                    <div class="tab-item">
                        <div <?php $this->print_render_attribute_string( $tab_title_mobile_setting_key ); ?>>
                            <div class="icon">
		                        <?php Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                            <div class="content">
                                <div class="title">
			                        <?php $this->print_unescaped_setting( 'tab_title', 'tabs', $index ); ?>
                                </div>
                                <p class="desc">
			                        <?php $this->print_unescaped_setting( 'tab_desc', 'tabs', $index ); ?>
                                </p>
                            </div>
                        </div>
                        <div <?php $this->print_render_attribute_string( $tab_content_setting_key ); ?>>
							<?php
							if ( 'content' === $item['tabs_content_type'] ) {
								$this->print_text_editor( $item['tab_content'] );
							} else {
								if ( ! empty( $item['elementor_templates'] ) ) {
									echo Plugin::$instance->frontend->get_builder_content( $item['elementor_templates'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}
							}
							?>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
		<?php
	}
}
