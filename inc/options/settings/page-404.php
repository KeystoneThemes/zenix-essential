<?php


// Post Page
CSF::createSection( ZENIX_OPTION_KEY, array(
	'icon'  => 'fas fa-holly-berry',
	'id'    => '404_page_section', // Set a unique slug-like ID
	'title' => esc_html__( '404', 'zenix-essential' )
) );

CSF::createSection( ZENIX_OPTION_KEY, array(
	'parent' => '404_page_section', // The slug id of the parent section
	'icon'   => 'fa fa-book',
	'title'  => esc_html__( 'Content', 'zenix-essential' ),
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => esc_html__( '404 Error Page Setting', 'zenix-essential' ),
		),

		array(
			'id'      => 'error_title',
			'type'    => 'text',
			'title'   => esc_html__( 'Error title', 'zenix-essential' ),
			'desc'    => esc_html__( 'Set your 404 error title.', 'zenix-essential' ),
			'default' => esc_html__( '404', 'zenix-essential' ),
		),

		array(
			'id'      => 'error_subtitle',
			'type'    => 'text',
			'title'   => esc_html__( 'Error subtitle', 'zenix-essential' ),
			'desc'    => esc_html__( 'Set your 404 error subtitle.', 'zenix-essential' ),
			'default' => esc_html__( 'Ops! Page not found', 'zenix-essential' ),
		),

		array(
			'id'      => 'error_content',
			'type'    => 'wp_editor',
			'title'   => esc_html__( 'Error content', 'zenix-essential' ),
			'desc'    => esc_html__( 'Set your 404 error subtitle.', 'zenix-essential' ),
			'default' => esc_html__( 'The page you are looking for was moved, removed, renamed or never existed.', 'zenix-essential' ),
		),

		array(
			'id'      => 'enable_404_search_button',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Search Button', 'zenix-essential' ),
			'desc'    => esc_html__( 'If you want to enable or disable 404 page button you can set ( YES / NO )', 'zenix-essential' ),
			'default' => true,
		),

		array(
			'id'         => 'error_btn_text',
			'type'       => 'text',
			'title'      => esc_html__( 'Button Text', 'zenix-essential' ),
			'desc'       => esc_html__( 'Set your 404 button text.', 'zenix-essential' ),
			'default'    => esc_html__( 'Back to Home', 'zenix-essential' ),
			'dependency' => array( 'enable_404_search_button', '==', 'true' ),
		),
	)
) );

CSF::createSection( ZENIX_OPTION_KEY, array(
	'parent' => '404_page_section',
	'icon'   => 'fa fa-book',
	'title'  => esc_html__( 'Style', 'zenix-essential' ),
	'fields' => array(
		array(

			'id'     => 'banner_404_image',
			'type'   => 'background',
			'title'  => esc_html__( 'Upload Background', 'zenix-essential' ),
			'desc'   => esc_html__( 'Upload main Image width 1200px and height 400px.', 'zenix-essential' ),
			'output' => '.error404 .body-wrapper'
		),

		array(
			'id'               => 'banner_404_content_title_color',
			'type'             => 'color',
			'title'            => esc_html__( 'Title Color', 'zenix-essential' ),
			'output'           => '.error404 .default-error__title',
			'output_important' => true
		),

		array(
			'id'               => 'banner_404_content_subtitle_color',
			'type'             => 'color',
			'title'            => esc_html__( 'SubTitle Color', 'zenix-essential' ),
			'output'           => '.error404 .default-error__sub-title',
			'output_important' => true
		),

		array(
			'id'               => 'banner_404_content_c_color',
			'type'             => 'color',
			'title'            => esc_html__( 'Content Color', 'zenix-essential' ),
			'output'           => '.error404 .default-error__content p',
			'output_important' => true
		),
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Button', 'zenix-essential' ),
		),

		array(
			'id'               => 'banner_404_content_button_color',
			'type'             => 'color',
			'title'            => esc_html__( 'Button Color', 'zenix-essential' ),
			'output'           => '.error404 .default-error_go_btn a,.error404 .default-error_go_btn i',
			'output_important' => true
		),
		array(
			'id'               => 'banner_404_content_button_bg_color',
			'type'             => 'color',
			'title'            => esc_html__( 'Button bgColor', 'zenix-essential' ),
			'output'           => '.error404 .default-error_go_btn a',
			'output_important' => true,
			'output_mode'      => 'background-color'
		),

		array(
			'id'     => 'banner_404_content_button_border',
			'type'   => 'border',
			'title'  => esc_html__( 'Button Border', 'zenix-essential' ),
			'output' => '.error404 .default-error_go_btn a'
		),

		array(
			'id'               => 'banner_404_content_button_hcolor',
			'type'             => 'color',
			'title'            => esc_html__( 'Button Hover Color', 'zenix-essential' ),
			'output'           => '.error404 .default-error_go_btn:hover a,.error404 .default-error_go_btn:hover i',
			'output_important' => true
		),
		array(
			'id'               => 'banner_404_content_button_bg_hcolor',
			'type'             => 'color',
			'title'            => esc_html__( 'Button Hover bgColor', 'zenix-essential' ),
			'output'           => '.error404 .default-error_go_btn:hover a',
			'output_important' => true,
			'output_mode'      => 'background-color'
		),

		array(
			'id'     => 'banner_404_content_button_hborder',
			'type'   => 'border',
			'title'  => esc_html__( 'Button Hover Border', 'zenix-essential' ),
			'output' => '.error404 .default-error_go_btn a:hover'
		),
	)
) );
    