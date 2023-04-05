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

// This is critical if site has inline-js. We gather all script tags and add nonce from our span
function addNonce(){
	$get_csp = $("span").data( 'csp' )
	$("script").each(function(){
		$(this).attr('nonce', $get_csp);
	})
}

(function( $ ) {
	'use strict';
	// Load JS once windows is loaded.
	$(window).on('load', function(){
		// SetTimeOut just incase things havent initialized just yet.
		setTimeout(() => {
			addNonce();
		}, 50);
	});
})( jQuery );
