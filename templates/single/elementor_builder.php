<?php
/**
 * the template for displaying all posts.
 */
get_header(); 
  
  $post_id = apply_filters('wdb_elementor_blog_post_layout_id', get_option('wdb-elementor-post-layout-id') );  
?>
  <main>
      <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content( $post_id , true); ?>
  </main> <!--#main-content -->
<?php get_footer(); ?>