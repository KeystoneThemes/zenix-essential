<?php
/**
 * the template for displaying all posts.
 */

  get_header(); 
  $post_id = apply_filters('wdb_elementor_search_layout_id',get_option('wdb-elementor-search-layout-id')); 
?>
  <main>
      <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id , true); ?>
  </main> <!--#main-content -->
<?php get_footer(); ?>