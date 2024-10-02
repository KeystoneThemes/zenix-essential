(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    var WdbHeader_Preset = function ($scope, $) {

        let wrapper = $scope.find('.wdb-default-header-layout');
        let mean_obj = {
            meanScreenWidth: 1024,
            meanMenuContainer: '.offcanvas__menu-wrapper',
            meanMenuCloseSize: '28px',
        };
      
        if (wrapper.attr('data-maxwidth')) {
            mean_obj.meanScreenWidth = parseInt(wrapper.attr('data-maxwidth'));
            wrapper.find('.main-menu').meanmenu(mean_obj);
        }

        if (wrapper.find('.header__nav .main-menu').css('display') === 'none') {
            wrapper.find('.wdb-header--offcanvas--icon').show();
            wrapper.find('.header__inner').addClass('wdb-mobile-nav-active');
        }

        window.addEventListener("resize", function () {
        
            if (wrapper.find('.header__nav .main-menu').css('display') == 'block') {
                wrapper.find('.header__inner').removeClass('wdb-mobile-nav-active');
            } else {
                wrapper.find('.header__inner').addClass('wdb-mobile-nav-active');
            }
            if (wrapper.attr('data-hamburger-icon') !== 'block') {

                if (wrapper.find('.header__nav .main-menu').css('display') == 'block') {
                    wrapper.find('.wdb-header--offcanvas--icon').hide();

                } else {
                    wrapper.find('.wdb-header--offcanvas--icon').show();
                }
            }
        });


        //  Header Search
        let header_search = $(".info--search", $scope);
        let search_icon = $(".search-icon", $scope);
        let search_close = $(".search-close", $scope);

        search_icon.on("click", function () {
            header_search.addClass('visible');
            search_icon.css('display', 'none');
            search_close.css('display', 'block');
        });

        search_close.on("click", function () {
            header_search.removeClass('visible');
            search_icon.css('display', 'block');
            search_close.css('display', 'none');
        });
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/wdb--header-preset.default', WdbHeader_Preset);
    });

})(jQuery);