(function($) {

	// main collapsable div
	$( "[id^=group_line_expander__]" ).each( function () {

		var logID 				= this.id,
			SlogID 				= logID.split( "__" );

		$( '#group_line_expander__' + SlogID[ 1 ] ).on( 'click', function() {

			if( $( this ).text() === 'CLICK TO EXPAND' ) {
				$( this ).text( 'CLICK TO HIDE' );
			} else {
				$( this ).text( 'CLICK TO EXPAND' );
			}

			//$( '#group_info__' + SlogID[ 1 ] ).toggle( 'fast' );
			$( '#group_info__' + SlogID[ 1 ] ).slideToggle( 'medium' );

		});

	});

	// nested collapsable div
	$( "[id^=group_line_ib_expander__]" ).each( function () {

		var logID 				= this.id,
			SlogID 				= logID.split( "__" );

		$( '#group_line_ib_expander__' + SlogID[ 1 ] ).on( 'click', function() {
			
			if( $( this ).text() === 'CLICK TO EXPAND' ) {
				$( this ).text( 'CLICK TO HIDE' );
			} else {
				$( this ).text( 'CLICK TO EXPAND' );
			}

			//$( '#group_info_ib__' + SlogID[ 1 ] ).toggle( 'fast' );
			$( '#group_info_ib__' + SlogID[ 1 ] ).slideToggle( 'medium' );

		});

	});

})( jQuery );