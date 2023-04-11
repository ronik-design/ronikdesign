// Global Function.

function checkPasswordStrength($) {
	// Loop through all the passwords inpputs
	$( ".adv-passwordchecker" ).each(function( index ) {
		// Lets Create a wrapper container
		$(this).wrap( "<span class='ronik-password__container'> </span>" );
		// Lets Create a message container.
		var $div = $("<span>", {"class": "ronik-password__message"});
		$(this).parent().append($div);
		// Trigger our function every keyup event.
		$( this ).keyup(function() {
			passwordChecker( $(this).val(), $(this));
		});
	});
	// Simple password checker that checks for the password strength.
	function passwordChecker($password, THIS){
		var number = /([0-9])/;
		var alphabets = /([a-zA-Z])/;
		var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
		var hasCaps = /[A-Z]/;
		var hasLower = /[a-z]/;
		var password_message = $(THIS).parent().find('.ronik-password__message');
		if ($password.length < 8) {
			password_message.attr('class', 'ronik-password__message');
			password_message.addClass('weak-password');
			password_message.text("Weak (should be atleast 8 characters.)");
		} else {
			if ($password.match(number) && $password.match(alphabets) && $password.match(special_characters) && $password.match(hasCaps) && $password.match(hasLower)) {
				password_message.attr('class', 'ronik-password__message');
				password_message.addClass('strong-password');
				password_message.text("Strong");
			}
			else {
				password_message.attr('class', 'ronik-password__message');
				password_message.addClass('medium-password');
				password_message.text("Medium (should include alphabets uppercase and lowercase numbers and special characters.)");
			}
		}
	}
}


function verificationProcess($validationType, $validationValue, $strict=false){
	// Lets wrap the ajax call if either api are empty we just return empty function.
	jQuery.ajax({
		type: 'post',
		url: wpVars.ajaxURL,
		data: {
			action: 'do_verification',
			nonce: wpVars.nonce,
			validationType: $validationType,
			validationValue: $validationValue,
			validationStrict: $strict,
		},
		dataType: 'json',
		success: data => {
			if(data.success){
				var $get_csp = $("span").data( 'csp' )
				var object = {valType: $validationType, timestamp: new Date().getTime(), valNonce: $get_csp}
				localStorage.setItem("validator", JSON.stringify(object));
				return data;
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
function addNonce($){
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
			addNonce($);
		}, 50);
	});
})( jQuery );
