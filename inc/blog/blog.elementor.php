<?php 

  $args = array(
    'numberposts' => 4,
    'post_type' => ['wdb-blog-tpl'],
    'post_status' => array('publish'),
    'meta_key' => 'wdb_essential_settings_blog_layoutactivate',
    'orderby' => 'meta_value_num',
  );
  
  $latest_posts = get_posts( $args );
  $active_id = get_option('wdb-elementor-blog-layout-id');
  
  $hf_page  = admin_url( 'edit.php?post_type=wdb-blog-tpl' );
  $_hf_html = sprintf( '<a href="%s" target="_blank">%s</a>' , esc_url($hf_page), esc_html__('There is no layout manage From Builder Page','zenix-essential') );
?>
<style>
.wdb-sing-tpl-wrapper .wdb--blog-builder-list {
    display: flex;
    gap: 80px;
    flex-wrap: wrap;
}
.wdb-image-tpl {
    position: relative;
}
.wdb-image-tpl.active{
  border: 3px solid #db4d4d;
}
.wdb-image-tpl img {
    height: 100%;
}

.wdb-tp-max-width img{
  max-width: 250px;
}
.wdb--blog-builder-list.theme-iptio > div {
  display: flex;
  flex-direction: column;
  gap: 9px;
}
</style>

<div class="wdb-sing-tpl-wrapper">
    <h4><a class="wdb-post-layout-import-modal button button-primary csf--button" data-id="blog_layout" href="javascript:void(0)"><?php echo esc_html__('Import From Library','zenix-essential') ?></a> </h4>
    <div class="wdb--blog-builder-list theme-iptio">
      <?php if($active_id){ ?> 
         <?php foreach($latest_posts as $item){ ?> 
          <div class="wdb-tp-max-width <?php echo $active_id == $item->ID ? 'active' : ''; ?>">
              <img src="<?php echo get_the_post_thumbnail_url($item->ID); ?>" />
              <label><?php echo get_the_title($item->ID); ?></label>
          </div>
          <?php } ?>       
        <?php } ?>       
    </div>
</div>

