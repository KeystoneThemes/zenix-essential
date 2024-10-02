<?php 

    // Woo a top-tab
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'id'    => 'wdb_rtl_tab',                     // Set a unique slug-like ID
        'title' => esc_html__( 'RTL', 'zenix-essential' ),
        'icon'  => 'fas fa-paragraph-rtl',
    ) );

    // Shop
    CSF::createSection( ZENIX_OPTION_KEY, array(
        'parent' => 'wdb_rtl_tab',                        // The slug id of the parent section
        'icon'   => 'fas fa-paragraph-rtl',
        'title'  => esc_html__( 'Settings', 'zenix-essential' ),
        'fields' => array(
        
	        array(
                'id'      => 'wdb_enable_rtl',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Enable RTL (Frontend)', 'zenix-essential' ),
                'default' => false,
            ),          

        )
    ) );

