( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WdbTHeader_Menu = function ($scope, $) {
    
        var wrapper =  $scope.find('.wdb-default-header-layout');        
        if( wrapper.attr('data-maxwidth') ){
            wrapper.find('.main-menu').meanmenu({
                meanScreenWidth: wrapper.attr('data-maxwidth'),
                meanMenuContainer: '.offcanvas__menu-wrapper',
                meanMenuCloseSize: '32px',
            }); 
         }

            if($scope.find('.main-menu').css('display') === 'none'){
                $scope.find('.wdb-header--offcanvas--icon').show();
                $scope.addClass('wdb-mobile-nav-active');
                $scope.find('.offcanvas__menu-area').show();
            }


        window.addEventListener("resize", function(){
            if($scope.find('.main-menu').css('display') == 'block'){
                $scope.find('.wdb-header--offcanvas--icon').hide();
                $scope.removeClass('wdb-mobile-nav-active');
            }else{
                $scope.find('.wdb-header--offcanvas--icon').show();
                $scope.addClass('wdb-mobile-nav-active');
            }

        });
      
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wdb--header-menu.default', WdbTHeader_Menu );
    } );
} )( jQuery );