(function($) {

	$( "[id^=group_line_expander__]" ).each( function () {

		var logID 				= this.id,
			SlogID 				= logID.split( "__" );

		$( '#group_line_expander__' + SlogID[ 1 ] ).on( 'click', function() {

			if( $( this ).text() === '+' ) {
				$( this ).text( '-' );
			} else {
				$( this ).text( '+' );
			}

			$( '#group_info__' + SlogID[ 1 ] ).toggle( 'fast' );

		});

	});

})( jQuery );