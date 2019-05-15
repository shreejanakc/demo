/**
 * For customizer
 */

( function ( $ ) {

	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			jQuery( '#site-description' ).text( to );
		} );
	} );

    wp.customize( 'header_color', function( value ) {
        value.bind( function( to ) {
            jQuery( '#colored' ).css('color', to );
        } );
    } );
    
} )( jQuery );