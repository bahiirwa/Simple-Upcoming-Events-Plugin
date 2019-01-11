(function( $ ) {
	
	//Initializing jQuery UI Datepicker
	$( '#suep-event-start-date' ).datepicker({
		dateFormat: 'MM dd, yy',
		onClose: function( selectedDate ){
			$( '#suep-event-end-date' ).datepicker( 'option', 'minDate', selectedDate );
		}
	});
	$( '#suep-event-end-date' ).datepicker({
		dateFormat: 'MM dd, yy',
		onClose: function( selectedDate ){
			$( '#suep-event-start-date' ).datepicker( 'option', 'maxDate', selectedDate );
		}
	});
	
})( jQuery );