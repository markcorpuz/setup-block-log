(function($){

	if (typeof acf === 'undefined') {
		return;
	}

	var i;

	// detect change of tax field ??
	// insert the field key of your tax field
	// need to use $(document).on because field may be dynamically inserted and may not exist when the document is ready
	// this might need to target the hidden field, not sure, testing would be required
	// it really depends on the specifics of the field settings
	// you need to inspect the HTML see the structure of the field
	$(document).on('change', '[data-key="field_5fbd25949fe30"] .acf-checkbox-list', function(e) {

		// once your getting the change event to fire
		// get field value using ACF JS API
		var ACFsFields = acf.getField('field_5fbd25949fe30'),
			Fieldvalues = ACFsFields.val();

		// Loop through each field to show/hide
/*		$.each( Fieldvalues, function( index, element ){
			//alert( element );
			if( $( '#' + element ).is(':visible') ) {
				$( '#' + element ).hide();
			} else {
				$( '#' + element ).show();
			}
		});*/
		
		$( 'div.acf-block-fields' ).children().each( function () {
		    alert( this.id ); // "this" is the current element in the loop
		});
		//if( $.inArray( "test", Fieldvalues ) !== -1 )

	});

})(jQuery);