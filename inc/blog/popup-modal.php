<?php 

  $json_data = zenix_get_config_value_by_name('elementor/post-single');
  $args = array(
      'numberposts' => 15,
      'post_type' => ['wdb-single-post'],
      'post_status' => array('publish')    
  );
  
  $latest_posts = get_posts( $args );
  $active_id = get_option('wdb-elementor-post-layout-id');
  
  $hf_page  = admin_url( 'edit.php?post_type=wdb-single-post' );
  $_hf_html = sprintf( '<a href="%s" target="_blank">%s</a>' , esc_url($hf_page), esc_html__('There is no layout manage From Builder Page','zenix-essential') );
  
?>
<style>
  .wdb-single-tpl-wrapper .wdb--blog-builder-list {
      display: flex;
      gap: 80px;
      flex-wrap: wrap;
  }
  .wdb-hover-element{
      visibility: hidden;
      opacity: 0;
      transition: 0.3s;
  }
  .wdb-image-tpl:hover .wdb-hover-element{
     visibility: visible;
     opacity: 1;
  }
  .wdb-image-tpl {
      position: relative;
  }
  .wdb-image-tpl.active{
    border: 3px solid #db4d4d;
  }
  
  .wdb-image-tpl::after {
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      background: #663399cf;
      content: "";
      z-index: 0;
      opacity: 0;
      transition: all 0.3s;
  }
  .wdb-image-tpl:hover:after {
      opacity: 1;
  }
  .wdb-image-tpl img {
      height: 100%;
  }
  .wdb-hover-element {
      cursor: pointer;
      visibility: hidden;
      opacity: 0;
      transition: 0.3s;
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      top: 0;
      left: 0;
      z-index: 5;
      color: white;
  }
  
  /** Modal Popup */
  
  /* [Object] Modal
   * =============================== */
  .wdb-modal {
    opacity: 0;
    visibility: hidden;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    text-align: left;
    background: rgba(0,0,0, .9);
    transition: opacity .25s ease;
    text-align: center;
    z-index: 99999;
  }
  
  .wdb-modal h2 {
      border-bottom: 1px solid #e1e1e1;
      padding-top: 5px;
      padding-bottom: 20px;
      margin: 0;
  }
  
  .wdb-modal__bg {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    cursor: pointer;
  }
  
  .wdb-modal-state,
  .wdb-modal-state{
    display: none !important;
  }
  
  .wdb-modal-state:checked + .wdb-modal {
    opacity: 1;
    visibility: visible;
  }
  
  .wdb-modal-state:checked + .wdb-modal .wdb-modal__inner {
    top: 0;
  }
  
  .wdb-modal__inner {
      transition: top .25s ease;
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100%;
      margin: auto;
      overflow: auto;
      background: #fff;
      border-radius: 5px;
      padding: 1em 2em;
      height: 100%;
  }
  
  .wdb-modal__close-import {
    position: absolute;
    right: 100px;
    top: 26px;
    width: 1.1em;
    height: 1.1em;
    cursor: pointer;
  }
  
  .wdb-modal__close-import:after,
  .wdb-modal__close-import:before {
    content: '';
    position: absolute;
    width: 2px;
    height: 1.5em;
    background: #ccc;
    display: block;
    transform: rotate(45deg);
    left: 50%;
    margin: -3px 0 0 -1px;
    top: 0;
  }
  
  .wdb-modal__close-import:hover:after,
  .wdb-modal__close-import:hover:before {
    background: #aaa;
  }
  
  .wdb-modal__close-import:before {
    transform: rotate(-45deg);
  }
  
  @media screen and (max-width: 768px) {
  	
    .wdb-modal__inner {
      width: 70%;
      height: 70%;
      box-sizing: border-box;
    }
  }
  
  .wdb-content-install h1{
   line-height: 1.2;
  }

</style>
<script>
 // 
 document.addEventListener("DOMContentLoaded", function(event) {
    var data = {action: "wdb_post_tpl_remote_import", tpl_id : 0};    
    
    var ajax_path = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
    jQuery(document).on('click', '.wdb--blog-tpl-install-remote' ,function(e){     
       jQuery('.wdb-single-tpl-wrapper h1').html('Template Importing . Please Wait');     
       jQuery('.wdb-image-tpl').removeClass('active');
       data.tpl_id = jQuery(this).attr('data-id');
       jQuery.ajax({
         type : 'post',        
         url : ajax_path,
         data : data,
         success: function(response) {            
            jQuery('.wdb-single-tpl-wrapper h1').html(response.message);
            setTimeout(() => {
                jQuery('.wdb-single-tpl-wrapper h1').html('');
            }, 3000);           
         }
      });
    });

    jQuery(document).on('click', ".wdb-post-layout-import-modal" ,function(){
      jQuery('.wdb--remote-layouts').css({opacity : 1,visibility: 'visible'});
    }); 
    
    jQuery(document).on('click', ".wdb-modal__close-import" ,function(){
        jQuery('.wdb--remote-layouts').css({opacity : 0,visibility: 'hidden'});
    });
    
});
</script>

<div class="wdb-modal wdb--remote-layouts">
  <label class="wdb-modal__bg" for="wdb-elementor-popup"></label>
  <div class="wdb-modal__inner">
    <label class="wdb-modal__close-import" for="wdb-elementor-popup"></label>
    <h2><?php echo esc_html__('Blog Template Import','zenix-essential') ?></h2>
      <div class="wdb-content-install">
      <div class="wdb-single-tpl-wrapper">
            <h4><?php echo esc_html__('Elementor Layout','zenix-essential') ?></h4>
            <h1></h1>
            <div class="wdb--blog-builder-list">
            <?php foreach($json_data as $item){ ?> 
                <div class="wdb-image-tpl <?php //echo $active_id == $item->ID ? 'active' : ''; ?>">
                    <img src="<?php echo $item['preview_image_big']; ?>" />
                    <div class="wdb-hover-element">
                        <span data-id="<?php echo $item['uniq_id']; ?>" class="wdb--blog-tpl-install-remote"><?php echo esc_html__('Activate','zenix-essential'); ?></span>
                    </div>
                </div>
                <?php } ?>
                <?php echo empty($json_data) ? $_hf_html : ''; ?>
            </div>
        </div>
      </div>
  </div>
</div>