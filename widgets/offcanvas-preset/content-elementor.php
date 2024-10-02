  <!-- offcanvas start  -->
  <div class="open-offcanvas wdb--info-animated-offcanvas" data-content_source="<?php echo esc_attr($settings['content_source']); ?>" data-preset="<?php echo esc_attr($preset_style); ?>">
        <?php if( $settings['menu_button_text'] == '' ){ ?>
					    <?php if($bar !=''){ ?>
		                <img src="<?php echo esc_url($bar); ?>" />
		                <?php echo zenix_get_attachment_image_html( $settings, 'thumbnail', 'sticky_bar', ['class' => 'wdb-sticky-bar'] ); ?>
		            <?php }else{ ?>
		                <span class="menu-icon-2 light-dash"><span></span></span>
		            <?php } ?>
	            <?php }else{ ?>
	                <?php echo esc_html($settings['menu_button_text']); ?>
	      <?php } ?>
	</div>
  <div class="offcanvas-4__area wdb-element-transfer-to-body wdb-offcanvas-gl-style">
    <div class="offcanvas-4__inner">
      <div class="offcanvas-4__button-wrapper offcanvas-close__button-wrapper offcanvas--close--button-js">
        <button class="text-close-button">       
           <?php if($settings['default_close_contentss'] =='yes') { ?>
                <div class="bars">
                  <?php echo esc_html__( 'Close' , 'zenix-essential' ); ?>
                  <span></span>
                  <span></span>
                </div>
					      <?php }else{ ?>
                  <?php echo esc_html( $settings[ 'close_text' ] ); ?>
                  <?php if(zenix_render_elementor_icons($settings['close_icon'])){ ?>
  				          <div class="off-close-icon">
  						        <?php echo \ZenixEssentialApp\Inc\Iinherit\Wdb_Icon_Manager::render_icon( $settings['close_icon'], [ 'aria-hidden' => 'true' ] );
  						        ?>
  				          </div>
  					      <?php } ?>
					      <?php } ?>
        </button>        
      </div>
      <div class="offcanvas-4__content-wrapper">
          <?php if($settings['shortcode'] !=''){ ?>
							<?php echo do_shortcode($settings['shortcode']); ?>						
					<?php } ?>
      </div>
    </div>
  </div>
  <!-- offcanvas end  -->