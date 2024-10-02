<?php

	// Woo a top-tab
	CSF::createSection( ZENIX_OPTION_KEY, array(
		'id'    => 'wdb_woo_tab',                     // Set a unique slug-like ID
		'title' => esc_html__( 'WooCommerce', 'zenix-essential' ),
		'icon'  => 'fas fa-archive',
	) );

	// Shop
	CSF::createSection( ZENIX_OPTION_KEY, array(
		'parent' => 'wdb_woo_tab',                        // The slug id of the parent section
		'icon'   => 'fas fa-archive',
		'title'  => esc_html__( 'Shop', 'zenix-essential' ),
		'fields' => array(
			array(
				'id'          => 'wdb_woo_sidebar',
				'type'        => 'select',
				'title'       => esc_html__( 'Shop Sidebar', 'zenix-essential' ),
				'placeholder' => 'Select an option',
				'options'     => array(
					'no-sidebar'    => esc_html__( 'No sidebar', 'zenix-essential' ),
					'left-sidebar'  => esc_html__( 'Left Sidebar', 'zenix-essential' ),
					'right-sidebar' => esc_html__( 'Right Sidebar', 'zenix-essential' ),
				),
				'default'     => 'left-sidebar',
			),

			array(
				'id'          => 'wdb_woo_product_sidebar',
				'type'        => 'select',
				'title'       => esc_html__( 'Product Sidebar', 'zenix-essential' ),
				'placeholder' => 'Select an option',
				'options'     => array(
					'no-sidebar'    => esc_html__( 'No sidebar', 'zenix-essential' ),
					'left-sidebar'  => esc_html__( 'Left Sidebar', 'zenix-essential' ),
					'right-sidebar' => esc_html__( 'Right Sidebar', 'zenix-essential' ),
				),
				'default'     => 'no-sidebar',
			),

			array(
				'id'          => 'wdb_product_cols',
				'type'        => 'select',
				'title'       => esc_html__( 'Product Columns', 'zenix-essential' ),
				'placeholder' => 'Select Columns',
				'options'     => array(
					'2' => esc_html__( '2', 'zenix-essential' ),
					'3' => esc_html__( '3', 'zenix-essential' ),
					'4' => esc_html__( '4', 'zenix-essential' ),
				),
				'default'     => '3',
			),

			array(
				'id'          => 'wdb_product_tb_cols',
				'type'        => 'select',
				'title'       => esc_html__( 'Product Columns in Tablet', 'zenix-essential' ),
				'placeholder' => 'Select Columns',
				'options'     => array(
					'1' => esc_html__( '1', 'zenix-essential' ),
					'2' => esc_html__( '2', 'zenix-essential' ),
					'3' => esc_html__( '3', 'zenix-essential' ),
				),
				'default'     => '2',
			),

			array(
				'id'          => 'wdb_rel_product_cols',
				'type'        => 'select',
				'title'       => esc_html__( 'Related Product Show', 'zenix-essential' ),
				'placeholder' => 'Select Columns',
				'options'     => array(
					'2' => esc_html__( '2', 'zenix-essential' ),
					'3' => esc_html__( '3', 'zenix-essential' ),
					'4' => esc_html__( '4', 'zenix-essential' ),
					'5' => esc_html__( '5', 'zenix-essential' ),
					'6' => esc_html__( '6', 'zenix-essential' ),
				),
				'default'     => '4',
			),

			array(
				'id'          => 'wdb_shop_thumb_size',
				'type'        => 'select',
				'title'       => esc_html__( 'Image Size', 'zenix-essential' ),
				'placeholder' => esc_html__( 'Select Product Thumbsize', 'zenix-essential' ),
				'options'     => zenix_get_image_sizes(),
				'default'     => 'full',
			),


		)
	) );


	// Sidebar
	CSF::createSection( ZENIX_OPTION_KEY, array(
		'parent' => 'wdb_woo_tab',                        // The slug id of the parent section
		'icon'   => 'fas fa-archive',
		'title'  => esc_html__( 'Sidebar', 'zenix-essential' ),
		'fields' => array(
			array(
				'id'     => 'wdb_s_title_color',
				'type'   => 'color',
				'title'  => esc_html__( 'Title Color', 'zenix-essential' ),
				'output' => '.wdb-woo--title',
			),

			array(
				'id'          => 'wdb_s_title_border',
				'type'        => 'color',
				'title'       => esc_html__( 'Border Color', 'zenix-essential' ),
				'output_mode' => 'border-color',
				'output'      => '.wdb-woo--title',
			),

			array(
				'id'          => 'wdb_s_widget_b_radius',
				'type'        => 'spacing',
				'title'       => 'Border Radius',
				'output_mode' => 'border-radius',
				'output'      => '.wdb-woo--widget',
			),

			array(
				'id'          => 'wdb_s_widget_bg',
				'type'        => 'color',
				'title'       => esc_html__( 'Background Color', 'zenix-essential' ),
				'output_mode' => 'background-color',
				'output'      => '.wdb-woo--widget',
			),

		)
	) );


	// Cart
	CSF::createSection( ZENIX_OPTION_KEY, array(
		'parent' => 'wdb_woo_tab',                        // The slug id of the parent section
		'icon'   => 'fas fa-archive',
		'title'  => esc_html__( 'Cart', 'zenix-essential' ),
		'fields' => array(

			array(
				'id'    => 'cart_uwq_change',
				'type'  => 'switcher',
				'title' => 'Update Cart with Quantity',
			),

			array(
				'id'          => 'onsale_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Onsale Color', 'zenix-essential' ),
				'output' => array( '.woocommerce ul.products li.product .onsale', '.single-product.woocommerce span.onsale' ),
			),

			array(
				'id'          => 'onsale_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Onsale Background Color', 'zenix-essential' ),
				'output_mode' => 'background-color',
				'output' => array( '.woocommerce ul.products li.product .onsale', '.single-product.woocommerce span.onsale' ),
			),

		)
	) );


	// Message
	CSF::createSection( ZENIX_OPTION_KEY, array(
		'parent' => 'wdb_woo_tab',                        // The slug id of the parent section
		'icon'   => 'fas fa-archive',
		'title'  => esc_html__( 'Error & Message', 'zenix-essential' ),
		'fields' => array(
			array(
				'id'            => 'opt-tabbed-banner',
				'type'          => 'tabbed',
				'title'         => 'Style',
				'tabs'          => array(

					array(
						'title'     => esc_html__('Message','zenix-essential'),
						'icon'      => '',
						'fields'    => array(
							array(
								'id'          => 'woo_msg_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Color', 'zenix-essential' ),
								'output'      => '.woocommerce-message',
							),

							array(
								'id'          => 'woo_msg_b_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Border Color', 'zenix-essential' ),
								'output_mode' => 'border-top-color',
								'output'      => '.woocommerce-message',
							),

							array(
								'id'          => 'woo_msg_icon_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Icon Color', 'zenix-essential' ),
								'output'      => '.woocommerce-message::before',
							),

							array(
								'id'          => 'woo_msg_bg',
								'type'        => 'color',
								'title'       => esc_html__( 'Background Color', 'zenix-essential' ),
								'output_mode' => 'background-color',
								'output'      => '.woocommerce-message',
							),

						)
					),

					array(
						'title'     => esc_html__('Info','zenix-essential'),
						'icon'      => '',
						'fields'    => array(

							array(
								'id'          => 'woo_info_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Color', 'zenix-essential' ),
								'output'      => '.woocommerce-info',
							),

							array(
								'id'          => 'woo_info_b_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Border Color', 'zenix-essential' ),
								'output_mode' => 'border-top-color',
								'output'      => '.woocommerce-info',
							),

							array(
								'id'          => 'woo_info_icon_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Icon Color', 'zenix-essential' ),
								'output'      => '.woocommerce-info::before',
							),

							array(
								'id'          => 'woo_info_msg_bg',
								'type'        => 'color',
								'title'       => esc_html__( 'Background Color', 'zenix-essential' ),
								'output_mode' => 'background-color',
								'output'      => '.woocommerce-info',
							),

						)
					),

					array(
						'title'     => esc_html__('Error','zenix-essential'),
						'icon'      => '',
						'fields'    => array(
							array(
								'id'          => 'woo_err_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Color', 'zenix-essential' ),
								'output'      => '.woocommerce-error',
							),

							array(
								'id'          => 'woo_err_b_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Border Color', 'zenix-essential' ),
								'output_mode' => 'border-top-color',
								'output'      => '.woocommerce-error',
							),

							array(
								'id'          => 'woo_err_icon_color',
								'type'        => 'color',
								'title'       => esc_html__( 'Icon Color', 'zenix-essential' ),
								'output'      => '.woocommerce-error::before',
							),

							array(
								'id'          => 'woo_err_msg_bg',
								'type'        => 'color',
								'title'       => esc_html__( 'Background Color', 'zenix-essential' ),
								'output_mode' => 'background-color',
								'output'      => '.woocommerce-error',
							),
						)
					),

				)
			),
		)
	) );