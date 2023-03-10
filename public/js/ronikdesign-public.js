// Global Function.
function verificationProcess($validationType, $validationValue){
	// Lets wrap the ajax call if either api are empty we just return empty function.
	jQuery.ajax({
		type: 'post',
		url: wpVars.ajaxURL,
		data: {
			action: 'do_verification',
			nonce: wpVars.nonce,
			validationType: $validationType,
			validationValue: $validationValue,
		},
		dataType: 'json',
		success: data => {
			if(data.success){
			  console.log('success');
			  console.log(data);
			} else{
			  console.log('error');
			  console.log(data);
			  return false;
			}
		},
		error: err => {
		  console.log(err);
		  return false;
		}
	});
}

(function( $ ) {
	'use strict';
	// Load JS once windows is loaded. 
	$( window ).load(function() {
		// SetTimeOut just incase things havent initialized just yet.
		setTimeout(() => {

		}, 50);
	});
})( jQuery );
