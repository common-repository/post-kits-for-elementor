( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetEaeFilterizrJsHandler = function( $scope, $ ) {
        /**
         * Filterizer
         */
        var filter =   $scope.find( '.filter-container' );
        var f_layout    =   filter.data( 'layout' );

        if ( $( filter ).length >0  ) {
            //Initialize filterizr
            $( filter ).filterizr( { layout: f_layout } );
        }

        var $filter = $scope.find( '.controls .filter' );

        //Simple filter controls
        $filter.on( 'click', function( e ) {
            e.preventDefault();
            $filter.removeClass( 'active' );
            $( this ).addClass( 'active' );
        } );
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pke-portfolio-gallery.default', WidgetEaeFilterizrJsHandler );
    } );
} )( jQuery );
