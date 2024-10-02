<?php
namespace ZenixEssentialApp\Importer;

/**
 * demo import.
 */
class Wdb_Theme_Demos
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct()
	{
       
       add_action( 'fw:ext:backups:tasks:success', [$this,'success'] );
       
        if( !zenix_theme_service_pass() ){
            return;
        }
       
       add_filter( 'fw:ext:backups-demo:demos', [$this,'backups_demos'] );     
 	}
	
    function backups_demos( $demos ) {
        
        $demo_content_installer	 = 'https://api.keystonethemes.com/demos/zenix/';
        
        $demos_array			 = array(
        
            'tech-startup' => array(
                'title'        => esc_html__( 'Tech Startup', 'tech-startup' ),
                'category'     => [ 'Tech', 'Startup' ],
                'screenshot'   => esc_url( $demo_content_installer ) . 'tech-startup/screenshot.jpg',
                'preview_link' => esc_url( 'https://zenix.keystonedemo.com/' ),
            ),

            'saas' => array(
                'title'        => esc_html__( 'Saas', 'saas' ),
                'category'     => [ 'Saas', 'Softwere' ],
                'screenshot'   => esc_url( $demo_content_installer ) . 'saas/screenshot.jpg',
                'preview_link' => esc_url( 'https://zenix.keystonedemo.com/' ),
            ),

            'crm-platform' => array(
                'title'        => esc_html__( 'CRM Platform', 'crm-platform' ),
                'category'     => [ 'CRMs', 'Softwere' ],
                'screenshot'   => esc_url( $demo_content_installer ) . 'crm-platform/screenshot.jpg',
                'preview_link' => esc_url( 'https://zenix.keystonedemo.com/' ),
            ),

            'ai-chatbot' => array(
                'title'        => esc_html__( 'AI Chatbot', 'ai-chatbot' ),
                'category'     => [ 'AI', 'Chatbot' ],
                'screenshot'   => esc_url( $demo_content_installer ) . 'ai-chatbot/screenshot.jpg',
                'preview_link' => esc_url( 'https://zenix.keystonedemo.com/' ),
            ),

            'help-desk' => array(
                'title'        => esc_html__( 'Help Desk', 'help-desk' ),
                'category'     => [ 'Saas', 'Startup' ],
                'screenshot'   => esc_url( $demo_content_installer ) . 'help-desk/screenshot.jpg',
                'preview_link' => esc_url( 'https://zenix.keystonedemo.com/' ),
            ),
            
        );

        $download_url = esc_url( $demo_content_installer ) . '/download-script.php';
        try {
            foreach ( $demos_array as $id => $data ) {
                $demo		 = new \FW_Ext_Backups_Demo( $id, 'piecemeal', array(
                    'url'		 => $download_url,
                    'file_id'	 => $id,
                ) );
                $category = isset($data[ 'category' ]) ? $data[ 'category' ] : [];
                $demo->set_title( $data[ 'title' ] );
                $demo->set_screenshot( $data[ 'screenshot' ] );
                $demo->set_preview_link( $data[ 'preview_link' ] );
                $demo->set_category( $category );
                $demos[ $demo->get_id() ]	 = $demo;
                unset( $demo );
            }
        } catch (\Exception $e) {
            
        }  
        

        return $demos;
    }
    
    public function success(){
       
        foreach($this->_metas as $key) {
            $value = get_user_meta(1, $key, true);
            update_option( $key, $value );
        }
    }

}

new Wdb_Theme_Demos();




