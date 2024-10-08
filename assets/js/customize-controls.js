( function( $, api, _ ) {
	api( 'header_footer_background_color', function( value ) {
		value.bind( function( to ) {
            $('header,footer').css('background-color', to);
		} );
	} );

    api( 'front_main_page_cover_image', function( value ) {
		value.bind( function( to ) {
            $('#main-cover img').attr('src', to);
		} );
	} );
    api( 'front_main_page_cover_title', function( value ) {
		value.bind( function( to ) {
            $('#main-cover .cover-title').html(to);
		} );
	} );
    api( 'front_main_page_cover_subtitle', function( value ) {
		value.bind( function( to ) {
            $('#main-cover .cover-subtitle').html(to);
		} );
	} );
    api( 'front_main_page_cover_title_color', function( value ) {
		value.bind( function( to ) {
            $('#main-cover .cover-title').css('color', to);
		} );
	} );
    api( 'front_main_page_cover_subtitle_color', function( value ) {
		value.bind( function( to ) {
            $('#main-cover .cover-subtitle').css('color', to);
		} );
	} );
	api( 'job_deliver_detail', function( value ) {
		value.bind( function( to ) {
            $('.job-deliver-detail').html(to.replace(/(?:\r\n|\r|\n)/g, '<br>'));
		} );
	} );
}( jQuery, wp.customize, _ ) );
