

(function ($) {
    'use strict';

    var wdb_ajax_call_delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    var $wdb_mega_menu = {
        init: function (settings) {
            $wdb_mega_menu.config = {
                items: $("#myFeature li"),
                container: $("<div class='container'></div>"),
                current_menu: null,
                current_menu_edit: null,
                search_loader: `<?xml version="1.0" encoding="utf-8"?>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="197px" height="197px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <g transform="translate(50 50)">
                  <g transform="scale(0.58)">
                    <g transform="translate(-50 -50)">
                      <g>
                        <animateTransform attributeName="transform" type="translate" repeatCount="indefinite" dur="5.5555555555555545s" values="-20 -20;20 -20;0 20;-20 -20" keyTimes="0;0.33;0.66;1"></animateTransform>
                        <path fill="#bdd3e4" d="M44.19 26.158c-4.817 0-9.345 1.876-12.751 5.282c-3.406 3.406-5.282 7.934-5.282 12.751 c0 4.817 1.876 9.345 5.282 12.751c3.406 3.406 7.934 5.282 12.751 5.282s9.345-1.876 12.751-5.282 c3.406-3.406 5.282-7.934 5.282-12.751c0-4.817-1.876-9.345-5.282-12.751C53.536 28.033 49.007 26.158 44.19 26.158z"></path>
                        <path fill="#85a2b6" d="M78.712 72.492L67.593 61.373l-3.475-3.475c1.621-2.352 2.779-4.926 3.475-7.596c1.044-4.008 1.044-8.23 0-12.238 c-1.048-4.022-3.146-7.827-6.297-10.979C56.572 22.362 50.381 20 44.19 20C38 20 31.809 22.362 27.085 27.085 c-9.447 9.447-9.447 24.763 0 34.21C31.809 66.019 38 68.381 44.19 68.381c4.798 0 9.593-1.425 13.708-4.262l9.695 9.695 l4.899 4.899C73.351 79.571 74.476 80 75.602 80s2.251-0.429 3.11-1.288C80.429 76.994 80.429 74.209 78.712 72.492z M56.942 56.942 c-3.406 3.406-7.934 5.282-12.751 5.282s-9.345-1.876-12.751-5.282c-3.406-3.406-5.282-7.934-5.282-12.751 c0-4.817 1.876-9.345 5.282-12.751c3.406-3.406 7.934-5.282 12.751-5.282c4.817 0 9.345 1.876 12.751 5.282 c3.406 3.406 5.282 7.934 5.282 12.751C62.223 49.007 60.347 53.536 56.942 56.942z"></path>
                      </g>
                    </g>
                  </g>
                </g>
                </svg>`
            };

            // Allow overriding the default config
            $.extend($wdb_mega_menu.config, settings);

            $wdb_mega_menu.setup();
        },

        setup: function () {
            $wdb_mega_menu.event_register();
        },

        event_register: function () {

            $(document).on('change', '.wdb--mega-menu--enabler-js', function () {
                if (this.checked) {
                    $(this).parents('.wdb--menu-flex-container').find('.wdb-width--100').show();
                    $(this).parents('.wdb--mega-menu-switcher').find('.wdb--menu-setting-header-js .wdb--mega-menu-additional-option').show();
                } else {
                    $(this).parents('.wdb--menu-flex-container').find('.wdb-width--100').hide();
                    $(this).parents('.wdb--mega-menu-switcher').find('.wdb--menu-setting-header-js .wdb--mega-menu-additional-option').hide();
                }
            });

            $(document).on('click', '._menu_item_wdb_mega_menu_tpl_id', function () {
                $wdb_mega_menu.config.current_menu = $(this).find('.wdb--mega-menu-search-fld');
                $('#wdb---hidden-megamenu-trigger').trigger('click');
                //$('.wdb--mega-menu--tpl-suggest-list').html('');
            });

            jQuery('body').on('thickbox:removed', function (e) {
                $wdb_mega_menu.config.current_menu = null;
            });

            $(document).on('input change', '.wdb--elementor-tpl-search-suggest', $wdb_mega_menu.suggest_templates);
            $(document).on('click', '.wdb--add-to--megamenu', $wdb_mega_menu.add_to_menu);
            $(document).on('input', '.wdb--new-mega-menu', $wdb_mega_menu.create_new_post);
            $(document).on('click', '#wdb--submit-new-megamenu-post', $wdb_mega_menu.save_new_post);
        },

        create_new_post: function () {
            let user_input = $(this).val();

            if (user_input.length > 3) {
                $("#wdb--submit-new-megamenu-post").removeClass("disabled");
            } else {
                $("#wdb--submit-new-megamenu-post").addClass("disabled");
            }
        },
        save_new_post: function () {
            let title = $(this).parents('.wdb--mega-menu-tab-content').find('.wdb--new-mega-menu').val();
            if (title.length > 2) {
                jQuery.ajax({
                    type: "post",
                    dataType: "json",
                    url: zenix_obj.ajax_url,
                    timeout: 5000,
                    data: {
                        action: "wdb_get_mega_menu_new_template",
                        nonce: zenix_obj.ajax_nonce,
                        title: title
                    },
                    success: function (response) {
                        $('#wdb--mega-menu-item-response-container').html(response.data.msg);
                        if (response.success) {
                            $('.wdb--elementor-tpl-search-suggest').val(title);
                            $('.wdb--elementor-tpl-search-suggest').trigger('change');
                            $('#wdb--search--tpl-tab').trigger('click');
                        }

                    }
                });
            }
        },
        suggest_templates: function () {
            let user_input = $(this).val();
            $('.wdb--mega-menu--tpl-suggest-list').html($wdb_mega_menu.config.search_loader);
            wdb_ajax_call_delay(function () {

                jQuery.ajax({
                    type: "post",
                    dataType: "json",
                    url: zenix_obj.ajax_url,
                    timeout: 5000,
                    data: {
                        action: "wdb_get_mega_menu_templates",
                        nonce: zenix_obj.ajax_nonce,
                        s: user_input
                    },
                    success: function (response) {
                        $('.wdb--mega-menu--tpl-suggest-list').html(response.html);
                    }
                });

            }, 1000);
        },

        add_to_menu: function () {
            let element_id = $(this).attr('data-id');
            let _sib_edit_button = $(this).parent().find('a');
            const link = _sib_edit_button.length ? _sib_edit_button.attr('href') : '#';
            const title = $(this).parents('.wdb--search-list-single-item').find('.title');

            $wdb_mega_menu.config.current_menu.val(element_id);
            let edit_button = $wdb_mega_menu.config.current_menu.parents('.wdb--mega-menu-switcher').find('.wdb--menu-setting-header-js .wdb--mega-menu-additional-option');
            $wdb_mega_menu.config.current_menu.parents('._menu_item_wdb_mega_menu_tpl_id').find('.wdb--mega-menu-title').html(title.html());
            if (edit_button.length && edit_button.find('a').length) {
                edit_button.find('a').attr('href', link);
            } else {

                $(`<a class="button-secondary" href="${link}">Edit</a>`).appendTo(edit_button);
            }

            $('.tb-close-icon').trigger('click');
        }
    };

    $(document).ready($wdb_mega_menu.init);


})(jQuery);