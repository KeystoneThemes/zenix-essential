<?php 

    // social
    CSF::createSection( 'zenix_settings', array(
        'title'  => esc_html__( 'Social', 'zenix-essential' ),
        'icon'   => 'fa fa-share-alt',
        'fields' => array(
            array(
                'id'      => 'enable_social_share',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Enable social Share', 'zenix-essential' ),
                'desc'    => esc_html__( 'If you want to enable or disable 404 page button you can set ( YES / NO )', 'zenix-essential' ),
                'default' => false,
            ),
            array(
                'id'           => 'social_share',
                'type'         => 'group',
                'title'        => esc_html__( 'Add social share', 'zenix-essential' ),
                'button_title' => esc_html__( 'Add new share', 'zenix-essential' ),
                'desc'         => esc_html__( 'Set the social share icon and link here. Esay to use it just click the add icon button and search your social icon and set the url for the profile .', 'zenix-essential' ),
                'fields'       => array(
                   
                    array(
                        'id'      => 'bookmark_icon',
                        'type'    => 'icon',
                        'title'   => esc_html__( 'Social Icon', 'zenix-essential' ),
                        'desc'    => esc_html__( 'Set the social profile icon like ( facebook, twitter, linkedin, youtube ect. )', 'zenix-essential' ),
                        'default' => 'fa fa-facebook'
                    ),

                   
                    array(
                        'id'          => 'social_type',
                        'type'        => 'select',
                        'title'       => 'Select',
                        'placeholder' => esc_html__( 'Select an type' , 'zenix-essential' ),
                        'options'     => zenix_social_share_list(),
                        
                      ),
                ),
            ),

            array(
                'id'           => 'social_link',
                'type'         => 'group',
                'title'        => esc_html__( 'Add Social Link', 'zenix-essential' ),
                'button_title' => esc_html__( 'Add New Link', 'zenix-essential' ),
                'desc'         => esc_html__( 'Set the social icon and link here. Esay to use it just click the add icon button and search your social icon and set the url for the profile .', 'zenix-essential' ),
                'fields'       => array(
                   
                    array(
                        'id'      => 'bookmark_icon',
                        'type'    => 'icon',
                        'title'   => esc_html__( 'Social Icon', 'zenix-essential' ),
                        'desc'    => esc_html__( 'Set the social profile icon like ( facebook, twitter, linkedin, youtube ect. )', 'zenix-essential' ),
                        'default' => 'fa fa-facebook'
                    ),

                    array(
                        'id'      => 'bookmark_url',
                        'type'    => 'text',
                        'title'   => esc_html__( 'Profile Url', 'zenix-essential' ),
                        'desc'    => esc_html__( 'Type the social profile url lik http://facebook.com/yourpage. also you can add (facebook, twitter, linkedin, youtube etc.)', 'zenix-essential' ),
                        'default' => 'http://facebook.com/keystonethemes'
                    ),

	                array(
		                'id'    => 'opt_new_tab',
		                'type'  => 'switcher',
		                'title' => esc_html__('New Tab','zenix-essential'),
	                ),

                ),
            ),
   
            array(
                'id'         => 'social_color',
                'type'       => 'color',
                'title'      => esc_html__( 'Footer Social Color', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set the footer social bookmark color from here.', 'zenix-essential' ),
                'default'    => '',
                'dependency' => array( 'enable_footer_social', '==', 'true' ),
            ),

            array(
                'id'         => 'social_hover_color',
                'type'       => 'color',
                'title'      => esc_html__( 'Footer Social Hover Color', 'zenix-essential' ),
                'desc'       => esc_html__( 'Set the footer social bookmark hover color from here.', 'zenix-essential' ),
                'default'    => '',
                'dependency' => array( 'enable_footer_social', '==', 'true' ),
            ),

        ),

    ) );