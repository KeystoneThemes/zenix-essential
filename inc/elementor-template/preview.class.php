<?php

namespace ZenixEssentialApp\Elemetor_Template;

class WDB_Elementor_Template_Preview
{
    public $option = null;
    
    function __construct() {
        add_filter( 'template_include', [ $this , 'preview_template_override' ], 9999 );
        add_filter( 'single_template', [ $this , 'preview_template_override' ], 9999 );
        add_filter( 'post_row_actions', [ $this ,'add_list_row_actions' ], 10, 2 );
        add_action( 'init', [$this,'custom_preview_route'] );
        add_filter( 'query_vars', [$this, 'custom_query_var']);        
       
    }
    
    public function custom_query_var( $query_vars ) {
        $query_vars[] = 'wdb-template-slug';
        return $query_vars;
    }
    
    function custom_preview_route(){
        add_rewrite_rule( 'wdb-elementor-template-preview/([a-z0-9-]+)[/]?$', 'index.php?wdb-template-slug=$matches[1]', 'top' );
    }
    
    public function preview_template_override($template){      
        
        if ( get_query_var( 'wdb-template-slug' ) && isset($_GET['source']) && $_GET['source']  === 'wdb-templates') {   
            $uri = $_SERVER['REQUEST_URI'];
            if (strpos($uri, 'wdb-elementor-template-preview') !== false) {
                $new_template = ZENIX_ESSENTIAL_DIR_PATH . "templates/elementor-public-preview.php";            
                return $new_template;
            }
        }
    
        if(isset($_GET['elementor_library']) && get_post_type() == 'elementor_library'){       
            $template =ZENIX_ESSENTIAL_DIR_PATH . "templates/elementor-preview.php";
            return $template;
        }
        
        return $template;
    }
    function add_list_row_actions( $actions, $post ) {       
        // Check for your post type.
        if ( $post->post_type == "elementor_library" ) {               
            $url = home_url(). '/wdb-elementor-template-preview/'.$post->post_name;
            $edit_link = add_query_arg( array( 'source' => 'wdb-templates','post' => $post->ID), $url );       
            $actions['wdb-preview'] = sprintf(
                '<a href="%1$s">%2$s</a>',
                $edit_link,
                esc_html__('WDB Preview','zenix-essential')
            );    
        }
    
        return $actions;
    }    
    
}

new WDB_Elementor_Template_Preview();