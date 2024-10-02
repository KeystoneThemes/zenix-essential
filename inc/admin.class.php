<?php

namespace ZenixEssentialApp\Inc;

/**
 * Admin Related hook.
 */
class Zenix_Essentail_Admin
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct(){ 	
    add_action( 'wp_ajax_wdb_admin_get_cache_cpt', [$this,'zenix_admin_get_custom_post_types'] );
	}

	
	/**
	 * Hide elementor widget from editor pabel for blog builder post type 
	 * @return
	 */
	function elementor_widget_hide( $settings ){	
	
		if(isset($settings['initial_document']['widgets'])){
			$settings['initial_document']['widgets']['wdb--theme-post-content']['show_in_panel'] = false;
			$settings['initial_document']['widgets']['wdb--theme-post-content']['hide_on_search'] = false;
			$settings['initial_document']['widgets']['wdb--blog--post--excerpt']['show_in_panel'] = false;
			$settings['initial_document']['widgets']['wdb--blog--post--excerpt']['hide_on_search'] = false;
			if(\Elementor\Plugin::$instance->editor->is_edit_mode() && isset($_GET['post'])){
				if(get_post_type($_GET['post']) == 'wdb-single-post'){
					$settings['initial_document']['widgets']['wdb--theme-post-content']['show_in_panel'] = true;
					$settings['initial_document']['widgets']['wdb--theme-post-content']['hide_on_search'] = false;
					$settings['initial_document']['widgets']['wdb--blog--post--excerpt']['show_in_panel'] = true;
					$settings['initial_document']['widgets']['wdb--blog--post--excerpt']['hide_on_search'] = false;
				}			
			}
		}
		
		return $settings;
	}
	
	function zenix_admin_get_custom_post_types(){
	
		if ( !wp_verify_nonce( $_REQUEST['nonce'], "wdb_theme_secure")) {
			exit("No naughty business please");
		}
		zenix_get_cache_tax_types();
		zenix_get_cache_post_types();
	    $array_result = array(
            'status' => esc_html__('Cache post type and taxonomy','zenix-essential'),
        ); 
        wp_send_json($array_result);	 
	}
	
}

new Zenix_Essentail_Admin();