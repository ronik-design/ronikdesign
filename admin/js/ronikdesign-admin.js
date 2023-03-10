(function( $ ) {
	'use strict';

	function initPageMigration() {
		// Exit Function if node doesnt exist.
		if ($("#page_url_migration").length == 0) {
			return;
		}
		$('.migration-status').find('input').css({'pointer-events':'none', 'opacity':.5});
		$('<span name="button" class="page_url_migration__link" href="#" style="cursor:pointer;background: #7210d4;border: none;padding: 10px;color: #fff;border-radius: 5px;">Init Page Url Migration</span>').appendTo( $('#page_url_migration') );
		// Trigger rejection.
		$(".page_url_migration__link").on('click', function(){
			$.ajax({
				type: 'post',
				url: wpVars.ajaxURL,
				data: {
					action: 'do_init_page_migration',
					nonce: wpVars.nonce,
				},
				dataType: 'json',
				success: data => {
					if(data.success){
						console.log('success');
						console.log(data);
						alert('Data processing. Page will reload after processing! Please read migration status below.');
						setTimeout(() => {
							window.location.reload(true);
						}, 500);
					} else{
						console.log('error');
						console.log(data);
						alert('Whoops! Something went wrong! Please try again later!');
						setTimeout(() => {
							window.location.reload(true);
						}, 500);
					}
				},
				error: err => {
					console.log(err);
					alert('Whoops! Something went wrong! Please try again later!');
					// Lets Reload.
					setTimeout(() => {
						window.location.reload(true);
					}, 500);
				}
			});
		});
	}

	// Load JS once windows is loaded. 
	$( window ).load(function() {
		// SetTimeOut just incase things havent initialized just yet.
		setTimeout(() => {
			initPageMigration();

			// verificationProcess('email', 'kevin@ronikdesign.com' );
			// setTimeout(() => {
			// 	verificationProcess('phone', '631-617-4271' );
			// }, 2000);

		}, 250);
	});
})( jQuery );
