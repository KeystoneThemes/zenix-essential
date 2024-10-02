<?php 

function wdb_megamenu_registered_widget( $widgets_manager ) {

	require_once( __DIR__ . '/mega-menu.php' );
	$widgets_manager->register( new \WDB\Megamenu\Widgets\wdb_Header_Mega_Menu() );

}
add_action( 'elementor/widgets/register', 'wdb_megamenu_registered_widget' );