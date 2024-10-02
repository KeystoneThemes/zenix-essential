(function ($) {
  'use strict';
  var admin_url = zenix_admin_obj.admin_ajax;
  var cpt_options = {
    action: 'wdb_admin_get_cache_cpt',
    nonce: zenix_admin_obj.ajax_nonce
  }
  var _custom_post_object_data = null;
  jQuery.ajax({
    type: "GET",
    url: admin_url,
    data: cpt_options,
    success: function (response) {
      _custom_post_object_data = response;
    }
  });

  $(document).on('click', '#wdb--theme-update', function (e) {
    e.preventDefault();
    $(this).html('Updating');

    jQuery.ajax({
      type: "post",
      dataType: "json",
      url: admin_url,
      data: {
        action: "wdb_update_theme",
        slug: 'info',
      },
      success: function (response) {
        $('#wdb---theme-update-respone').html(response.data.debug.join("</p><p>"));
      }
    });
  });
  // Notice Dismiss Action
  $(document).on('click', '#wdb-remote-theme-update .notice-dismiss', function () {
    jQuery.ajax({
      type: "post",
      dataType: "json",
      url: admin_url,
      data: {
        action: "wdb_theme_notice_dismiss",
        nonce: zenix_admin_obj.ajax_nonce,
      },
      success: function (response) {

      }
    });
  });

  $(document).on('click', '#wdb--check-theme-update-status', function (e) {
    e.preventDefault();

    let $current_element = $(this);
    $current_element.html('Checking theme update');
    jQuery.ajax({
      type: "post",
      dataType: "json",
      url: admin_url,
      data: {
        action: "wdb_update_theme_status",
        slug: 'info',
      },
      success: function (response) {
        $current_element.html('Update Check');
        if (response.success) {
          $('#wdb--theme-update-container').html(
            `
            <a class="button" id="wdb--theme-update">Update Theme Latest Version</a>
            <div style="margin-top:20px;" id="wdb---theme-update-respone">
              <h3>Description</h3>
              ${response.data.sections.description}
              <h3>Changelog</h3>
              ${response.data.sections.changelog}
             
            </div>
            `
          );
        } else {
          $current_element.parent().find('p').html(response.data.msg);
        }
      }
    });
  });

})(jQuery);

