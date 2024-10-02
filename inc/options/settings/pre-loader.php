<?php
// pre-loader
CSF::createSection( ZENIX_OPTION_KEY, array(
	'title'  => esc_html__( 'Preloader', 'zenix-essential' ),
	'icon'   => 'fa fa-spinner',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Preloader Type', 'zenix-essential' ),
		),
		array(
			'id'      => 'enable_preloader',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Preloader', 'zenix-essential' ),
			'desc'    => esc_html__( 'When the user is logged out, the preload will be visible.', 'zenix-essential' ),
			'default' => true,
		),
		array(
			'id'      => 'enable_preloader_spinner',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Spinner', 'zenix-essential' ),
			'desc'    => esc_html__( 'If you want to enable or disable Spinner you can set ( YES / NO )', 'zenix-essential' ),
			'default' => true,
		),
		array(
			'id'      => 'upload_custom_preloader_svg',
			'type'    => 'media',
			'title'   => esc_html__( 'Custom Preloader Svg', 'zenix-essential' ),
			'library' => 'image',
			'desc'    => 'Upload a animated svg file here . You may follow <a target="_blank" href="https://www.svgbackgrounds.com/elements/animated-svg-preloaders/" >https://www.svgbackgrounds.com/elements/animated-svg-preloaders/</a>'
		),
		array(
			'id'      => 'preloader_svg_dimensions',
			'type'    => 'dimensions',
			'title'   => 'Svg Preloader Dimensions',
			'default' => array(
				'width'  => '100',
				'height' => '200',
				'unit'   => 'px',
			),
			'output'  => '.animation-preloader img'
		),
		array(
			'id'      => 'preloader_text',
			'type'    => 'text',
			'title'   => esc_html__( 'Title', 'zenix-essential' ),
			'default' => 'zenix'
		),

		array(
			'id'     => 'preloader_text_typhography',
			'type'   => 'typography',
			'title'  => esc_html__( 'Typography', 'zenix-essential' ),
			'output' => '.container-preloader .animation-preloader .txt-loading .characters',
		),

		array(
			'id'    => 'preloader_uppercase_text',
			'type'  => 'switcher',
			'title' => esc_html__( 'Uppercase Text', 'zenix-essential' )
		),

		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Preloader Background & Color', 'zenix-essential' ),
		),

		array(
			'id'      => 'preloader_bg',
			'type'    => 'background',
			'title'   => esc_html__( 'Preloader Background', 'zenix-essential' ),
			'class'   => '.loaders-container',
			'output'  => '.container-preloader .loader-section',
			'desc'    => esc_html__( 'Upload a new background image or select color to set the preloader background.', 'zenix-essential' ),
			'default' => array(
				'image'      => '',
				'repeat'     => 'repeat',
				'position'   => 'center center',
				'attachment' => 'scroll',
				'size'       => '',
				'color'      => '#ffffff',
			),
		),

		array(
			'id'      => 'preloader_text_color',
			'type'    => 'color',
			'title'   => esc_html__( 'Preloader Text Color', 'zenix-essential' ),
			'desc'    => esc_html__( 'Set the preloader text color', 'zenix-essential' ),
			'default' => '',
			'output'  => '.container-preloader .animation-preloader .txt-loading .characters',
		),

		array(
			'id'      => 'preloader_spinner_color1',
			'type'    => 'color',
			'title'   => esc_html__( 'Spinner Color 1', 'zenix-essential' ),
			'desc'    => esc_html__( 'Set the preloader spinner color', 'zenix-essential' ),
			'default' => '',
		),

		array(
			'id'      => 'preloader_spinner_color2',
			'type'    => 'color',
			'title'   => esc_html__( 'Spinner Color 2', 'zenix-essential' ),
			'desc'    => esc_html__( 'Set the preloader text color 2', 'zenix-essential' ),
			'default' => '',
		),
	),
) );